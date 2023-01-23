<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

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
        private readonly TrainerRepository $trainerRepository,
        private readonly BagRepository $bagRepository,
    ) {}

    public function __invoke(array $args): void
    {
        $trainerId = $args['id'];

        $bag = $this->bagRepository->find();

        if (!$bag->has(ItemId::CHALLENGE_TOKEN)) {
            $this->session->getFlashBag()->add("errors", "No unused challenge tokens remaining.");
            header("Location: /map/encounter");
            exit;
        }

        $trainer = $this->trainerRepository->findTrainerByTrainerId($trainerId);

        $trainer = $trainer->startBattle();
        $bag = $bag->use(ItemId::CHALLENGE_TOKEN);

        $this->db->beginTransaction();

        $this->trainerRepository->saveTrainer($trainer);
        $this->bagRepository->save($bag);

        $this->db->commit();

        header("Location: /battle/{$trainer->id}");
    }
}
