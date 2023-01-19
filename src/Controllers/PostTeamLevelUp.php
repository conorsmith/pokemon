<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\GymBadge;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostTeamLevelUp
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly array $pokedex,
    ) {}

    public function __invoke(): void
    {
        $pokemonRow = $this->db->fetchAssociative("SELECT * FROM caught_pokemon WHERE id = :pokemonId", [
            'pokemonId' => $_POST['pokemon'],
        ]);

        if ($pokemonRow === false) {
            $this->session->getFlashBag()->add("errors", "Pokémon not found.");
            header("Location: /team/level-up");
            exit;
        }

        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        if ($instanceRow['unused_level_ups'] < 1) {
            $this->session->getFlashBag()->add("errors", "No rare candies remaining.");
            header("Location: /team/level-up");
            exit;
        }

        $levelLimit = self::findLevelLimit($instanceRow);

        if ($pokemonRow['level'] + 1 > $levelLimit) {
            $this->session->getFlashBag()->add("errors", "You can't level up Pokémon beyond level {$levelLimit}");
            header("Location: /team/level-up");
            exit;
        }

        $newLevel = $pokemonRow['level'] + 1;
        $pokemon = $this->pokedex[$pokemonRow['pokemon_id']];

        $pokemonEvolves = false;
        $newPokemonNumber = null;

        if (array_key_exists('evolutions', $pokemon)) {
            foreach ($pokemon['evolutions'] as $number => $evolution) {
                if (array_key_exists('level', $evolution) && $evolution['level'] <= $newLevel) {
                    $pokemonEvolves = true;
                    $newPokemonNumber = $number;
                }
            }
        }

        $this->db->beginTransaction();

        $this->db->update("instances", [
            'unused_level_ups' => $instanceRow['unused_level_ups'] - 1,
        ], [
            'id' => INSTANCE_ID,
        ]);

        $this->db->update("caught_pokemon", [
            'level' => $newLevel,
        ], [
            'id' => $pokemonRow['id'],
        ]);

        if ($pokemonEvolves) {
            $this->db->update("caught_pokemon", [
                'pokemon_id' => $newPokemonNumber,
            ], [
                'id' => $pokemonRow['id'],
            ]);

            $pokedexRow = $this->db->fetchAssociative("SELECT * FROM pokedex_entries WHERE instance_id = :instanceId AND number = :number", [
                'instanceId' => INSTANCE_ID,
                'number' => $newPokemonNumber,
            ]);

            if ($pokedexRow === false) {
                $this->db->insert("pokedex_entries", [
                    'id' => Uuid::uuid4(),
                    'instance_id' => INSTANCE_ID,
                    'number' => $newPokemonNumber,
                    'date_added' => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
                ]);
            }
        }

        $this->db->commit();

        $this->session->getFlashBag()->add("successes", "{$pokemon['name']} levelled up to level {$newLevel}");

        if ($pokemonEvolves) {
            $newPokemon = $this->pokedex[$newPokemonNumber];
            $this->session->getFlashBag()->add("successes", "Your {$pokemon['name']} evolved into {$newPokemon['name']}!");
        }

        header("Location: /team/level-up");
        exit;
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
}
