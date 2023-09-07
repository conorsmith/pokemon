<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Party\Domain\Evolution;
use ConorSmith\Pokemon\Party\Domain\Pokemon;
use ConorSmith\Pokemon\Party\Repositories\EvolutionRepository;
use ConorSmith\Pokemon\Party\Repositories\PokemonRepositoryDb;
use ConorSmith\Pokemon\SharedKernel\Domain\GymBadge;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\SharedKernel\Queries\HighestRankedGymBadgeQuery;
use Doctrine\DBAL\Connection;
use Exception;
use Ramsey\Uuid\Uuid;

final class LevelUpPokemon
{
    public function __construct(
        private readonly Connection $db,
        private readonly PokemonRepositoryDb $pokemonRepository,
        private readonly EvolutionRepository $evolutionRepository,
        private readonly FriendshipLog $friendshipLog,
        private readonly HighestRankedGymBadgeQuery $highestRankedGymBadgeQuery,
        private readonly InstanceId $instanceId,
    ) {}

    public function run(string $pokemonId): ResultOfLevellingUp
    {
        $pokemon = $this->pokemonRepository->find($pokemonId);

        if (is_null($pokemon)) {
            throw new Exception("Pokémon not found");
        }

        $highestRankedGymBadge = $this->highestRankedGymBadgeQuery->run();

        $newLevel = self::calculateNewLevel($pokemon->level, $highestRankedGymBadge->levelLimit());

        if ($newLevel > $highestRankedGymBadge->levelLimit()) {
            return ResultOfLevellingUp::beyondLevelLimit($highestRankedGymBadge->levelLimit());
        }

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

        $pokemon = $pokemon->levelUp($newLevel);
        $this->friendshipLog->levelUp($pokemon);

        $this->db->beginTransaction();

        $this->pokemonRepository->save($pokemon);

        if ($pokemonEvolves) {
            $this->addPokedexEntryIfNecessary($pokemon);

            // TODO: Implement Shedinja generation
        }

        $this->db->commit();

        return $pokemonEvolves
            ? ResultOfLevellingUp::levelledUpAndEvolved($pokemon->level, $pokemon->number)
            : ResultOfLevellingUp::levelledUp($pokemon->level);
    }

    private function addPokedexEntryIfNecessary(Pokemon $pokemon): void
    {
        $pokedexRow = $this->db->fetchAssociative("SELECT * FROM pokedex_entries WHERE instance_id = :instanceId AND number = :number", [
            'instanceId' => $this->instanceId->value,
            'number'     => $pokemon->number,
        ]);

        if ($pokedexRow === false) {
            $this->db->insert("pokedex_entries", [
                'id'          => Uuid::uuid4(),
                'instance_id' => $this->instanceId->value,
                'number'      => $pokemon->number,
                'date_added'  => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
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
        sort($distinctLevelLimits);

        $previousLevelLimits = array_filter(
            $distinctLevelLimits,
            fn(int $possibleLevelLimit) => $possibleLevelLimit < $levelLimit,
        );

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
