<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\SharedKernel\HabitStreakQuery;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostMap
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly BagRepository $bagRepository,
        private readonly HabitStreakQuery $habitStreakQuery,
        private readonly array $map,
    ) {}

    public function __invoke(): void
    {
        $legendaryPokemonNumber = $_POST['legendary'] ?? null;

        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $bag = $this->bagRepository->find();

        if (!$bag->hasAnyPokeBall()) {
            $this->session->getFlashBag()->add("errors", "No Poké Balls remaining.");
            header("Location: /map");
            exit;
        }

        $currentLocation = $this->findLocation($instanceRow['current_location']);

        if (!array_key_exists('pokemon', $currentLocation) || count($currentLocation['pokemon']) === 0) {
            $this->session->getFlashBag()->add("errors", "No Pokémon encountered.");
            header("Location: /map");
            exit;
        }

        $encounteredPokemonId = $legendaryPokemonNumber ?? self::generateEncounteredPokemon($currentLocation);
        $encounteredPokemonLevel = $legendaryPokemonNumber
            ? self::findLegendaryPokemonLevel($legendaryPokemonNumber)
            : self::generateEncounteredLevel($currentLocation, $encounteredPokemonId);
        $encounteredPokemonIsShiny = self::generateEncounteredShininess();

        $encounterId = Uuid::uuid4();

        $this->db->insert("encounters", [
            'id' => $encounterId,
            'instance_id' => INSTANCE_ID,
            'pokemon_id' => $encounteredPokemonId,
            'level' => $encounteredPokemonLevel,
            'is_shiny' => $encounteredPokemonIsShiny ? 1 : 0,
            'is_legendary' => !is_null($legendaryPokemonNumber),
        ]);

        if ($legendaryPokemonNumber) {
            $bag = $bag->use(ItemId::CHALLENGE_TOKEN);
            $this->bagRepository->save($bag);
        }

        header("Location: /encounter/{$encounterId}");
    }

    private function findLegendaryPokemonLevel(string $legendaryPokemonNumber): int
    {
        $legendaryConfig = self::findLegendaryConfig($legendaryPokemonNumber);

        return $legendaryConfig['level'];
    }

    private static function findLegendaryConfig(string $legendaryPokemonNumber): ?array
    {
        $legendariesConfig = require __DIR__ . "/../Config/Legendaries.php";

        foreach ($legendariesConfig as $config) {
            if ($config['pokemon'] === $legendaryPokemonNumber) {
                return $config;
            }
        }

        return null;
    }

    private function generateEncounteredShininess(): bool
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

    private static function generateEncounteredPokemon(array $currentLocation): string
    {
        $availablePokemon = $currentLocation['pokemon'];

        $selectedValue = mt_rand(1, array_reduce($availablePokemon, function ($carry, array $encounterData) {
            return $carry + $encounterData['weight'];
        }, 0));

        foreach ($availablePokemon as $pokemonId => $encounterData) {
            $selectedValue -= $encounterData['weight'];
            if ($selectedValue <= 0) {
                return strval($pokemonId);
            }
        }

        throw new \Exception;
    }

    private static function generateEncounteredLevel(array $currentLocation, string $pokemonId): int
    {
        $levels = $currentLocation['pokemon'][$pokemonId]['levels'];

        if (is_int($levels)) {
            return $levels;
        }

        return mt_rand($levels[0], $levels[1]);
    }

    private function findLocation(string $id): array
    {
        /** @var array $location */
        foreach ($this->map as $location) {
            if ($location['id'] === $id) {
                return $location;
            }
        }

        throw new \Exception;
    }
}
