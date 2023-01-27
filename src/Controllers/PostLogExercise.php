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
        if (!isset($_POST['date']) && $_POST['earlier_date'] === "") {
            $this->session->getFlashBag()->add("errors", "Given date is empty.");
            header("Location: /log/exercise");
            exit;
        }

        if (!isset($_POST['date'])) {
            $submittedDate = CarbonImmutable::createFromFormat("Y-m-d", $_POST['earlier_date']);
        } else {
            $submittedDate = CarbonImmutable::createFromFormat("Y-m-d", $_POST['date']);
        }

        if ($submittedDate->isFuture()) {
            $this->session->getFlashBag()->add("errors", "Given date is in the future.");
            header("Location: /log/exercise");
            exit;
        }

        $earnedItemId = match($_POST['type']) {
            "short-walk" => ItemId::POKE_BALL,
            "long-walk" => ItemId::GREAT_BALL,
            "run" => ItemId::ULTRA_BALL,
        };

        $bag = $this->bagRepository->find();

        $bag = $bag->add($earnedItemId);

        $this->db->beginTransaction();

        $this->db->insert("log_exercise", [
            'id' => Uuid::uuid4(),
            'instance_id' => INSTANCE_ID,
            'type' => $_POST['type'],
            'date_logged' => $submittedDate->format("Y-m-d") . " 12:00:00",
        ]);

        $this->bagRepository->save($bag);

        $this->db->commit();

        $itemConfig = require __DIR__ . "/../Config/Items.php";
        $this->session->getFlashBag()->add("successes", "You earned 1 {$itemConfig[$earnedItemId]['name']}!");

        header("Location: /");
        exit;
    }
}
