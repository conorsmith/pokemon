<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location;

use ConorSmith\Pokemon\Location\Domain\SurveyRepository;
use ConorSmith\Pokemon\Location\Repositories\LocationRepository;
use ConorSmith\Pokemon\Location\Repositories\RegionRepository;
use ConorSmith\Pokemon\Location\Repositories\SurveyRepositoryDb;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\System\RepositoryFactory as SharedRepositoryFactory;
use Doctrine\DBAL\Connection;

final class RepositoryFactory
{
    public function __construct(
        private readonly Connection $db,
        private readonly SharedRepositoryFactory $sharedRepositoryFactory,
    ) {}

    public function create(string $className, InstanceId $instanceId): mixed
    {
        return match ($className) {
            LocationRepository::class => new LocationRepository(
                $this->db,
                $this->sharedRepositoryFactory->create(RegionRepository::class, $instanceId),
                new LocationConfigRepository(),
                $instanceId,
            ),
            SurveyRepository::class   => new SurveyRepositoryDb(
                $this->db,
                $instanceId,
            ),
            default                   => $this->sharedRepositoryFactory->create($className, $instanceId),
        };
    }
}
