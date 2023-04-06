<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon;

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
use ConorSmith\Pokemon\Habit\Controllers\GetLogWeeklyReview;
use ConorSmith\Pokemon\Habit\Controllers\PostLogCalorieGoal;
use ConorSmith\Pokemon\Habit\Controllers\PostLogExercise;
use ConorSmith\Pokemon\Habit\Controllers\PostLogFoodDiary;
use ConorSmith\Pokemon\Habit\Controllers\PostLogWeeklyReview;
use Doctrine\DBAL\Connection;

final class GameModeMiddleware
{
    private const LOGGING_CONTROLLERS = [
        GetLogCalorieGoal::class,
        PostLogCalorieGoal::class,
        GetLogExercise::class,
        PostLogExercise::class,
        GetLogFoodDiary::class,
        PostLogFoodDiary::class,
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

    public function __invoke(string $controllerName): bool
    {
        if ($this->redirectingToActiveEncounter($controllerName)) {
            return true;
        }

        if ($this->redirectingToActiveTrainerBattle($controllerName)) {
            return true;
        }

        return false;
    }

    private function redirectingToActiveEncounter(string $controllerName): bool
    {
        if (in_array($controllerName, self::LOGGING_CONTROLLERS)
            || in_array($controllerName, self::ENCOUNTER_MODE_CONTROLLERS)
        ) {
            return false;
        }

        $activeEncounter = $this->db->fetchAssociative("SELECT * FROM encounters ORDER BY id");

        if ($activeEncounter === false) {
            return false;
        }

        header("Location: /encounter/" . $activeEncounter['id']);

        return true;
    }

    private function redirectingToActiveTrainerBattle(string $controllerName): bool
    {
        if (in_array($controllerName, self::LOGGING_CONTROLLERS)
            || in_array($controllerName, self::BATTLE_MODE_CONTROLLERS)
        ) {
            return false;
        }

        $activeTrainerBattle = $this->db->fetchAssociative("SELECT * FROM trainer_battles WHERE is_battling = 1 ORDER BY id");

        if ($activeTrainerBattle === false) {
            return false;
        }

        header("Location: /battle/" . $activeTrainerBattle['id']);

        return true;
    }
}
