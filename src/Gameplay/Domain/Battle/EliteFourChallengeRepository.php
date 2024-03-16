<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Battle;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

interface EliteFourChallengeRepository
{
    public function findActive(): ?EliteFourChallenge;

    public function findPlayerVictoryInRegion(RegionId $region): ?EliteFourChallenge;

    public function findAllVictoriesInRegion(RegionId $region): array;

    public function findCurrentPokemonLeagueRegionForPlayer(): RegionId;

    public function save(EliteFourChallenge $eliteFourChallenge): void;

    public function createEliteFourChallenge(
        string $id,
        RegionId $regionId,
        ?string $trainerId,
        array $party,
        int $stage,
        bool $victory,
        ?CarbonImmutable $dateCompleted,
    ): EliteFourChallenge;
}
