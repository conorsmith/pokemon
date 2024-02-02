<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\UseCases\StartABattle;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use ConorSmith\Pokemon\SharedKernel\UseCases\SpendChallengeTokensUseCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostBattleStart
{
    public function __construct(
        private readonly StartABattle $startABattleUseCase,
        private readonly SpendChallengeTokensUseCase $spendChallengeTokensUseCase,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $trainerId = $args['id'];

        $result = $this->spendChallengeTokensUseCase->__invoke();

        if (!$result->succeeded) {
            $this->notifyPlayerCommand->run(
                Notification::transient("No unused challenge tokens remaining.")
            );
            return new RedirectResponse("/{$args['instanceId']}/map/trainers");
        }

        $result = $this->startABattleUseCase->__invoke($trainerId);

        return new RedirectResponse("/{$args['instanceId']}/battle/{$result->id}");
    }
}
