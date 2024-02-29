<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Controllers;

use ConorSmith\Pokemon\Location\UseCase\FinishSurveyingPokemon;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostSurveyPokemonFinish
{
    public function __construct(
        private readonly FinishSurveyingPokemon $finishSurveyingPokemon,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $instanceId = $args['instanceId'];
        $encounterType = $args['encounterType'];

        $result = $this->finishSurveyingPokemon->run();

        if ($result->hasNoActiveSurvey()) {
            $this->notifyPlayerCommand->run(
                Notification::transient("No active survey"),
            );
            return new RedirectResponse("/{$instanceId}/map/pokemon");
        }

        if ($result->surveyIsComplete()) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Completed surveying this location"),
            );
        }

        return new RedirectResponse("/{$instanceId}/survey-pokemon/{$encounterType}");
    }
}
