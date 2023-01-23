<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostMapEncounter
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly BagRepository $bagRepository,
        private readonly array $map,
    ) {}

    public function __invoke(): void
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $bag = $this->bagRepository->find();

        if (!$bag->has(ItemId::POKE_BALL)) {
            $this->session->getFlashBag()->add("errors", "No Poké Balls remaining.");
            header("Location: /map/encounter");
            exit;
        }

        $currentLocation = $this->findLocation($instanceRow['current_location']);

        if (count($currentLocation['pokemon']) === 0) {
            $this->session->getFlashBag()->add("errors", "No Pokémon encountered.");
            header("Location: /map/encounter");
            exit;
        }

        $encounteredPokemonId = self::generateEncounteredPokemon($currentLocation);
        $encounteredPokemonLevel = self::generateEncounteredLevel($currentLocation, $encounteredPokemonId);

        $encounterId = Uuid::uuid4();

        $this->db->insert("encounters", [
            'id' => $encounterId,
            'instance_id' => INSTANCE_ID,
            'pokemon_id' => $encounteredPokemonId,
            'level' => $encounteredPokemonLevel,
        ]);

        header("Location: /encounter/{$encounterId}");
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
