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

    public function __construct(
        public readonly Connection $db,
    ) {}

    public function __invoke(string $controllerName, InstanceId $instanceId): ?Response
    {
        if ($response = $this->redirectingToActiveEncounter($controllerName, $instanceId)) {
            return $response;
        }

        if ($response = $this->redirectingToActiveTrainerBattle($controllerName, $instanceId)) {
            return $response;
        }

        return null;
    }

    private function redirectingToActiveEncounter(string $controllerName, InstanceId $instanceId): ?Response
    {
        if (in_array($controllerName, self::LOGGING_CONTROLLERS)
            || in_array($controllerName, self::ENCOUNTER_MODE_CONTROLLERS)
        ) {
            return null;
        }

        $activeEncounter = $this->db->fetchAssociative("SELECT * FROM encounters WHERE has_started = 1 ORDER BY id");

        if ($activeEncounter === false) {
            return null;
        }

        return new RedirectResponse("/{$instanceId->value}/encounter/" . $activeEncounter['id']);
    }

    private function redirectingToActiveTrainerBattle(string $controllerName, InstanceId $instanceId): ?Response
    {
        if (in_array($controllerName, self::LOGGING_CONTROLLERS)
            || in_array($controllerName, self::BATTLE_MODE_CONTROLLERS)
        ) {
            return null;
        }

        $instance = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => $instanceId->value,
        ]);

        if (is_null($instance['active_battle_id'])) {
            return null;
        }

        return new RedirectResponse("/{$instanceId->value}/battle/" . $instance['active_battle_id']);
    }
}
