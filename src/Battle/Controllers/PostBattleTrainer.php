<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\Domain\GameInstance;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostBattleTrainer
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly TrainerRepository $trainerRepository,
    ) {}

    public function __invoke(array $args): void
    {
        $trainerId = $args['id'];

        $gameInstance = $this->findGameInstance();

        if (!$gameInstance->hasUnusedChallengeTokens()) {
            $this->session->getFlashBag()->add("errors", "No unused challenge tokens remaining.");
            header("Location: /map/encounter");
            exit;
        }

        $trainer = $this->trainerRepository->findTrainerByTrainerId($trainerId);

        $trainer = $trainer->startBattle();
        $gameInstance = $gameInstance->useAChallengeToken();

        $this->db->beginTransaction();

        $this->trainerRepository->saveTrainer($trainer);
        $this->saveGameInstance($gameInstance);

        $this->db->commit();

        header("Location: /battle/{$trainer->id}");
    }

    private function findGameInstance(): GameInstance
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        return new GameInstance(
            INSTANCE_ID,
            $instanceRow['money'],
            $instanceRow['unused_level_ups'],
            $instanceRow['unused_moves'],
            $instanceRow['unused_encounters'],
        );
    }

    private function saveGameInstance(GameInstance $gameInstance): void
    {
        $this->db->update("instances", [
            'money' => $gameInstance->money,
            'unused_moves' => $gameInstance->unusedChallengeTokens,
        ], [
            'id' => $gameInstance->id,
        ]);
    }
}
