<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use ConorSmith\Pokemon\Habit\Domain\Habit;
use ConorSmith\Pokemon\Habit\Domain\WeeklyHabitLogEntry;
use ConorSmith\Pokemon\Habit\Repositories\DailyHabitLogRepository;
use ConorSmith\Pokemon\Habit\Repositories\WeeklyHabitLogRepository;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostLogWeeklyReview
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly BagRepository $bagRepository,
        private readonly DailyHabitLogRepository $dailyHabitLogRepository,
        private readonly WeeklyHabitLogRepository $weeklyHabitLogRepository,
    ) {}

    public function __invoke(): void
    {
        $totalExcess = intval($_POST['total']);
        $mondayOfSubmittedWeek = CarbonImmutable::createFromFormat("Y-m-d", $_POST['date'])->midDay();

        if (!$mondayOfSubmittedWeek->isMonday()) {
            $this->session->getFlashBag()->add("errors", "Given date must be a Monday.");
            header("Location: /log/weekly-review");
            return;
        }

        if ($mondayOfSubmittedWeek->isFuture()) {
            $this->session->getFlashBag()->add("errors", "Given date cannot be in the future.");
            header("Location: /log/weekly-review");
            return;
        }

        $submittedWeek = CarbonPeriod::between($mondayOfSubmittedWeek, $mondayOfSubmittedWeek->addDays(6));

        $weeklyHabitLog = $this->weeklyHabitLogRepository->find(Habit::CALORIE_EXCESS);
        $foodDiaryHabitLog = $this->dailyHabitLogRepository->find(Habit::FOOD_DIARY_COMPLETED);
        $calorieGoalHabitLog = $this->dailyHabitLogRepository->find(Habit::CALORIE_GOAL_ATTAINED);
        $bag = $this->bagRepository->find();

        if ($weeklyHabitLog->isWeekLogged($submittedWeek)) {
            $formattedDate = $mondayOfSubmittedWeek->format("Y-m-d");
            $this->session->getFlashBag()->add("errors", "Week of '{$formattedDate}' has already been logged");
            header("Location: /log/weekly-review");
            return;
        }

        $grossBonus = $foodDiaryHabitLog->count($submittedWeek) + $calorieGoalHabitLog->count($submittedWeek);
        $penalty = intval(ceil($totalExcess / 500));
        $netBonus = max(0, $grossBonus - $penalty);
        $rareCandy = intval(floor($netBonus / 2));
        $challengeTokens = intval(ceil($netBonus / 2));

        $weeklyHabitLog = $weeklyHabitLog->record(new WeeklyHabitLogEntry(
            Uuid::uuid4(),
            $submittedWeek,
            $totalExcess
        ));
        $bag = $bag->add(ItemId::RARE_CANDY, $rareCandy);
        $bag = $bag->add(ItemId::CHALLENGE_TOKEN, $challengeTokens);

        $this->db->beginTransaction();

        $this->weeklyHabitLogRepository->save($weeklyHabitLog);
        $this->bagRepository->save($bag);

        $this->db->commit();

        $this->session->getFlashBag()->add("successes", "You earned {$rareCandy} Rare Candy!");
        $this->session->getFlashBag()->add("successes", "You earned {$challengeTokens} Challenge Tokens!");

        header("Location: /");
    }
}
