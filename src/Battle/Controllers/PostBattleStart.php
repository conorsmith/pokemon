<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\UseCases\StartABattle;
use ConorSmith\Pokemon\SharedKernel\UseCases\SpendChallengeTokensUseCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostBattleStart
{
    public function __construct(
        private readonly Session $session,
        private readonly StartABattle $startABattleUseCase,
        private readonly SpendChallengeTokensUseCase $spendChallengeTokensUseCase,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $trainerId = $args['id'];

        $result = $this->spendChallengeTokensUseCase->__invoke();

        if (!$result->succeeded) {
            $this->session->getFlashBag()->add("errors", "No unused challenge tokens remaining.");
            return new RedirectResponse("/{$args['instanceId']}/map");
        }

        $result = $this->startABattleUseCase->__invoke($trainerId);

        return new RedirectResponse("/{$args['instanceId']}/battle/{$result->id}");
    }
}
