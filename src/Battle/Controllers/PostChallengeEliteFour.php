<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Battle\UseCase\StartABattle;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\Region;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostChallengeEliteFour
{
    public function __construct(
        private readonly Session $session,
        private readonly BagRepository $bagRepository,
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
        private readonly StartABattle $startABattleUseCase,
    ) {}

    public function __invoke(array $args): void
    {
        $region = Region::tryFrom($args['region']);

        if (is_null($region)) {
            $this->session->getFlashBag()->add("errors", "Unknown region");
            header("Location: /map");
            return;
        }

        $bag = $this->bagRepository->find();

        if ($bag->count(ItemId::CHALLENGE_TOKEN) < 5) {
            $this->session->getFlashBag()->add("errors", "Not enough unused challenge tokens.");
            header("Location: /map");
            return;
        }

        $bag = $bag->use(ItemId::CHALLENGE_TOKEN, 5);

        $eliteFourChallenge = EliteFourChallengeRepository::createEliteFourChallenge(
            Uuid::uuid4()->toString(),
            $region,
            0,
            false,
            null,
        );

        $this->bagRepository->save($bag);
        $this->eliteFourChallengeRepository->save($eliteFourChallenge);

        $result = $this->startABattleUseCase->__invoke($eliteFourChallenge->getMemberIdForCurrentStage());

        if (!$result->succeeded()) {
            $this->session->getFlashBag()->add("errors", "No unused challenge tokens remaining.");
            header("Location: /map");
            return;
        }

        header("Location: /battle/{$result->id}");
    }
}
