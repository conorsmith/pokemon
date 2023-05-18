<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\GymBadge;
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

    public static function calculateNewLevel(int $currentLevel, int $levelLimit): int
    {
        $allLevelLimits = array_map(
            fn(GymBadge $gymBadge) => $gymBadge->levelLimit(),
            GymBadge::all(),
        );

        $distinctLevelLimits = array_unique($allLevelLimits);

        $previousLevelLimits = array_filter(
            $distinctLevelLimits,
            fn(int $possibleLevelLimit) => $possibleLevelLimit < $levelLimit,
        );

        sort($distinctLevelLimits);

        $mostRecentLevelLimit = array_pop($previousLevelLimits);
        $secondMostRecentLevelLimit = array_pop($previousLevelLimits);
        $thirdMostRecentLevelLimit = array_pop($previousLevelLimits);

        $remainingRecentLevelLimits = $previousLevelLimits;

        foreach ($remainingRecentLevelLimits as $recentLevelLimit) {
            if ($currentLevel < $recentLevelLimit) {
                return $recentLevelLimit;
            }
        }

        if ($currentLevel < $thirdMostRecentLevelLimit) {
            return min($currentLevel + 10, $thirdMostRecentLevelLimit);

        } elseif ($currentLevel < $secondMostRecentLevelLimit) {
            return min($currentLevel + 2, $secondMostRecentLevelLimit);

        } elseif ($currentLevel < $mostRecentLevelLimit) {
            return min($currentLevel + 1, $mostRecentLevelLimit);

        } else {
            return $currentLevel + 1;
        }
    }
}
