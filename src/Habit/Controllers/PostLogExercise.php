<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Controllers;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Habit\Domain\EntryType;
use ConorSmith\Pokemon\Habit\Domain\Habit;
use ConorSmith\Pokemon\Habit\Domain\UnlimitedHabitLogEntry;
use ConorSmith\Pokemon\Habit\Repositories\UnlimitedHabitLogRepository;
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
        private readonly UnlimitedHabitLogRepository $habitLogRepository,
    ) {}

    public function __invoke(): void
    {
        if (!isset($_POST['date']) && $_POST['earlier_date'] === "") {
            $this->session->getFlashBag()->add("errors", "Given date is empty.");
            header("Location: /log/exercise");
            return;
        }

        if (!isset($_POST['date'])) {
            $submittedDate = CarbonImmutable::createFromFormat("Y-m-d", $_POST['earlier_date']);
        } else {
            $submittedDate = CarbonImmutable::createFromFormat("Y-m-d", $_POST['date']);
        }

        $entryType = EntryType::from($_POST['type']);

        if ($submittedDate->isFuture()) {
            $this->session->getFlashBag()->add("errors", "Given date is in the future.");
            header("Location: /log/exercise");
            return;
        }

        $habitLog = $this->habitLogRepository->find(Habit::EXERCISE);
        $bag = $this->bagRepository->find();

        $earnedItemId = match($entryType) {
            EntryType::SHORT_WALK => ItemId::POKE_BALL,
            EntryType::LONG_WALK => ItemId::GREAT_BALL,
            EntryType::RUN => ItemId::ULTRA_BALL,
        };

        $habitLog = $habitLog->record(new UnlimitedHabitLogEntry(
            Uuid::uuid4(),
            $submittedDate,
            $entryType,
        ));
        $bag = $bag->add($earnedItemId);

        $this->db->beginTransaction();

        $this->habitLogRepository->save($habitLog);
        $this->bagRepository->save($bag);

        $this->db->commit();

        $itemConfig = require __DIR__ . "/../../Config/Items.php";
        $this->session->getFlashBag()->add("successes", "You earned 1 {$itemConfig[$earnedItemId]['name']}!");

        header("Location: /");
    }
}
