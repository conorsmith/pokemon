<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostLogExercise
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly BagRepository $bagRepository,
    ) {}

    public function __invoke(): void
    {
        if ($_POST['date'] === "") {
            $this->session->getFlashBag()->add("errors", "Given date is empty.");
            header("Location: /log/exercise");
            exit;
        }

        $submittedDate = CarbonImmutable::createFromFormat("Y-m-d", $_POST['date']);

        if ($submittedDate->isFuture()) {
            $this->session->getFlashBag()->add("errors", "Given date is in the future.");
            header("Location: /log/exercise");
            exit;
        }

        $bag = $this->bagRepository->find();

        $bag = $bag->add(ItemId::POKE_BALL);

        $this->db->beginTransaction();

        $this->db->insert("log_exercise", [
            'id' => Uuid::uuid4(),
            'instance_id' => INSTANCE_ID,
            'date_logged' => $submittedDate->format("Y-m-d") . " 12:00:00",
        ]);

        $this->bagRepository->save($bag);

        $this->db->commit();

        $this->session->getFlashBag()->add("successes", "You earned 1 Poké Ball!");

        header("Location: /map/encounter");
        exit;
    }
}
