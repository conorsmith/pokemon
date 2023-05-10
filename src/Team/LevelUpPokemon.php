<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\SharedKernel\HighestRankedGymBadgeQuery;
use ConorSmith\Pokemon\Team\Domain\Evolution;
use ConorSmith\Pokemon\Team\Domain\Pokemon;
use ConorSmith\Pokemon\Team\Repositories\EvolutionRepository;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepository;
use Doctrine\DBAL\Connection;
use Exception;
use Ramsey\Uuid\Uuid;

final class LevelUpPokemon
{
    public function __construct(
        private readonly Connection $db,
        private readonly PokemonRepository $pokemonRepository,
        private readonly EvolutionRepository $evolutionRepository,
        private readonly FriendshipLog $friendshipLog,
        private readonly HighestRankedGymBadgeQuery $highestRankedGymBadgeQuery,
    ) {}

    public function run(string $pokemonId): ResultOfLevellingUp
    {
        $team = $this->pokemonRepository->getTeam();

        if (!$team->contains($pokemonId)) {
            throw new Exception("Pokémon not found");
        }

        $pokemon = $team->find($pokemonId);

        $highestRankedGymBadge = $this->highestRankedGymBadgeQuery->run();

        $newLevel = self::calculateNewLevel($pokemon->level, $highestRankedGymBadge->levelLimit());

        if ($newLevel > $highestRankedGymBadge->levelLimit()) {
            return ResultOfLevellingUp::beyondLevelLimit($highestRankedGymBadge->levelLimit());
        }

        $pokemon = $pokemon->levelUp($newLevel);
        $this->friendshipLog->levelUp($pokemon);

        $pokemonEvolves = false;
        $evolutions = $this->evolutionRepository->findAllForPokemon($pokemon);

        /** @var Evolution $evolution */
        foreach ($evolutions as $evolution) {
            if ($evolution->isTriggered($pokemon, $newLevel)) {
                $pokemonEvolves = true;
                $pokemon = $pokemon->evolve($evolution->evolvedPokedexNumber);
                break; // Break loop once an evolution is triggered
            }
        }

        $team = $team->replace($pokemon);

        $this->db->beginTransaction();

        $this->pokemonRepository->saveTeam($team);

        if ($pokemonEvolves) {
            $this->addPokedexEntryIfNecessary($pokemon);
        }

        $this->db->commit();

        return $pokemonEvolves
            ? ResultOfLevellingUp::levelledUpAndEvolved($pokemon->level, $pokemon->number)
            : ResultOfLevellingUp::levelledUp($pokemon->level);
    }

    private function addPokedexEntryIfNecessary(Pokemon $pokemon): void
    {
        $pokedexRow = $this->db->fetchAssociative("SELECT * FROM pokedex_entries WHERE instance_id = :instanceId AND number = :number", [
            'instanceId' => INSTANCE_ID,
            'number' => $pokemon->number,
        ]);

        if ($pokedexRow === false) {
            $this->db->insert("pokedex_entries", [
                'id' => Uuid::uuid4(),
                'instance_id' => INSTANCE_ID,
                'number' => $pokemon->number,
                'date_added' => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
            ]);
        }
    }

    private static function calculateNewLevel(int $currentLevel, int $levelLimit): int
    {
        if ($levelLimit === 140) {
            if ($currentLevel < 20) {
                return 20;
            } elseif ($currentLevel < 30) {
                return 30;
            } elseif ($currentLevel < 50) {
                return 50;
            } elseif ($currentLevel < 70) {
                return 70;
            } elseif ($currentLevel < 90) {
                return min($currentLevel + 10, 90);
            } elseif ($currentLevel < 100) {
                return min($currentLevel + 2, 100);
            } else {
                return $currentLevel + 1;
            }
        } elseif ($levelLimit === 120) {
            if ($currentLevel < 20) {
                return 20;
            } elseif ($currentLevel < 30) {
                return 30;
            } elseif ($currentLevel < 50) {
                return 50;
            } elseif ($currentLevel < 70) {
                return min($currentLevel + 10, 70);
            } elseif ($currentLevel < 90) {
                return min($currentLevel + 2, 90);
            } else {
                return $currentLevel + 1;
            }
        } elseif ($levelLimit === 100) {
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
