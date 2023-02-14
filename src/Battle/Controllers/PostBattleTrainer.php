<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;
use ConorSmith\Pokemon\SharedKernel\ReportBattleWithGymLeaderCommand;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\ItemId;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostBattleTrainer
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly PlayerRepository $playerRepository,
        private readonly TrainerRepository $trainerRepository,
        private readonly BagRepository $bagRepository,
        private readonly ReportBattleWithGymLeaderCommand $reportBattleWithGymLeaderCommand,
    ) {}

    public function __invoke(array $args): void
    {
        $trainerId = $args['id'];

        $bag = $this->bagRepository->find();

        if (!$bag->has(ItemId::CHALLENGE_TOKEN)) {
            $this->session->getFlashBag()->add("errors", "No unused challenge tokens remaining.");
            header("Location: /map");
            exit;
        }

        $trainer = $this->trainerRepository->findTrainerByTrainerId($trainerId);

        if ($trainer->isGymLeader()) {
            $player = $this->playerRepository->findPlayer();
            $this->reportBattleWithGymLeaderCommand->run(array_map(
                fn(Pokemon $pokemon) => $pokemon->id,
                $player->team,
            ));
        }

        $trainer = $trainer->startBattle();
        $bag = $bag->use(ItemId::CHALLENGE_TOKEN);

        $this->db->beginTransaction();

        $this->trainerRepository->saveTrainer($trainer);
        $this->bagRepository->save($bag);

        $this->db->commit();

        header("Location: /battle/{$trainer->id}");
    }
}
