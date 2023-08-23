<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Controllers;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Habit\Domain\Habit;
use ConorSmith\Pokemon\Habit\Repositories\DailyHabitLogRepository;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostLogStretches
{
    public function __construct(
        private readonly Connection              $db,
        private readonly Session                 $session,
        private readonly DailyHabitLogRepository $habitLogRepository,
        private readonly BagRepository           $bagRepository,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        if ($request->request->get('date') === "") {
            $this->session->getFlashBag()->add("errors", "Given date is empty.");
            return new RedirectResponse("/{$args['instanceId']}/log/stretches/");
        }

        $submittedDate = CarbonImmutable::createFromFormat("Y-m-d", $request->request->get('date'));

        if ($submittedDate->isFuture()) {
            $this->session->getFlashBag()->add("errors", "Given date is in the future.");
            return new RedirectResponse("/{$args['instanceId']}/log/stretches/");
        }

        $habitLog = $this->habitLogRepository->find(Habit::STRETCHES_COMPLETED);
        $bag = $this->bagRepository->find();

        if ($habitLog->isDateLogged($submittedDate)) {
            $formattedDate = $submittedDate->format("Y-m-d");
            $this->session->getFlashBag()->add("errors", "Date '{$formattedDate}' has already been logged");
            return new RedirectResponse("/{$args['instanceId']}/log/stretches/");
        }

        $habitLog = $habitLog->record($submittedDate);
        $bag = $bag->add(ItemId::OVAL_CHARM);

        $this->db->beginTransaction();

        $this->habitLogRepository->save($habitLog);
        $this->bagRepository->save($bag);

        $this->db->commit();

        $this->session->getFlashBag()->add("successes", "You earned 1 Oval Charm!");

        return new RedirectResponse("/{$args['instanceId']}/");
    }
}