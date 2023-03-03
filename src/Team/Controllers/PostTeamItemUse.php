<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\GymBadge;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\Team\Domain\Pokemon;
use ConorSmith\Pokemon\Team\FriendshipLog;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepository;
use Doctrine\DBAL\Connection;
use GuzzleHttp\Client;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostTeamItemUse
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly BagRepository $bagRepository,
        private readonly PokemonRepository $pokemonRepository,
        private readonly FriendshipLog $friendshipLog,
        private readonly array $pokedex,
    ) {}

    public function __invoke(array $args): void
    {
        $itemId = $args['id'];
        $pokemonId = $_POST['pokemon'];

        if ($itemId === ItemId::RARE_CANDY) {
            $this->attemptToLevelUpPokemon($pokemonId);
            return;
        }

        $this->attemptToEvolvePokemon($itemId, $pokemonId);
    }

    private function attemptToLevelUpPokemon(string $pokemonId): void
    {
        $pokemon = $this->pokemonRepository->find($pokemonId);

        if (is_null($pokemon)) {
            $this->session->getFlashBag()->add("errors", "Pokémon not found.");
            header("Location: /team/use/" . ItemId::RARE_CANDY);
            return;
        }

        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        if ($instanceRow['unused_level_ups'] < 1) {
            $this->session->getFlashBag()->add("errors", "No rare candies remaining.");
            header("Location: /team/use/" . ItemId::RARE_CANDY);
            return;
        }

        $levelLimit = self::findLevelLimit($instanceRow);

        if ($pokemon->level + 1 > $levelLimit) {
            $this->session->getFlashBag()->add("errors", "You can't level up Pokémon beyond level {$levelLimit}");
            header("Location: /team/use/" . ItemId::RARE_CANDY);
            return;
        }

        $newLevel = self::calculateNewLevel($pokemon->level, $levelLimit);
        $pokemonConfig = $this->pokedex[$pokemon->number];

        $pokemonEvolves = false;
        $newPokemonNumber = null;

        if (array_key_exists('evolutions', $pokemonConfig)) {
            foreach ($pokemonConfig['evolutions'] as $number => $evolution) {
                if (self::canEvolve($pokemon, $evolution)) {
                    $pokemonEvolves = true;
                    $newPokemonNumber = $number;
                }
            }
        }

        $this->friendshipLog->levelUp($pokemon);

        $this->db->beginTransaction();

        $this->db->update("instances", [
            'unused_level_ups' => $instanceRow['unused_level_ups'] - 1,
        ], [
            'id' => INSTANCE_ID,
        ]);

        $this->db->update("caught_pokemon", [
            'level' => $newLevel,
        ], [
            'id' => $pokemon->id,
        ]);

        if ($pokemonEvolves) {
            $this->db->update("caught_pokemon", [
                'pokemon_id' => $newPokemonNumber,
            ], [
                'id' => $pokemon->id,
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

        $this->session->getFlashBag()->add("successes", "{$pokemonConfig['name']} levelled up to level {$newLevel}");

        if ($pokemonEvolves) {
            $newPokemon = $this->pokedex[$newPokemonNumber];
            $this->session->getFlashBag()->add("successes", "Your {$pokemonConfig['name']} evolved into {$newPokemon['name']}!");
        }

        header("Location: /team/use/" . ItemId::RARE_CANDY);
    }

    private static function canEvolve(Pokemon $pokemon, array $evolutionConfig): bool
    {
        $requirements = [];

        if (array_key_exists('level', $evolutionConfig)) {
            $requirements[] = $evolutionConfig['level'] <= $pokemon->level + 1;
        }

        if (in_array('friendship', $evolutionConfig)) {
            $requirements[] = $pokemon->friendship >= 220;
        }

        if (array_key_exists('time', $evolutionConfig)) {

            $now = CarbonImmutable::now("Europe/Dublin");

            $response = (new Client())->get("https://api.sunrisesunset.io/json?lat=53.34981&lng=-6.26031&timezone=Europe%2FDublin&date=today");

            $data = json_decode($response->getBody()->getContents(), true);

            $sunrise = CarbonImmutable::createFromFormat(
                "Y-m-d g:i:s A",
                $now->format("Y-m-d ") . $data['results']['sunrise'],
                "Europe/Dublin"
            );
            $sunset = CarbonImmutable::createFromFormat(
                "Y-m-d g:i:s A",
                $now->format("Y-m-d ") . $data['results']['sunset'],
                "Europe/Dublin"
            );

            $requirements[] = match ($evolutionConfig['time']) {
                "day" => $now->isAfter($sunrise) && $now->isBefore($sunset),
                "night" => $now->isBefore($sunrise) && $now->isAfter($sunset),
            };
        }

        if (count($requirements) === 0) {
            return false;
        }

        return array_reduce(
            $requirements,
            fn(bool $requirement, bool $carry) => $requirement && $carry,
            true
        );
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

    private function attemptToEvolvePokemon(string $itemId, string $pokemonId): void
    {
        $pokemonRow = $this->db->fetchAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId and id = :pokemonId", [
            'instanceId' => INSTANCE_ID,
            'pokemonId' => $pokemonId,
        ]);

        $pokemonConfig = $this->pokedex[$pokemonRow['pokemon_id']];

        if (!array_key_exists('evolutions', $pokemonConfig)) {
            $this->session->getFlashBag()->add("successes", "That did nothing!");
            header("Location: /team/use/{$itemId}");
            return;
        }

        $canEvolveUsingThisItem = false;
        $newPokemonNumber = null;

        foreach ($pokemonConfig['evolutions'] as $pokemonNumber => $evolutionConfig) {
            if (array_key_exists('item', $evolutionConfig)
                && $evolutionConfig['item'] === $itemId
            ) {
                $canEvolveUsingThisItem = true;
                $newPokemonNumber = $pokemonNumber;
            }
        }

        if ($canEvolveUsingThisItem === false) {
            $this->session->getFlashBag()->add("successes", "That did nothing!");
            header("Location: /team/use/{$itemId}");
            return;
        }

        $bag = $this->bagRepository->find();

        $bag = $bag->use($itemId);

        $this->db->beginTransaction();

        $this->bagRepository->save($bag);

        $this->db->update("caught_pokemon", [
            'pokemon_id' => $newPokemonNumber,
        ], [
            'id' => $pokemonId,
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

        $this->db->commit();

        $this->session->getFlashBag()->add("successes", "{$pokemonConfig['name']} evolved into {$this->pokedex[$newPokemonNumber]['name']}");
        header("Location: /");
    }

    private static function calculateNewLevel(int $currentLevel, int $levelLimit): int
    {
        if ($levelLimit === 110) {
            if ($currentLevel < 20) {
                return 20;
            } elseif ($currentLevel < 30) {
                return 30;
            } elseif ($currentLevel < 50) {
                return min($currentLevel + 10, 50);
            } elseif ($currentLevel < 70) {
                return min($currentLevel + 2, 70);
            } else {
                return $currentLevel + 1;
            }
        } elseif ($levelLimit === 90) {
            if ($currentLevel < 20) {
                return 20;
            } elseif ($currentLevel < 30) {
                return 30;
            } elseif ($currentLevel < 50) {
                return min($currentLevel + 2, 50);
            } else {
                return $currentLevel + 1;
            }
        } elseif ($levelLimit === 70) {
            if ($currentLevel < 20) {
                return 20;
            } elseif ($currentLevel < 30) {
                return min($currentLevel + 2, 30);
            } else {
                return $currentLevel + 1;
            }
        } elseif ($levelLimit === 50) {
            if ($currentLevel < 20) {
                return min($currentLevel + 2, 20);
            } else {
                return $currentLevel + 1;
            }
        } else {
            return $currentLevel + 1;
        }
    }
}
