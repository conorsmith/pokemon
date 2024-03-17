<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers;

use ConorSmith\Pokemon\Gameplay\App\UseCases\AddNewPokemon;
use ConorSmith\Pokemon\Gameplay\Domain\Navigation\Location;
use ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\FriendshipEventLogRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Pokedex\PokedexEntryRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Pokedex\PokemonEntry;
use ConorSmith\Pokemon\ItemConfigRepository;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemType;
use ConorSmith\Pokemon\SharedKernel\Domain\LocationId;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;
use ConorSmith\Pokemon\SharedKernel\Queries\HabitStreakQuery;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use Exception;
use LogicException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostReviveFossil
{
    public function __construct(
        private readonly AddNewPokemon $addNewPokemon,
        private readonly BagRepository $bagRepository,
        private readonly LocationRepository $locationRepository,
        private readonly PokedexEntryRepository $pokedexEntryRepository,
        private readonly PokemonRepository $pokemonRepository,
        private readonly HabitStreakQuery $habitStreakQuery,
        private readonly ItemConfigRepository $itemConfigRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
        private readonly FriendshipEventLogRepository $friendshipLog,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $instanceId = $args['instanceId'];
        $itemId = $request->request->get("itemId");

        $bag = $this->bagRepository->find();

        if (!$bag->has($itemId)) {
            $this->notifyPlayerCommand->run(
                Notification::transient("You do not have that fossil")
            );
            return new RedirectResponse("/{$instanceId}/map");
        }

        $itemConfig = $this->itemConfigRepository->find($itemId);

        if (!isset($itemConfig['type']) || $itemConfig['type'] !== ItemType::FOSSIL) {
            $this->notifyPlayerCommand->run(
                Notification::transient("That item is not a fossil")
            );
            return new RedirectResponse("/{$instanceId}/map");
        }

        $currentLocation = $this->locationRepository->findCurrentLocation();

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

        $party = $this->pokemonRepository->getParty();

        $pokemon = $this->addNewPokemon->run(
            $itemConfig['pokemon'],
            null,
            $this->determineLevel($currentLocation) + $regionalLevelOffset,
            $this->generateSex($itemConfig['pokemon']),
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

        $bag = $bag->use($itemId);
        $this->bagRepository->save($bag);

        $totalRegisteredPokemonAfterObtaining = count(array_filter(
            $this->pokedexEntryRepository->all(),
            fn (PokemonEntry $entry) => $entry->isRegistered,
        ));

        $pokedexConfig = $this->pokedexConfigRepository->find($itemConfig['pokemon']);

        $this->notifyPlayerCommand->run(
            Notification::persistent("You obtained {$pokedexConfig['name']}!")
        );

        if ($totalRegisteredPokemonBeforeObtaining > $totalRegisteredPokemonAfterObtaining) {
            $this->notifyPlayerCommand->run(
                Notification::persistent("{$pokedexConfig['name']} has been registered in your Pokédex")
            );
        }

        return new RedirectResponse("/{$instanceId}/map/facilities");
    }

    private function determineLevel(Location $location): int
    {
        return match ($location->id) {
            LocationId::CINNABAR_LAB      => 5,
            LocationId::DEVON_CORPORATION => 20,
            default                       => throw new LogicException(),
        };
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