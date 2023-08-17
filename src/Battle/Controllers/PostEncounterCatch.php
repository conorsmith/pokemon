<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Domain\Encounter;
use ConorSmith\Pokemon\Battle\EventFactory;
use ConorSmith\Pokemon\Battle\Repositories\EncounterRepository;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\SharedKernel\CatchPokemonCommand;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\GymBadge;
use ConorSmith\Pokemon\SharedKernel\TotalRegisteredPokemonQuery;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostEncounterCatch
{
    public function __construct(
        private readonly Connection $db,
        private readonly EncounterRepository $encounterRepository,
        private readonly BagRepository $bagRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly CatchPokemonCommand $catchPokemonCommand,
        private readonly TotalRegisteredPokemonQuery $totalRegisteredPokemonQuery,
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
            $itemConfig = require __DIR__ . "/../../Config/Items.php";
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

            $totalRegisteredPokemonBeforeCatch = $this->totalRegisteredPokemonQuery->run();

            $result = $this->catchPokemonCommand->run(
                $encounter->pokemon->number,
                $encounter->pokemon->form,
                $encounter->pokemon->level,
                $encounter->pokemon->sex,
                $encounter->pokemon->isShiny,
                $encounter->isLegendary,
                $encounter->pokemon->stats->ivHp,
                $encounter->pokemon->stats->ivPhysicalAttack,
                $encounter->pokemon->stats->ivPhysicalDefence,
                $encounter->pokemon->stats->ivSpecialAttack,
                $encounter->pokemon->stats->ivSpecialDefence,
                $encounter->pokemon->stats->ivSpeed,
                $currentLocation['id'],
            );

            if ($result->wasSentToBox()) {
                $events[] = $this->eventFactory->createCaughtPokemonSentToBoxEvent($encounter);
            }

            $totalRegisteredPokemonAfterCatch = $this->totalRegisteredPokemonQuery->run();

            if ($totalRegisteredPokemonAfterCatch > $totalRegisteredPokemonBeforeCatch) {
                $events[] = $this->eventFactory->createPokedexRegistrationEvent($encounter);

                $legendaryConfig = $this->findLegendaryUnlock($totalRegisteredPokemonAfterCatch);
                if (!is_null($legendaryConfig)) {
                    $events[] = $this->eventFactory->createLegendaryUnlockEvent($legendaryConfig['pokemon']);
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
        };

        $catchRatesConfig = require __DIR__ . "/../../Config/CatchRates.php";

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
        $legendariesConfig = require __DIR__ . "/../../Config/Legendaries.php";

        foreach ($legendariesConfig as $configEntry) {
            if ($configEntry['unlock'] === $totalRegisteredPokemon) {
                return $configEntry;
            }
        }

        return null;
    }
}