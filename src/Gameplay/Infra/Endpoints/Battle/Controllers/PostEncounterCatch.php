<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Gameplay\App\UseCases\AddNewPokemon;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\Encounter;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\EncounterRepository;
use ConorSmith\Pokemon\Gameplay\Domain\InGameEvents\FixedEncounterCaptureEvent;
use ConorSmith\Pokemon\Gameplay\Domain\InGameEvents\FixedEncounterCaptureEventRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\FriendshipEventLogRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Pokedex\PokedexEntryRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Pokedex\PokemonEntry;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\ViewModels\EventFactory;
use ConorSmith\Pokemon\FixedEncounterConfigRepository;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\GymBadge;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use Doctrine\DBAL\Connection;
use LogicException;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostEncounterCatch
{
    public function __construct(
        private readonly Connection $db,
        private readonly EncounterRepository $encounterRepository,
        private readonly FixedEncounterCaptureEventRepository $fixedEncounterCaptureEventRepository,
        private readonly FriendshipEventLogRepository $friendshipEventLogRepository,
        private readonly PokedexEntryRepository $pokedexEntryRepository,
        private readonly PokemonRepository $pokemonRepository,
        private readonly BagRepository $bagRepository,
        private readonly FixedEncounterConfigRepository $fixedEncounterConfigRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly AddNewPokemon $addNewPokemon,
        private readonly EventFactory $eventFactory,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $encounterId = $args['id'];
        $pokeballItemId = $request->request->get('pokeball');

        $encounter = $this->encounterRepository->find($encounterId);

        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => $args['instanceId'],
        ]);

        $bag = $this->bagRepository->find();

        if (!$bag->has($pokeballItemId)) {
            $itemConfig = require __DIR__ . "/../../../../../Config/Items.php";
            return new JsonResponse([
                $this->eventFactory->createMessageEvent("No {$itemConfig[$pokeballItemId]['name']} remaining."),
            ]);
        }

        $levelLimit = self::findLevelLimit($instanceRow);

        if ($encounter->pokemon->level > $levelLimit) {
            return new JsonResponse([
                $this->eventFactory->createMessageEvent("You can't catch Pokémon above level {$levelLimit}"),
            ]);
        }

        $events = [];

        $catchRate = self::calculateCatchRate($encounter, $pokeballItemId);

        if ($catchRate >= 255 * 4096) {
            $caught = true;
        } else {
            $caught = false;

            for ($i = 0; $i < 3 && !$caught; $i++) {
                $shakeRoll = mt_rand(0, 65535);
                $shakeProbability = self::calculateShakeProbability($catchRate);
                $events[] = $this->eventFactory->createShakeEvent($catchRate, $shakeProbability, $shakeRoll);
                if ($shakeRoll < $shakeProbability) {
                    $caught = true;
                }
            }
        }

        if ($caught) {

            $events[] = $this->eventFactory->createCatchSuccessEvent($encounter, $catchRate);

            $currentLocation = $this->findLocation($instanceRow['current_location']);

            $totalRegisteredPokemonBeforeCatch = count(array_filter(
                $this->pokedexEntryRepository->all(),
                fn (PokemonEntry $entry) => $entry->isRegistered,
            ));

            $party = $this->pokemonRepository->getParty();

            $pokemon = $this->addNewPokemon->run(
                $encounter->pokemon->number,
                $encounter->pokemon->form,
                $encounter->pokemon->level,
                $encounter->pokemon->sex,
                $encounter->pokemon->isShiny,
                $encounter->pokemon->stats->ivs->hp,
                $encounter->pokemon->stats->ivs->physicalAttack,
                $encounter->pokemon->stats->ivs->physicalDefence,
                $encounter->pokemon->stats->ivs->specialAttack,
                $encounter->pokemon->stats->ivs->specialDefence,
                $encounter->pokemon->stats->ivs->speed,
                $currentLocation['id'],
                $party->isFull() ? null : $party->getNextOpenPosition(),
            );

            if (!is_null($encounter->fixedEncounterId)) {
                $this->fixedEncounterCaptureEventRepository->save(new FixedEncounterCaptureEvent(
                    Uuid::uuid4()->toString(),
                    $encounter->fixedEncounterId,
                    $currentLocation['id'],
                    $pokemon->number,
                    CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
                ));
            }

            if ($party->isFull()) {
                $this->friendshipEventLogRepository->sentToBox($pokemon);
                $events[] = $this->eventFactory->createCaughtPokemonSentToBoxEvent($encounter);
            } else {
                $this->friendshipEventLogRepository->sentToParty($pokemon);
            }

            $totalRegisteredPokemonAfterCatch = count(array_filter(
                $this->pokedexEntryRepository->all(),
                fn (PokemonEntry $entry) => $entry->isRegistered,
            ));

            if ($totalRegisteredPokemonAfterCatch > $totalRegisteredPokemonBeforeCatch) {
                $events[] = $this->eventFactory->createPokedexRegistrationEvent($encounter);

                $configEntry = $this->findLegendaryUnlock($totalRegisteredPokemonAfterCatch);
                if (!is_null($configEntry)) {
                    $events[] = $this->eventFactory->createLegendaryUnlockEvent($configEntry['pokemon']);
                }
            }

            $bag = $bag->use($pokeballItemId);
            $encounter = $encounter->captured();

            $this->bagRepository->save($bag);
            $this->encounterRepository->save($encounter);

        } else {
            $bag = $bag->use($pokeballItemId);

            $this->bagRepository->save($bag);

            $events[] = $this->eventFactory->createCatchFailureEvent($encounter);
        }

        return new JsonResponse($events);
    }

    private static function calculateCatchRate(Encounter $encounter, string $pokeBallItemId): float
    {
        $pokemon = $encounter->pokemon;

        $hpFactor = floor((((3 * $pokemon->calculateHp()) - (2 * $pokemon->remainingHp)) * 4096) + 0.5);

        if ($pokemon->level < 13) {
            $levelBonus = max((36 - (2 * $pokemon->level)) / 10, 1);
        } else {
            $levelBonus = 1;
        }

        $ballBonus = match ($pokeBallItemId) {
            ItemId::POKE_BALL  => 1,
            ItemId::GREAT_BALL => 1.5,
            ItemId::ULTRA_BALL => 2,
            default            => throw new LogicException(),
        };

        $catchRatesConfig = require __DIR__ . "/../../../../../Config/CatchRates.php";

        $speciesRate = 1;

        /** @var array $configEntry */
        foreach ($catchRatesConfig as $configEntry) {
            if ($configEntry['number'] === $pokemon->number) {
                $speciesRate = $configEntry['rate'];
                break;
            }
        }

        $darkGrass = 1;
        $badgePenalty = 1;
        $statusBonus = 1;
        $miscBonus = 1;

        $initialFactor = $hpFactor * $darkGrass * $speciesRate * $ballBonus * $badgePenalty;

        return floor($initialFactor / (3 * $encounter->pokemon->calculateHp())) * $levelBonus * $statusBonus * $miscBonus;
    }

    private static function calculateShakeProbability(float $catchRate): float
    {
        return floor(65536 * ($catchRate / (255 * 4096)));
    }

    private function findLocation(string $id): array
    {
        $location = $this->locationConfigRepository->findLocation($id);

        if (is_null($location)) {
            throw new \Exception;
        }

        return $location;
    }

    private static function findLevelLimit(array $instanceRow): int
    {
        $gymBadges = array_map(
            fn(int $value) => GymBadge::from($value),
            json_decode($instanceRow['badges'])
        );

        if (count($gymBadges) === 0) {
            return GymBadge::BOULDER->levelLimit();
        }

        $highestRankedBadge = GymBadge::findHighestRanked($gymBadges);

        return $highestRankedBadge->levelLimit();
    }

    private function findLegendaryUnlock(int $totalRegisteredPokemon): ?array
    {
        $fixedEncountersConfig = $this->fixedEncounterConfigRepository->all();

        foreach ($fixedEncountersConfig as $configEntry) {
            if (isset($configEntry['unlock'])
                && $configEntry['unlock'] === $totalRegisteredPokemon
            ) {
                return $configEntry;
            }
        }

        return null;
    }
}