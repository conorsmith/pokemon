<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Repositories;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Battle\Domain\EliteFourChallenge;
use ConorSmith\Pokemon\Battle\Domain\EliteFourChallengeTeamMember;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use Doctrine\DBAL\Connection;
use Exception;

final class EliteFourChallengeRepository
{
    public function __construct(
        private readonly Connection $db,
    ) {}

    public function findActive(): ?EliteFourChallenge
    {
        $row = $this->db->fetchAssociative("SELECT * FROM elite_four_challenges WHERE date_completed IS NULL");

        if ($row === false) {
            return null;
        }

        return self::createFromRow($row);
    }

    public function findVictoryInRegion(RegionId $region): ?EliteFourChallenge
    {
        $row = $this->db->fetchAssociative("SELECT * FROM elite_four_challenges WHERE date_completed IS NOT NULL AND victory = 1 AND region = :region", [
            'region' => $region->value,
        ]);

        if ($row === false) {
            return null;
        }

        return self::createFromRow($row);
    }

    public function findCurrentPokemonLeagueRegion(): RegionId
    {
        $rows = $this->db->fetchAllAssociative("SELECT * FROM elite_four_challenges WHERE date_completed IS NOT NULL AND victory = 1");

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

    private static function createFromRow(array $row): EliteFourChallenge
    {
        if ($row['team'] === "null") {
            throw new Exception("Outdated data, 'team' value is missing");
        }

        $region = RegionId::from($row['region']);

        $team = array_map(
            fn(array $member) => new EliteFourChallengeTeamMember(
                $member['id'],
                $member['pokedexNumber'],
                $member['form'],
                $member['level'],
            ),
            json_decode($row['team'], true),
        );

        return self::createEliteFourChallenge(
            $row['id'],
            $region,
            $team,
            $row['stage'],
            $row['victory'] === 1,
            null
        );
    }

    public function save(EliteFourChallenge $eliteFourChallenge): void
    {
        $row = $this->db->fetchAssociative("SELECT * FROM elite_four_challenges WHERE id = :id", [
            'id' => $eliteFourChallenge->id,
        ]);

        if ($row === false) {
            $this->db->insert("elite_four_challenges", [
                'id'           => $eliteFourChallenge->id,
                'team'         => json_encode(array_map(
                    fn(EliteFourChallengeTeamMember $member) => [
                        'id'            => $member->id,
                        'pokedexNumber' => $member->pokedexNumber,
                        'form'          => $member->form,
                        'level'         => $member->level,
                    ],
                    $eliteFourChallenge->team,
                )),
                'region'       => $eliteFourChallenge->region->value,
                'stage'        => $eliteFourChallenge->stage,
                'victory'      => 0,
                'date_started' => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin"))->format("Y-m-d H:i:s"),
            ]);
        } else {
            $this->db->update("elite_four_challenges", [
                'region'       => $eliteFourChallenge->region->value,
                'stage'        => $eliteFourChallenge->stage,
                'victory'      => $eliteFourChallenge->victory ? 1 : 0,
                'date_completed' => $eliteFourChallenge->dateCompleted ? $eliteFourChallenge->dateCompleted->format("Y-m-d H:i:s") : null,
            ], [
                'id' => $eliteFourChallenge->id,
            ]);
        }
    }

    public static function createEliteFourChallenge(
        string $id,
        RegionId $region,
        array $team,
        int $stage,
        bool $victory,
        ?CarbonImmutable $dateCompleted,
    ): EliteFourChallenge {
        $eliteFourConfig = self::findEliteFourConfig($region);

        $memberIds = array_map(
            fn (array $config) => $config['id'],
            $eliteFourConfig['members'],
        );

        return new EliteFourChallenge(
            $id,
            $region,
            $memberIds,
            $team,
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
