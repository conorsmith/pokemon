<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Gameplay\App\UseCases\AddNewEgg;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\Stats;
use ConorSmith\Pokemon\GiftPokemonConfigRepository;
use ConorSmith\Pokemon\Gameplay\Domain\InGameEvents\ObtainedGiftPokemonRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository;
use ConorSmith\Pokemon\Gameplay\Domain\InGameEvents\ObtainedGiftPokemon;
use ConorSmith\Pokemon\Gameplay\Domain\Party\FriendshipEventLogRepository;
use ConorSmith\Pokemon\Gameplay\App\UseCases\AddNewPokemon;
use ConorSmith\Pokemon\Gameplay\Domain\Pokedex\PokedexEntryRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Pokedex\PokemonEntry;
use ConorSmith\Pokemon\ItemConfigRepository;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;
use ConorSmith\Pokemon\SharedKernel\Queries\HabitStreakQuery;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use Exception;
use LogicException;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostObtain
{
    public function __construct(
        private readonly AddNewEgg $addNewEgg,
        private readonly AddNewPokemon $addNewPokemon,
        private readonly BagRepository $bagRepository,
        private readonly LocationRepository $locationRepository,
        private readonly ObtainedGiftPokemonRepository $obtainedGiftPokemonRepository,
        private readonly PokedexEntryRepository $pokedexEntryRepository,
        private readonly PokemonRepository $pokemonRepository,
        private readonly HabitStreakQuery $habitStreakQuery,
        private readonly GiftPokemonConfigRepository $giftPokemonConfigRepository,
        private readonly ItemConfigRepository $itemConfigRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
        private readonly FriendshipEventLogRepository $friendshipLog,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $instanceId = $args['instanceId'];
        $giftPokemonId = $request->request->get("giftPokemonId");

        $bag = $this->bagRepository->find();

        if (!$bag->has(ItemId::OVAL_CHARM)) {
            $this->notifyPlayerCommand->run(
                Notification::transient("You do not have any Oval Charms")
            );
            return new RedirectResponse("/{$instanceId}/map");
        }

        $currentLocation = $this->locationRepository->findCurrentLocation();

        $giftPokemonConfig = $this->giftPokemonConfigRepository->find($giftPokemonId);

        if (is_null($giftPokemonConfig)) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Gift Pokémon config not found.")
            );
            return new RedirectResponse("/{$instanceId}/map");
        }

        if ($giftPokemonConfig['location'] !== $currentLocation->id) {
            $this->notifyPlayerCommand->run(
                Notification::transient("The requested Pokémon is not available in your current location")
            );
            return new RedirectResponse("/{$instanceId}/map");
        }

        $obtainedGiftPokemon = $this->obtainedGiftPokemonRepository->findMostRecent(
            $giftPokemonConfig['id'],
        );

        if (!is_null($obtainedGiftPokemon)
            && $obtainedGiftPokemon->isInCooldownWindow()
        ) {
            $this->notifyPlayerCommand->run(
                Notification::transient("The requested Pokémon has been obtained too recently")
            );
            return new RedirectResponse("/{$instanceId}/map");
        }

        $totalRegisteredPokemonBeforeObtaining = count(array_filter(
            $this->pokedexEntryRepository->all(),
            fn (PokemonEntry $entry) => $entry->isRegistered,
        ));

        $regionalLevelOffset = match ($currentLocation->region) {
            RegionId::KANTO => 0,
            RegionId::JOHTO => 50,
            RegionId::HOENN => 100,
            default         => throw new LogicException(),
        };

        if (isset($giftPokemonConfig['item'])) {

            $bag = $bag->add($giftPokemonConfig['item']);

        } elseif (isset($giftPokemonConfig['isEgg'])) {

            $this->addNewEgg->run(
                $giftPokemonConfig['pokemon'],
                null,
                new Stats(
                    RandomNumberGenerator::generateInRange(0, 31),
                    RandomNumberGenerator::generateInRange(0, 31),
                    RandomNumberGenerator::generateInRange(0, 31),
                    RandomNumberGenerator::generateInRange(0, 31),
                    RandomNumberGenerator::generateInRange(0, 31),
                    RandomNumberGenerator::generateInRange(0, 31),
                ),
                null,
            );

        } else {

            $party = $this->pokemonRepository->getParty();

            $pokemon = $this->addNewPokemon->run(
                $giftPokemonConfig['pokemon'],
                null,
                $giftPokemonConfig['level'] + $regionalLevelOffset,
                $this->generateSex($giftPokemonConfig['pokemon']),
                $this->generateShininess(),
                RandomNumberGenerator::generateInRange(0, 31),
                RandomNumberGenerator::generateInRange(0, 31),
                RandomNumberGenerator::generateInRange(0, 31),
                RandomNumberGenerator::generateInRange(0, 31),
                RandomNumberGenerator::generateInRange(0, 31),
                RandomNumberGenerator::generateInRange(0, 31),
                $currentLocation->id,
                $party->isFull() ? null : $party->getNextOpenPosition(),
            );

            $this->friendshipLog->sentToBox($pokemon);

        }

        $bag = $bag->use(ItemId::OVAL_CHARM);
        $this->bagRepository->save($bag);

        $this->obtainedGiftPokemonRepository->save(new ObtainedGiftPokemon(
            Uuid::uuid4()->toString(),
            $giftPokemonConfig['id'],
            CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
        ));

        $totalRegisteredPokemonAfterObtaining = count(array_filter(
            $this->pokedexEntryRepository->all(),
            fn (PokemonEntry $entry) => $entry->isRegistered,
        ));

        if (isset($giftPokemonConfig['item'])) {
            $itemConfig = $this->itemConfigRepository->find($giftPokemonConfig['item']);

            $name = $itemConfig['name'];

            $this->notifyPlayerCommand->run(
                Notification::persistent("You obtained {$name}!")
            );
        } else {
            $pokedexConfig = $this->pokedexConfigRepository->find($giftPokemonConfig['pokemon']);

            if (isset($giftPokemonConfig['isEgg'])) {
                $name = "{$pokedexConfig['name']} Egg";
            } else {
                $name = $pokedexConfig['name'];
            }

            $this->notifyPlayerCommand->run(
                Notification::persistent("You obtained {$name}!")
            );

            if ($totalRegisteredPokemonBeforeObtaining > $totalRegisteredPokemonAfterObtaining) {
                $this->notifyPlayerCommand->run(
                    Notification::persistent("{$pokedexConfig['name']} has been registered in your Pokédex")
                );
            }
        }

        return new RedirectResponse("/{$instanceId}/map/pokemon");
    }

    private function generateSex(string $pokedexNumber): Sex
    {
        $pokedexConfig = $this->pokedexConfigRepository->find($pokedexNumber);

        if (count($pokedexConfig['sexRatio']) === 1) {
            return $pokedexConfig['sexRatio'][0]['sex'];
        }

        return self::randomlySelectSex($pokedexConfig['sexRatio']);
    }

    private static function randomlySelectSex(array $sexRatioConfig): Sex
    {
        $aggregatedWeight = array_reduce(
            $sexRatioConfig,
            function ($carry, array $sexRatioEntry) {
                return $carry + $sexRatioEntry['weight'];
            },
            0,
        );

        $randomlySelectedValue = mt_rand(1, $aggregatedWeight);

        /** @var array $sexRatioEntry */
        foreach ($sexRatioConfig as $sexRatioEntry) {
            $randomlySelectedValue -= $sexRatioEntry['weight'];
            if ($randomlySelectedValue <= 0) {
                return $sexRatioEntry['sex'];
            }
        }

        throw new Exception;
    }

    private function generateShininess(): bool
    {
        $streak = $this->habitStreakQuery->run();

        $divisor = $streak < 7 ? self::curveBeforeOneWeek($streak) : self::curveAfterOneWeek($streak);

        $odds = intval(round(4096 / $divisor));

        return mt_rand(1, $odds) === 1;
    }

    private static function curveBeforeOneWeek(int $i): float
    {
        return 0.480898 * log(8 * ($i + 1));
    }

    private static function curveAfterOneWeek(int $i): float
    {
        return 3.54073 * log(0.251313 * $i);
    }
}
