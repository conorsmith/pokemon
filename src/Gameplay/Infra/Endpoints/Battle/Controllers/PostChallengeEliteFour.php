<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers;

use ConorSmith\Pokemon\Gameplay\Domain\Battle\EliteFourChallengePartyMember;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\PlayerRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\Pokemon;
use ConorSmith\Pokemon\Gameplay\App\UseCases\StartABattle;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostChallengeEliteFour
{
    public function __construct(
        private readonly BagRepository $bagRepository,
        private readonly PlayerRepository $playerRepository,
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
        private readonly StartABattle $startABattleUseCase,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $region = RegionId::tryFrom($args['region']);

        if (is_null($region)) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Unknown region")
            );
            return new RedirectResponse("/{$args['instanceId']}/map");
        }

        $bag = $this->bagRepository->find();
        $player = $this->playerRepository->findPlayer();

        if ($bag->count(ItemId::CHALLENGE_TOKEN) < 5) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Not enough unused challenge tokens.")
            );
            return new RedirectResponse("/{$args['instanceId']}/map");
        }

        $bag = $bag->use(ItemId::CHALLENGE_TOKEN, 5);

        $eliteFourChallenge = $this->eliteFourChallengeRepository->createEliteFourChallenge(
            Uuid::uuid4()->toString(),
            $region,
            null,
            array_map(
                fn(Pokemon $pokemon) => new EliteFourChallengePartyMember(
                    $pokemon->id,
                    $pokemon->number,
                    $pokemon->form,
                    $pokemon->level,
                ),
                $player->party,
            ),
            0,
            false,
            null,
        );

        $this->bagRepository->save($bag);
        $this->eliteFourChallengeRepository->save($eliteFourChallenge);

        $result = $this->startABattleUseCase->__invoke($eliteFourChallenge->getMemberIdForCurrentStage());

        if (!$result->succeeded()) {
            $this->notifyPlayerCommand->run(
                Notification::transient("No unused challenge tokens remaining.")
            );
            return new RedirectResponse("/{$args['instanceId']}/map");
        }

        return new RedirectResponse("/{$args['instanceId']}/battle/{$result->id}");
    }
}
