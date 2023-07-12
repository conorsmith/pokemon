<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Controllers;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Habit\Domain\EntryType;
use ConorSmith\Pokemon\Habit\Domain\Habit;
use ConorSmith\Pokemon\Habit\Domain\UnlimitedHabitLogEntry;
use ConorSmith\Pokemon\Habit\Repositories\UnlimitedHabitLogRepository;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\SharedKernel\ReduceEggCyclesCommand;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostLogExercise
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly BagRepository $bagRepository,
        private readonly UnlimitedHabitLogRepository $habitLogRepository,
        private readonly ReduceEggCyclesCommand $reduceEggCyclesCommand,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        if (!$request->request->has('date') && $request->request->get('earlier_date') === "") {
            $this->session->getFlashBag()->add("errors", "Given date is empty.");
            return new RedirectResponse("/{$args['instanceId']}/log/exercise");
        }

        if (!$request->request->has('date')) {
            $submittedDate = CarbonImmutable::createFromFormat("Y-m-d", $request->request->get('earlier_date'));
        } else {
            $submittedDate = CarbonImmutable::createFromFormat("Y-m-d", $request->request->get('date'));
        }

        $entryType = EntryType::from($request->request->get('type'));

        if ($submittedDate->isFuture()) {
            $this->session->getFlashBag()->add("errors", "Given date is in the future.");
            return new RedirectResponse("/{$args['instanceId']}/log/exercise");
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

        $this->reduceEggCyclesCommand->run(match($entryType) {
            EntryType::SHORT_WALK => 1,
            EntryType::LONG_WALK => 3,
            EntryType::RUN => 5,
        });

        $this->db->commit();

        $itemConfig = require __DIR__ . "/../../Config/Items.php";
        $this->session->getFlashBag()->add("successes", "You earned 1 {$itemConfig[$earnedItemId]['name']}!");

        return new RedirectResponse("/{$args['instanceId']}/");
    }
}
