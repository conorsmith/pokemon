<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

interface BattleRepository
{
    public function find(string $id): ?Battle;
    public function findForTrainer(string $trainerId): ?Battle;
    public function findBattlesInLocation(string $locationId): array;
    public function save(Battle $battle): void;
}
