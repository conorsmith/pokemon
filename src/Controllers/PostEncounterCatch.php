<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\GymBadge;
use Doctrine\DBAL\Connection;
use Exception;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostEncounterCatch
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly BagRepository $bagRepository,
        private readonly array $pokedex,
        private readonly array $map,
    ) {}

    public function __invoke(array $args): void
    {
        $id = $args['id'];
        $pokeballItemId = $_POST['pokeball'];

        $encounterRow = $this->db->fetchAssociative("SELECT * FROM encounters WHERE instance_id = :instanceId AND id = :id", [
            'instanceId' => INSTANCE_ID,
            'id' => $id,
        ]);

        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $bag = $this->bagRepository->find();

        if (!$bag->has($pokeballItemId)) {
            $itemConfig = require __DIR__ . "/../Config/Items.php";
            $this->session->getFlashBag()->add("errors", "No {$itemConfig[$pokeballItemId]['name']} remaining.");
            header("Location: /map");
            exit;
        }

        $levelLimit = self::findLevelLimit($instanceRow);

        if ($encounterRow['level'] > $levelLimit) {
            $this->session->getFlashBag()->add("errors", "You can't catch Pokémon above level {$levelLimit}");
            header("Location: /map");
            exit;
        }

        $pokemonRow = $this->db->fetchAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND team_position = 1", [
            'instanceId' => INSTANCE_ID,
        ]);

        $levelDifference = $pokemonRow['level'] - $encounterRow['level'];

        $chance = match ($pokeballItemId) {
            ItemId::POKE_BALL => self::getChanceForPokeBall($levelDifference),
            ItemId::GREAT_BALL => self::getChanceForGreatBall($levelDifference),
            ItemId::ULTRA_BALL => self::getChanceForUltraBall($levelDifference),
        };

        $caught = $chance >= mt_rand(1, 100);

        $pokemon = $this->pokedex[$encounterRow['pokemon_id']];

        if ($caught) {

            $this->session->getFlashBag()->add("successes", "You caught the wild {$pokemon['name']}!");

            $positionRow = $this->db->fetchNumeric("SELECT MAX(team_position) FROM caught_pokemon WHERE instance_id = :instanceId", [
                'instanceId' => INSTANCE_ID,
            ]);

            if ($positionRow[0] >= 6) {
                $teamPosition = null;
                $this->session->getFlashBag()->add("successes", "{$pokemon['name']} was sent to your box");
            } else {
                $teamPosition = $positionRow[0] + 1;
            }

            $currentLocation = $this->findLocation($instanceRow['current_location']);

            $this->db->insert("caught_pokemon", [
                'id' => Uuid::uuid4(),
                'instance_id' => INSTANCE_ID,
                'pokemon_id' => $encounterRow['pokemon_id'],
                'is_shiny' => $encounterRow['is_shiny'],
                'level' => $encounterRow['level'],
                'team_position' => $teamPosition,
                'has_fainted' => 0,
                'location_caught' => $currentLocation['id'],
                'date_caught' => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
            ]);

            $pokedexRow = $this->db->fetchAssociative("SELECT * FROM pokedex_entries WHERE instance_id = :instanceId AND number = :number", [
                'instanceId' => INSTANCE_ID,
                'number' => $encounterRow['pokemon_id'],
            ]);

            if ($pokedexRow === false) {
                $this->db->insert("pokedex_entries", [
                    'id' => Uuid::uuid4(),
                    'instance_id' => INSTANCE_ID,
                    'number' => $encounterRow['pokemon_id'],
                    'date_added' => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
                ]);
            }

            $bag = $bag->use($pokeballItemId);

            $this->bagRepository->save($bag);

            $this->db->delete("encounters", [
                'instance_id' => INSTANCE_ID,
                'id' => $id,
            ]);

            header("Location: /map");

        } else {
            $bag = $bag->use($pokeballItemId);

            $this->bagRepository->save($bag);

            $this->session->getFlashBag()->add("successes", "You failed to catch the wild {$pokemon['name']}");

            header("Location: /encounter/{$id}");
        }
    }

    private static function getChanceForPokeBall(int $levelDifference): int
    {
        return match (true) {
            $levelDifference > 4 => 100,
            $levelDifference < -4 => 0,
            default => match ($levelDifference) {
                4 => 95,
                3 => 90,
                2 => 75,
                1 => 60,
                0 => 50,
                -1 => 40,
                -2 => 25,
                -3 => 10,
                -4 => 5,
            }
        };
    }

    private static function getChanceForGreatBall(int $levelDifference): int
    {
        return match (true) {
            $levelDifference > 4 => 100,
            $levelDifference < -4 => 0,
            default => match ($levelDifference) {
                4 => 97,
                3 => 94,
                2 => 85,
                1 => 77,
                0 => 70,
                -1 => 58,
                -2 => 37,
                -3 => 15,
                -4 => 7,
            }
        };
    }

    private static function getChanceForUltraBall(int $levelDifference): int
    {
        return match (true) {
            $levelDifference > 4 => 100,
            $levelDifference < -5 => 0,
            default => match ($levelDifference) {
                4 => 99,
                3 => 98,
                2 => 96,
                1 => 94,
                0 => 90,
                -1 => 75,
                -2 => 50,
                -3 => 20,
                -4 => 8,
                -5 => 1,
            }
        };
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