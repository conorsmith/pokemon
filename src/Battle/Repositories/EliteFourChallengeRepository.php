<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Repositories;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Battle\Domain\EliteFourChallenge;
use ConorSmith\Pokemon\Battle\Domain\EliteFourChallengePartyMember;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;
use Exception;

final class EliteFourChallengeRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly LeagueChampionRepository $leagueChampionRepository,
        private readonly InstanceId $instanceId,
    ) {}

    public function findActive(): ?EliteFourChallenge
    {
        $row = $this->db->fetchAssociative("
            SELECT *
            FROM elite_four_challenges
            WHERE instance_id = :instanceId
                AND date_completed IS NULL
        ", [
            'instanceId' => $this->instanceId->value,
        ]);

        if ($row === false) {
            return null;
        }

        return $this->createFromRow($row);
    }

    public function findPlayerVictoryInRegion(RegionId $region): ?EliteFourChallenge
    {
        $row = $this->db->fetchAssociative("
            SELECT *
            FROM elite_four_challenges
            WHERE instance_id = :instanceId
                AND trainer_id IS NULL
                AND date_completed IS NOT NULL
                AND victory = 1
                AND region = :region
            ", [
            'instanceId' => $this->instanceId->value,
            'region'     => $region->value,
        ]);

        if ($row === false) {
            return null;
        }

        return $this->createFromRow($row);
    }

    public function findAllVictoriesInRegion(RegionId $region): array
    {
        $rows = $this->db->fetchAllAssociative("
            SELECT *
            FROM elite_four_challenges
            WHERE instance_id = :instanceId
                AND date_completed IS NOT NULL
                AND victory = 1
                AND region = :region
            ORDER BY date_completed DESC
        ", [
            'instanceId' => $this->instanceId->value,
            'region'     => $region->value,
        ]);

        return array_map(
            fn($row) => $this->createFromRow($row),
            $rows,
        );
    }

    public function findCurrentPokemonLeagueRegionForPlayer(): RegionId
    {
        $rows = $this->db->fetchAllAssociative("
            SELECT *
            FROM elite_four_challenges
            WHERE instance_id = :instanceId
                AND trainer_id IS NULL
                AND date_completed IS NOT NULL
                AND victory = 1
        ", [
            'instanceId' => $this->instanceId->value,
        ]);

        $regionsWithVictory = array_map(
            fn(array $row) => RegionId::from($row['region']),
            $rows
        );

        foreach (RegionId::all() as $region) {
            if (!in_array($region, $regionsWithVictory)) {
                return $region;
            }
        }

        throw new Exception("Victory in all Pokemon Leagues");
    }

    private function createFromRow(array $row): EliteFourChallenge
    {
        if ($row['party'] === "null") {
            throw new Exception("Outdated data, 'party' value is missing");
        }

        $region = RegionId::from($row['region']);

        $party = array_map(
            fn(array $member) => new EliteFourChallengePartyMember(
                $member['id'],
                $member['pokedexNumber'],
                $member['form'],
                $member['level'],
            ),
            json_decode($row['party'], true),
        );

        return $this->createEliteFourChallenge(
            $row['id'],
            $region,
            $row['trainer_id'],
            $party,
            $row['stage'],
            $row['victory'] === 1,
            is_null($row['date_completed']) ? null : new CarbonImmutable($row['date_completed'], "Europe/Dublin"),
        );
    }

    public function save(EliteFourChallenge $eliteFourChallenge): void
    {
        $row = $this->db->fetchAssociative("
            SELECT *
            FROM elite_four_challenges
            WHERE instance_id = :instanceId
                AND id = :id
        ", [
            'instanceId' => $this->instanceId->value,
            'id'         => $eliteFourChallenge->id,
        ]);

        if ($row === false) {
            $this->db->insert("elite_four_challenges", [
                'id'           => $eliteFourChallenge->id,
                'instance_id'  => $this->instanceId->value,
                'region'       => $eliteFourChallenge->region->value,
                'trainer_id'   => $eliteFourChallenge->trainerId,
                'party'        => json_encode(array_map(
                    fn(EliteFourChallengePartyMember $member) => [
                        'id'            => $member->id,
                        'pokedexNumber' => $member->pokedexNumber,
                        'form'          => $member->form,
                        'level'         => $member->level,
                    ],
                    $eliteFourChallenge->party,
                )),
                'stage'        => $eliteFourChallenge->stage,
                'victory'      => 0,
                'date_started' => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin"))->format("Y-m-d H:i:s"),
            ]);
        } else {
            $this->db->update("elite_four_challenges", [
                'region'         => $eliteFourChallenge->region->value,
                'trainer_id'     => $eliteFourChallenge->trainerId,
                'stage'          => $eliteFourChallenge->stage,
                'victory'        => $eliteFourChallenge->victory ? 1 : 0,
                'date_completed' => $eliteFourChallenge->dateCompleted ? $eliteFourChallenge->dateCompleted->format("Y-m-d H:i:s") : null,
            ], [
                'id'          => $eliteFourChallenge->id,
                'instance_id' => $this->instanceId->value,
            ]);
        }
    }

    public function createEliteFourChallenge(
        string $id,
        RegionId $regionId,
        ?string $trainerId,
        array $party,
        int $stage,
        bool $victory,
        ?CarbonImmutable $dateCompleted,
    ): EliteFourChallenge {
        $eliteFourConfig = self::findEliteFourConfig($regionId);

        $memberIds = array_map(
            fn (array $config) => $config['id'],
            $eliteFourConfig['members'],
        );

        $regionalChampion = $this->leagueChampionRepository->find($regionId);

        $memberIds = array_slice($memberIds, 0, -1);
        $memberIds[] = $regionalChampion->trainerId;

        return new EliteFourChallenge(
            $id,
            $regionId,
            $trainerId,
            $memberIds,
            $party,
            $stage,
            $victory,
            $dateCompleted,
        );
    }

    private static function findEliteFourConfig(RegionId $region): ?array
    {
        $eliteFourConfig = require __DIR__ . "/../../Config/EliteFour.php";

        foreach ($eliteFourConfig as $config) {
            if ($config['region'] === $region) {
                return $config;
            }
        }

        return null;
    }
}
