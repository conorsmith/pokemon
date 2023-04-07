<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Repositories;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Battle\Domain\EliteFourChallenge;
use ConorSmith\Pokemon\SharedKernel\Domain\Region;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;

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

    public function findVictoryInRegion(Region $region): ?EliteFourChallenge
    {
        $row = $this->db->fetchAssociative("SELECT * FROM elite_four_challenges WHERE date_completed IS NOT NULL AND victory = 1 AND region = :region", [
            'region' => $region->value,
        ]);

        if ($row === false) {
            return null;
        }

        return self::createFromRow($row);
    }

    private static function createFromRow(array $row): EliteFourChallenge
    {
        $region = Region::from($row['region']);

        return self::createEliteFourChallenge(
            $row['id'],
            $region,
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
        Region $region,
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
            $stage,
            $victory,
            $dateCompleted,
        );
    }

    private static function findEliteFourConfig(Region $region): ?array
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
