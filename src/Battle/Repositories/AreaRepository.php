<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Repositories;

use ConorSmith\Pokemon\Battle\Domain\Area;

final class AreaRepository
{
    public function __construct(
        private readonly TrainerRepository $trainerRepository,
    ) {}

    public function find(string $locationId): ?Area
    {
        $trainers = $this->trainerRepository->findTrainersInLocation($locationId);

        // TODO: Handle areas comprised of multiple locations

        return new Area($locationId, $trainers);
    }
}
