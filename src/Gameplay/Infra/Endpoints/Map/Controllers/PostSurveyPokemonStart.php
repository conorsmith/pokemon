<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\Controllers;

use ConorSmith\Pokemon\Gameplay\App\UseCases\StartSurveyingPokemon;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostSurveyPokemonStart
{
    public function __construct(
        private readonly StartSurveyingPokemon $startSurveyingPokemon,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $instanceId = $args['instanceId'];
        $encounterType = $args['encounterType'];

        $result = $this->startSurveyingPokemon->run($encounterType);

        if ($result->hasNoWildEncounters()) {
            $this->notifyPlayerCommand->run(
                Notification::transient("There are no Pokémon here to survey")
            );
            return new RedirectResponse("/{$instanceId}/map/pokemon");
        }

        if ($result->hasActiveSurvey()) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Survey already in progress")
            );
            return new RedirectResponse("/{$instanceId}/map/pokemon");
        }

        return new RedirectResponse("/{$instanceId}/survey-pokemon/{$encounterType}");
    }
}
