<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Controllers;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Habit\Domain\Habit;
use ConorSmith\Pokemon\Habit\Repositories\DailyHabitLogRepository;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostLogFoodDiary
{
    public function __construct(
        private readonly Connection              $db,
        private readonly DailyHabitLogRepository $habitLogRepository,
        private readonly BagRepository           $bagRepository,
        private readonly NotifyPlayerCommand     $notifyPlayerCommand,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        if ($request->request->get('date') === "") {
            $this->notifyPlayerCommand->run(
                Notification::transient("Given date is empty.")
            );
            return new RedirectResponse("/{$args['instanceId']}/log/food-diary");
        }

        $submittedDate = CarbonImmutable::createFromFormat("Y-m-d", $request->request->get('date'));

        if ($submittedDate->isFuture()) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Given date cannot be in the future.")
            );
            return new RedirectResponse("/{$args['instanceId']}/log/food-diary");
        }

        $habitLog = $this->habitLogRepository->find(Habit::FOOD_DIARY_COMPLETED);
        $bag = $this->bagRepository->find();

        if ($habitLog->doesDatePredateLog($submittedDate)) {
            $formattedDate = $submittedDate->format("Y-m-d");
            $this->notifyPlayerCommand->run(
                Notification::transient("Date '{$formattedDate}' is before you began logging")
            );
            return new RedirectResponse("/{$args['instanceId']}/log/food-diary");
        }

        if ($habitLog->isDateLogged($submittedDate)) {
            $formattedDate = $submittedDate->format("Y-m-d");
            $this->notifyPlayerCommand->run(
                Notification::transient("Date '{$formattedDate}' has already been logged")
            );
            return new RedirectResponse("/{$args['instanceId']}/log/food-diary");
        }

        $habitLog = $habitLog->record($submittedDate);
        $bag = $bag->add(ItemId::RARE_CANDY);

        $this->db->beginTransaction();

        $this->habitLogRepository->save($habitLog);
        $this->bagRepository->save($bag);

        $this->db->commit();

        $this->notifyPlayerCommand->run(
            Notification::persistent("You earned 1 Rare Candy!")
        );

        return new RedirectResponse("/{$args['instanceId']}/");
    }
}
