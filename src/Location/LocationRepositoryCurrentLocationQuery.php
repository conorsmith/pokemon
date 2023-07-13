<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Location;

use ConorSmith\Pokemon\Location\Repositories\LocationRepository;
use ConorSmith\Pokemon\SharedKernel\CurrentLocationQuery;

final class LocationRepositoryCurrentLocationQuery implements CurrentLocationQuery
{
    public function __construct(
        private readonly LocationRepository $locationRepository,
    ) {}

    public function run(): string
    {
        return $this->locationRepository->findCurrentLocation()->id;
    }
}
