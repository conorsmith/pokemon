<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\UseCase\StartABattle;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostBattleStart
{
    public function __construct(
        private readonly Session $session,
        private readonly StartABattle $startABattleUseCase,
    ) {}

    public function __invoke(array $args): void
    {
        $trainerId = $args['id'];

        $result = $this->startABattleUseCase->__invoke($trainerId);

        if (!$result->succeeded()) {
            $this->session->getFlashBag()->add("errors", "No unused challenge tokens remaining.");
            header("Location: /map");
            return;
        }

        header("Location: /battle/{$result->id}");
    }
}
