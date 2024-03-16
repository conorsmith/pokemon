<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Repositories;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\LeagueChampion;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\LeagueChampionRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;
use RuntimeException;

final class LeagueChampionRepositoryDb implements LeagueChampionRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly InstanceId $instanceId,
    ) {}

    public function find(RegionId $regionId): LeagueChampion
    {
        $row = $this->db->fetchAssociative("SELECT * FROM league_champions WHERE instance_id = :instanceId AND region = :regionId", [
            'instanceId' => $this->instanceId->value,
            'regionId'   => $regionId->value,
        ]);

        if ($row === false) {
            $eliteFourConfig = require __DIR__ . "/../../../Config/EliteFour.php";

            foreach ($eliteFourConfig as $regionalEliteFourConfig) {
                if ($regionalEliteFourConfig['region'] === $regionId) {
                    $championConfig = array_pop($regionalEliteFourConfig['members']);
                    return new LeagueChampion(
                        $regionId,
                        $championConfig['id'],
                    );
                }
            }

            throw new RuntimeException("Missing Elite Four configuration for '{$regionId->value}'");
        }

        return new LeagueChampion(
            $regionId,
            $row['trainer_id'],
        );
    }

    public function save(LeagueChampion $leagueChampion): void
    {
        $row = $this->db->fetchAssociative("SELECT * FROM league_champions WHERE instance_id = :instanceId AND region = :regionId", [
            'instanceId' => $this->instanceId->value,
            'regionId'   => $leagueChampion->regionId->value,
        ]);

        if ($row === false) {
            $this->db->insert("league_champions", [
                'instance_id' => $this->instanceId->value,
                'region'      => $leagueChampion->regionId->value,
                'trainer_id'  => $leagueChampion->trainerId,
                'updated_at'  => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin"))->format("Y-m-d H:i:s"),
            ]);
        } else {
            $this->db->update("league_champions", [
                'trainer_id' => $leagueChampion->trainerId,
                'updated_at' => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin"))->format("Y-m-d H:i:s"),
            ], [
                'instance_id' => $this->instanceId->value,
                'region'      => $leagueChampion->regionId->value,
            ]);
        }
    }
}
