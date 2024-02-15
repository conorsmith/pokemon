<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\System;

use ConorSmith\Pokemon\Battle\Controllers\GetBattle;
use ConorSmith\Pokemon\Battle\Controllers\GetEncounter;
use ConorSmith\Pokemon\Battle\Controllers\GetSwitch;
use ConorSmith\Pokemon\Battle\Controllers\PostBattleFight;
use ConorSmith\Pokemon\Battle\Controllers\PostBattleFinish;
use ConorSmith\Pokemon\Battle\Controllers\PostEncounterCatch;
use ConorSmith\Pokemon\Battle\Controllers\PostEncounterFight;
use ConorSmith\Pokemon\Battle\Controllers\PostEncounterRun;
use ConorSmith\Pokemon\Battle\Controllers\PostSwitch;
use ConorSmith\Pokemon\Habit\Controllers\GetLogCalorieGoal;
use ConorSmith\Pokemon\Habit\Controllers\GetLogExercise;
use ConorSmith\Pokemon\Habit\Controllers\GetLogFoodDiary;
use ConorSmith\Pokemon\Habit\Controllers\GetLogStretches;
use ConorSmith\Pokemon\Habit\Controllers\GetLogWeeklyReview;
use ConorSmith\Pokemon\Habit\Controllers\PostLogCalorieGoal;
use ConorSmith\Pokemon\Habit\Controllers\PostLogExercise;
use ConorSmith\Pokemon\Habit\Controllers\PostLogFoodDiary;
use ConorSmith\Pokemon\Habit\Controllers\PostLogStretches;
use ConorSmith\Pokemon\Habit\Controllers\PostLogWeeklyReview;
use ConorSmith\Pokemon\Location\Controllers\GetSurveyPokemon;
use ConorSmith\Pokemon\Location\Controllers\PostSurveyPokemonFinish;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

final class GameModeMiddleware
{
    private const LOGGING_CONTROLLERS = [
        GetLogCalorieGoal::class,
        PostLogCalorieGoal::class,
        GetLogExercise::class,
        PostLogExercise::class,
        GetLogFoodDiary::class,
        PostLogFoodDiary::class,
        GetLogStretches::class,
        PostLogStretches::class,
        GetLogWeeklyReview::class,
        PostLogWeeklyReview::class,
    ];

    private const ENCOUNTER_MODE_CONTROLLERS = [
        GetEncounter::class,
        PostEncounterCatch::class,
        PostEncounterFight::class,
        PostEncounterRun::class,
        GetSwitch::class,
        PostSwitch::class,
    ];

    private const BATTLE_MODE_CONTROLLERS = [
        GetBattle::class,
        PostBattleFight::class,
        PostBattleFinish::class,
        GetSwitch::class,
        PostSwitch::class,
    ];

    private const SURVEY_MODE_CONTROLLERS = [
        GetSurveyPokemon::class,
        PostSurveyPokemonFinish::class,
    ];

    public function __construct(
        public readonly Connection $db,
    ) {}

    public function __invoke(string $controllerName, InstanceId $instanceId): ?Response
    {
        $instance = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => $instanceId->value,
        ]);
        $hasActiveTrainerBattle = !is_null($instance['active_battle_id']);

        $activeEncounter = $this->db->fetchAssociative("SELECT * FROM encounters WHERE has_started = 1 ORDER BY id");
        $hasActiveEncounter = $activeEncounter !== false;

        $activeSurvey = $this->db->fetchAssociative("SELECT * FROM surveys WHERE in_progress = 1 AND instance_id = :instanceId", [
            'instanceId' => $instanceId->value,
        ]);
        $hasActiveSurvey = $activeSurvey !== false;

        if ($hasActiveTrainerBattle
            && !self::isAllowedInBattleMode($controllerName)
        ) {
            return new RedirectResponse("/{$instanceId->value}/battle/" . $instance['active_battle_id']);
        }

        if ($hasActiveEncounter
            && !$hasActiveTrainerBattle
            && !self::isAllowedInEncounterMode($controllerName)
        ) {
            return new RedirectResponse("/{$instanceId->value}/encounter/" . $activeEncounter['id']);
        }

        if ($hasActiveSurvey
            && !$hasActiveTrainerBattle
            && !$hasActiveEncounter
            && !self::isAllowedInSurveyMode($controllerName)
        ) {
            return new RedirectResponse("/{$instanceId->value}/survey-pokemon/{$activeSurvey['encounter_type']}");
        }

        return null;
    }

    private static function isAllowedInBattleMode(string $controllerName): bool
    {
        return in_array($controllerName, self::LOGGING_CONTROLLERS)
            || in_array($controllerName, self::BATTLE_MODE_CONTROLLERS);
    }

    private static function isAllowedInEncounterMode(string $controllerName): bool
    {
        return in_array($controllerName, self::LOGGING_CONTROLLERS)
            || in_array($controllerName, self::ENCOUNTER_MODE_CONTROLLERS);
    }

    private static function isAllowedInSurveyMode(string $controllerName): bool
    {
        return in_array($controllerName, self::LOGGING_CONTROLLERS)
            || in_array($controllerName, self::SURVEY_MODE_CONTROLLERS);
    }
}
