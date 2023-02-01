<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Controllers;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Habit\Domain\Habit;
use ConorSmith\Pokemon\Habit\Repositories\DailyHabitLogRepository;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostLogFoodDiary
{
    public function __construct(
        private readonly Connection              $db,
        private readonly Session                 $session,
        private readonly DailyHabitLogRepository $habitLogRepository,
        private readonly BagRepository           $bagRepository,
    ) {}

    public function __invoke(): void
    {
        if ($_POST['date'] === "") {
            $this->session->getFlashBag()->add("errors", "Given date is empty.");
            header("Location: /log/food-diary");
            return;
        }

        $submittedDate = CarbonImmutable::createFromFormat("Y-m-d", $_POST['date']);

        if ($submittedDate->isFuture()) {
            $this->session->getFlashBag()->add("errors", "Given date cannot be in the future.");
            header("Location: /log/food-diary");
            return;
        }

        $habitLog = $this->habitLogRepository->find(Habit::FOOD_DIARY_COMPLETED);
        $bag = $this->bagRepository->find();

        if ($habitLog->isDateLogged($submittedDate)) {
            $formattedDate = $submittedDate->format("Y-m-d");
            $this->session->getFlashBag()->add("errors", "Date '{$formattedDate}' has already been logged");
            header("Location: /log/food-diary");
            return;
        }

        $habitLog = $habitLog->record($submittedDate);
        $bag = $bag->add(ItemId::RARE_CANDY);

        $this->db->beginTransaction();

        $this->habitLogRepository->save($habitLog);
        $this->bagRepository->save($bag);

        $this->db->commit();

        $this->session->getFlashBag()->add("successes", "You earned 1 Rare Candy!");

        header("Location: /");
    }
}
