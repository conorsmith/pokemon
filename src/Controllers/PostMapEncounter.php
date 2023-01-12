<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostMapEncounter
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly array $map,
    ) {}

    public function __invoke(): void
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        if ($instanceRow['unused_encounters'] < 1) {
            $this->session->getFlashBag()->add("errors", "No unused encounters remaining.");
            header("Location: /map/encounter");
            exit;
        }

        $currentLocation = $this->findLocation($instanceRow['current_location']);

        if (count($currentLocation['pokemon']) === 0) {
            $this->session->getFlashBag()->add("errors", "No Pokémon encountered.");
            header("Location: /map/encounter");
            exit;
        }

        $pokemonRow = $this->db->fetchAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND team_position = 1", [
            'instanceId' => INSTANCE_ID,
        ]);

        $leadPokemonLevel = $pokemonRow['level'];

        $encounteredPokemonId = self::generateEncounteredPokemon($currentLocation);
        $encounteredPokemonLevel = self::generateEncounteredLevel($currentLocation, $encounteredPokemonId);

        $levelDifference = $encounteredPokemonLevel - $leadPokemonLevel;

        if ($levelDifference > 5) {
            $chance = 0;
        } elseif ($levelDifference < -4) {
            $chance = 100;
        } else {
            switch ($levelDifference) {
                case 5:
                    $chance = 1;
                    break;
                case 4:
                    $chance = 8;
                    break;
                case 3:
                    $chance = 20;
                    break;
                case 2:
                    $chance = 50;
                    break;
                case 1:
                    $chance = 75;
                    break;
                case 0:
                    $chance = 90;
                    break;
                case -1:
                    $chance = 94;
                    break;
                case -2:
                    $chance = 96;
                    break;
                case -3:
                    $chance = 98;
                    break;
                case -4:
                    $chance = 99;
                    break;
            }
        }

        $caught = $chance >= mt_rand(1, 100);

        $encounter = [
            'pokemon' => [
                'id' => $encounteredPokemonId,
                'level' => $encounteredPokemonLevel,
            ],
            'caught' => $caught,
            'sentToBox' => false,
        ];

        if ($caught) {

            $positionRow = $this->db->fetchNumeric("SELECT MAX(team_position) FROM caught_pokemon WHERE instance_id = :instanceId", [
                'instanceId' => INSTANCE_ID,
            ]);

            if ($positionRow[0] >= 6) {
                $teamPosition = null;
                $encounter['sentToBox'] = true;
            } else {
                $teamPosition = $positionRow[0] + 1;
            }

            $this->db->insert("caught_pokemon", [
                'id' => Uuid::uuid4(),
                'instance_id' => INSTANCE_ID,
                'pokemon_id' => $encounteredPokemonId,
                'level' => $encounteredPokemonLevel,
                'team_position' => $teamPosition,
                'date_caught' => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
            ]);
        }

        $this->db->update("instances", [
            'unused_encounters' => $instanceRow['unused_encounters'] - 1,
        ], [
            'id' => INSTANCE_ID,
        ]);

        $this->session->getFlashBag()->set('encounter', $encounter);

        header("Location: /");
        exit;
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
