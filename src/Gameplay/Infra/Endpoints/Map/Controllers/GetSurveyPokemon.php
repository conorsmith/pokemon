<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\Controllers;

use ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository;
use ConorSmith\Pokemon\Gameplay\App\UseCases\ShowActiveSurvey;
use ConorSmith\Pokemon\Gameplay\App\UseCases\ShowSurveyRecord;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\ViewModels\ViewModelFactory;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use ConorSmith\Pokemon\TemplateEngine;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetSurveyPokemon
{
    public function __construct(
        private readonly LocationRepository $locationRepository,
        private readonly ShowActiveSurvey $showActiveSurvey,
        private readonly ShowSurveyRecord $showSurveyRecord,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly TemplateEngine $templateEngine,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $instanceId = $args['instanceId'];
        $encounterType = $args['encounterType'];

        $location = $this->locationRepository->findCurrentLocation();

        $activeSurveyResult = $this->showActiveSurvey->run($encounterType);

        if ($activeSurveyResult->hasActiveSurvey()) {
            return new Response($this->templateEngine->render(__DIR__ . "/../Templates/ActiveSurvey.php", [
                'currentLocation' => $this->viewModelFactory->createLocationName($location),
                'activeSurvey'    => $activeSurveyResult->getViewModel(),
            ]));
        }

        $surveyRecordResult = $this->showSurveyRecord->run($location, $encounterType);

        if ($surveyRecordResult->failed()) {
            $this->notifyPlayerCommand->run(
                Notification::transient("No {$encounterType} encounters in this location"),
            );
            return new RedirectResponse("/{$instanceId}/map/pokemon");
        }

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/SurveyRecord.php", [
            'currentLocation' => $this->viewModelFactory->createLocationName($location),
            'surveyRecord'    => $surveyRecordResult->getViewModel(),
        ]));
    }
}
