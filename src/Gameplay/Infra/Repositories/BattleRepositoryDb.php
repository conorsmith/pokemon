<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Repositories;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\Battle;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\BattleRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\LeagueChampionRepository;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\TrainerConfigRepository;
use Doctrine\DBAL\Connection;

final class BattleRepositoryDb implements BattleRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly TrainerConfigRepository $trainerConfigRepository,
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
        private readonly LeagueChampionRepository $leagueChampionRepository,
        private readonly InstanceId $instanceId,
    ) {}

    public function find(string $id): ?Battle
    {
        $battleRow = $this->db->fetchAssociative("SELECT * FROM trainer_battles WHERE instance_id = :instanceId AND id = :id", [
            'instanceId' => $this->instanceId->value,
            'id'         => $id,
        ]);

        if ($battleRow === false) {
            return null;
        }

        return new Battle(
            $battleRow['id'],
            $battleRow['trainer_id'],
            $battleRow['is_player_challenger'] === 1,
            is_null($battleRow['date_last_beaten'])
                ? null
                : CarbonImmutable::createFromFormat(
                "Y-m-d H:i:s",
                $battleRow['date_last_beaten'],
                new CarbonTimeZone("Europe/Dublin")
            ),
            $battleRow['battle_count']
        );
    }

    public function findForTrainer(string $trainerId): ?Battle
    {
        $battleRow = $this->db->fetchAssociative("SELECT * FROM trainer_battles WHERE instance_id = :instanceId AND trainer_id = :trainerId", [
            'instanceId' => $this->instanceId->value,
            'trainerId'  => $trainerId,
        ]);

        if ($battleRow === false) {
            return null;
        }

        return new Battle(
            $battleRow['id'],
            $battleRow['trainer_id'],
            $battleRow['is_player_challenger'] === 1,
            is_null($battleRow['date_last_beaten'])
                ? null
                : CarbonImmutable::createFromFormat(
                "Y-m-d H:i:s",
                $battleRow['date_last_beaten'],
                new CarbonTimeZone("Europe/Dublin")
            ),
            $battleRow['battle_count']
        );
    }

    public function findBattlesInLocation(string $locationId): array
    {
        $config = $this->trainerConfigRepository->findTrainersInLocation($locationId);

        if (is_null($config)) {
            return [];
        }

        $battles = [];

        foreach ($config as $entry) {

            if (array_key_exists('prerequisite', $entry)
                && array_key_exists('victory', $entry['prerequisite'])
            ) {
                $eliteFourChallenge = $this->eliteFourChallengeRepository->findPlayerVictoryInRegion($entry['prerequisite']['victory']);
                if (is_null($eliteFourChallenge)) {
                    continue;
                }
            }

            if (array_key_exists('prerequisite', $entry)
                && array_key_exists('champion', $entry['prerequisite'])
            ) {
                $leagueChampion = $this->leagueChampionRepository->find($entry['prerequisite']['champion']);
                if (!$leagueChampion->isPlayer()) {
                    continue;
                }
            }

            $battles[] = $this->findForTrainer($entry['id']);
        }

        return $battles;
    }

    public function save(Battle $battle): void
    {
        if (is_null($this->find($battle->id))) {
            $this->db->insert("trainer_battles", [
                'id'               => $battle->id,
                'instance_id'      => $this->instanceId->value,
                'trainer_id'       => $battle->trainerId,
                'date_last_beaten' => is_null($battle->dateLastBeaten)
                    ? null
                    : $battle->dateLastBeaten->format("Y-m-d H:i:s"),
                'battle_count'     => $battle->battleCount,

                'is_battling'          => 0,
                'is_player_challenger' => $battle->isPlayerChallenger ? 1 : 0,
                'active_pokemon'       => 0,
            ]);
        } else {
            $this->db->update("trainer_battles", [
                'trainer_id'           => $battle->trainerId,
                'date_last_beaten'     => is_null($battle->dateLastBeaten)
                    ? null
                    : $battle->dateLastBeaten->format("Y-m-d H:i:s"),
                'is_player_challenger' => $battle->isPlayerChallenger ? 1 : 0,
                'battle_count'         => $battle->battleCount,
            ], [
                'id'          => $battle->id,
                'instance_id' => $this->instanceId->value,
            ]);
        }
    }
}
