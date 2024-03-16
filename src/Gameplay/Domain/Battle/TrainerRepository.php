<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Battle;

interface TrainerRepository
{
    public function findTrainer(string $id): Trainer;

    public function findTrainerByTrainerId(string $trainerId): Trainer;

    public function findTrainersInLocation(string $locationId): array;

    public function saveTrainer(Trainer $battleTrainer): void;
}
