<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon;

use ConorSmith\Pokemon\Battle\Controllers\GetBattle;
use ConorSmith\Pokemon\Battle\Controllers\GetSwitch;
use ConorSmith\Pokemon\Battle\Controllers\GetEncounter;
use ConorSmith\Pokemon\Battle\Controllers\PostBattleFight;
use ConorSmith\Pokemon\Battle\Controllers\PostBattleFinish;
use ConorSmith\Pokemon\Battle\Controllers\PostBattleStart;
use ConorSmith\Pokemon\Battle\Controllers\PostSwitch;
use ConorSmith\Pokemon\Battle\Controllers\PostEncounterStart;
use ConorSmith\Pokemon\Battle\Controllers\PostEncounterCatch;
use ConorSmith\Pokemon\Battle\Controllers\PostEncounterFight;
use ConorSmith\Pokemon\Battle\Controllers\PostEncounterRun;
use ConorSmith\Pokemon\Battle\EventFactory;
use ConorSmith\Pokemon\Battle\Repositories\EncounterRepository;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\Controllers\GetBag;
use ConorSmith\Pokemon\Controllers\GetPokedex;
use ConorSmith\Pokemon\SharedKernel\CatchPokemonCommand;
use ConorSmith\Pokemon\SharedKernel\ReportBattleWithGymLeaderCommand;
use ConorSmith\Pokemon\SharedKernel\ReportTeamPokemonFaintedCommand;
use ConorSmith\Pokemon\SharedKernel\WeeklyUpdateForTeamCommand;
use ConorSmith\Pokemon\Team\Controllers\GetTeam;
use ConorSmith\Pokemon\Controllers\GetIndex;
use ConorSmith\Pokemon\Controllers\GetMap;
use ConorSmith\Pokemon\Controllers\GetTeamItemUse;
use ConorSmith\Pokemon\Controllers\PostItemUse;
use ConorSmith\Pokemon\Controllers\PostMapMove;
use ConorSmith\Pokemon\Team\Controllers\PostTeamItemUse;
use ConorSmith\Pokemon\Team\Controllers\PostTeamMoveDown;
use ConorSmith\Pokemon\Team\Controllers\PostTeamMoveUp;
use ConorSmith\Pokemon\Team\Controllers\PostTeamSendToBox;
use ConorSmith\Pokemon\Team\Controllers\PostTeamSendToDayCare;
use ConorSmith\Pokemon\Team\Controllers\PostTeamSendToTeam;
use ConorSmith\Pokemon\Habit\Controllers\GetLogCalorieGoal;
use ConorSmith\Pokemon\Habit\Controllers\GetLogExercise;
use ConorSmith\Pokemon\Habit\Controllers\GetLogFoodDiary;
use ConorSmith\Pokemon\Habit\Controllers\GetLogWeeklyReview;
use ConorSmith\Pokemon\Habit\Controllers\PostLogCalorieGoal;
use ConorSmith\Pokemon\Habit\Controllers\PostLogExercise;
use ConorSmith\Pokemon\Habit\Controllers\PostLogFoodDiary;
use ConorSmith\Pokemon\Habit\Controllers\PostLogWeeklyReview;
use ConorSmith\Pokemon\Habit\Repositories\DailyHabitLogRepository;
use ConorSmith\Pokemon\Habit\Repositories\UnlimitedHabitLogRepository;
use ConorSmith\Pokemon\Habit\Repositories\WeeklyHabitLogRepository;
use ConorSmith\Pokemon\Repositories\CaughtPokemonRepository;
use ConorSmith\Pokemon\SharedKernel\HabitStreakQuery;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\Team\FriendshipLog;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepository;
use Doctrine\DBAL\Connection;
use FastRoute\RouteCollector;
use Symfony\Component\HttpFoundation\Session\Session;

final class ControllerFactory
{
    public static function routes(RouteCollector $r): void
    {
        $r->get("/log/calorie-goal", GetLogCalorieGoal::class);
        $r->post("/log/calorie-goal", PostLogCalorieGoal::class);
        $r->get("/log/exercise", GetLogExercise::class);
        $r->post("/log/exercise", PostLogExercise::class);
        $r->get("/log/food-diary", GetLogFoodDiary::class);
        $r->post("/log/food-diary", PostLogFoodDiary::class);
        $r->get("/log/weekly-review", GetLogWeeklyReview::class);
        $r->post("/log/weekly-review", PostLogWeeklyReview::class);

        $r->get("/pokedex", GetPokedex::class);
        $r->post("/map/move", PostMapMove::class);
        $r->get("/map", GetMap::class);
        $r->post("/encounter", PostEncounterStart::class);
        $r->get("/team", GetTeam::class);
        $r->get("/encounter/{id}", GetEncounter::class);
        $r->post("/encounter/{id}/catch", PostEncounterCatch::class);
        $r->post("/encounter/{id}/fight", PostEncounterFight::class);
        $r->post("/encounter/{id}/run", PostEncounterRun::class);
        $r->post("/team/move-up", PostTeamMoveUp::class);
        $r->post("/team/move-down", PostTeamMoveDown::class);
        $r->post("/team/send-to-box", PostTeamSendToBox::class);
        $r->post("/team/send-to-team", PostTeamSendToTeam::class);
        $r->post("/team/send-to-day-care", PostTeamSendToDayCare::class);
        $r->post("/battle/trainer/{id}", PostBattleStart::class);
        $r->get("/battle/{id}", GetBattle::class);
        $r->post("/battle/{id}/fight", PostBattleFight::class);
        $r->get("/team/switch", GetSwitch::class);
        $r->post("/team/switch", PostSwitch::class);
        $r->post("/battle/{id}/finish", PostBattleFinish::class);
        $r->get("/bag", GetBag::class);
        $r->post("/item/{id}/use", PostItemUse::class);
        $r->get("/team/use/{id}", GetTeamItemUse::class);
        $r->post("/team/use/{id}", PostTeamItemUse::class);
        $r->get("/", GetIndex::class);
    }

    public function __construct(
        private readonly Connection                  $db,
        private readonly Session                     $session,
        private readonly CaughtPokemonRepository     $caughtPokemonRepository,
        private readonly EncounterRepository         $encounterRepository,
        private readonly TrainerRepository           $trainerRepository,
        private readonly PlayerRepository            $playerRepository,
        private readonly BagRepository               $bagRepository,
        private readonly DailyHabitLogRepository     $dailyHabitLogRepository,
        private readonly UnlimitedHabitLogRepository $unlimitedHabitLogRepository,
        private readonly WeeklyHabitLogRepository    $weeklyHabitLogRepository,
        private readonly PokemonRepository           $pokemonRepository,
        private readonly FriendshipLog               $friendshipLog,
        private readonly ViewModelFactory            $viewModelFactory,
        private readonly CatchPokemonCommand         $catchPokemonCommand,
        private readonly HabitStreakQuery            $habitStreakQuery,
        private readonly ReportTeamPokemonFaintedCommand $reportTeamPokemonFaintedCommand,
        private readonly ReportBattleWithGymLeaderCommand $reportBattleWithGymLeaderCommand,
        private readonly WeeklyUpdateForTeamCommand  $weeklyUpdateForTeamCommand,
        private readonly array                       $pokedex,
        private readonly array                       $map,
    ) {}

    public function create(string $className): mixed
    {
        return match ($className) {
            GetLogFoodDiary::class => new GetLogFoodDiary(
                $this->session,
                $this->dailyHabitLogRepository,
            ),
            PostLogFoodDiary::class => new PostLogFoodDiary(
                $this->db,
                $this->session,
                $this->dailyHabitLogRepository,
                $this->bagRepository,
            ),
            GetLogWeeklyReview::class => new GetLogWeeklyReview(
                $this->session,
            ),
            PostLogWeeklyReview::class => new PostLogWeeklyReview(
                $this->db,
                $this->session,
                $this->bagRepository,
                $this->dailyHabitLogRepository,
                $this->weeklyHabitLogRepository,
                $this->weeklyUpdateForTeamCommand,
            ),
            GetPokedex::class => new GetPokedex($this->db, $this->pokedex),
            GetLogCalorieGoal::class => new GetLogCalorieGoal(
                $this->session,
                $this->dailyHabitLogRepository,
            ),
            PostLogCalorieGoal::class => new PostLogCalorieGoal(
                $this->db,
                $this->session,
                $this->dailyHabitLogRepository,
                $this->bagRepository,
            ),
            PostMapMove::class => new PostMapMove($this->db, $this->session, $this->map),
            GetLogExercise::class => new GetLogExercise(
                $this->session,
                $this->unlimitedHabitLogRepository,
            ),
            PostLogExercise::class => new PostLogExercise(
                $this->db,
                $this->session,
                $this->bagRepository,
                $this->unlimitedHabitLogRepository,
            ),
            GetMap::class => new GetMap(
                $this->db,
                $this->session,
                $this->bagRepository,
                $this->viewModelFactory,
                $this->map,
                $this->pokedex,
            ),
            PostEncounterStart::class => new PostEncounterStart(
                $this->db,
                $this->session,
                $this->encounterRepository,
                $this->playerRepository,
                $this->bagRepository,
            ),
            GetTeam::class => new GetTeam(
                $this->session,
                $this->pokemonRepository,
            ),
            GetEncounter::class => new GetEncounter(
                $this->session,
                $this->playerRepository,
                $this->encounterRepository,
                $this->bagRepository,
                $this->viewModelFactory,
            ),
            PostEncounterCatch::class => new PostEncounterCatch(
                $this->db,
                $this->encounterRepository,
                $this->bagRepository,
                $this->catchPokemonCommand,
                new EventFactory($this->viewModelFactory),
                $this->map,
            ),
            PostEncounterRun::class => new PostEncounterRun($this->db),
            PostEncounterFight::class => new PostEncounterFight(
                $this->session,
                $this->encounterRepository,
                $this->playerRepository,
                new EventFactory($this->viewModelFactory),
                $this->reportTeamPokemonFaintedCommand,
            ),
            PostTeamMoveUp::class => new PostTeamMoveUp($this->db, $this->session, $this->caughtPokemonRepository),
            PostTeamMoveDown::class => new PostTeamMoveDown($this->db, $this->session, $this->caughtPokemonRepository),
            PostTeamSendToBox::class => new PostTeamSendToBox(
                $this->session,
                $this->pokemonRepository,
                $this->friendshipLog,
            ),
            PostTeamSendToTeam::class => new PostTeamSendToTeam(
                $this->session,
                $this->pokemonRepository,
                $this->friendshipLog,
            ),
            PostTeamSendToDayCare::class => new PostTeamSendToDayCare(
                $this->session,
                $this->pokemonRepository,
                $this->friendshipLog,
            ),
            PostBattleStart::class => new PostBattleStart(
                $this->db,
                $this->session,
                $this->playerRepository,
                $this->trainerRepository,
                $this->bagRepository,
                $this->reportBattleWithGymLeaderCommand,
            ),
            GetBattle::class => new GetBattle(
                $this->session,
                $this->trainerRepository,
                $this->playerRepository,
                $this->viewModelFactory,
            ),
            PostBattleFight::class => new PostBattleFight(
                $this->db,
                $this->session,
                $this->trainerRepository,
                $this->playerRepository,
                $this->bagRepository,
                $this->reportTeamPokemonFaintedCommand,
                new EventFactory($this->viewModelFactory),
                $this->viewModelFactory,
            ),
            GetSwitch::class => new GetSwitch(
                $this->playerRepository,
                $this->viewModelFactory,
            ),
            PostSwitch::class => new PostSwitch(
                $this->playerRepository,
            ),
            PostBattleFinish::class => new PostBattleFinish(
                $this->trainerRepository,
            ),
            GetBag::class => new GetBag(
                $this->session,
                $this->bagRepository,
            ),
            PostItemUse::class => new PostItemUse(

            ),
            GetTeamItemUse::class => new GetTeamItemUse(
                $this->session,
                $this->bagRepository,
                $this->playerRepository,
                $this->viewModelFactory,
            ),
            PostTeamItemUse::class => new PostTeamItemUse(
                $this->db,
                $this->session,
                $this->bagRepository,
                $this->pokemonRepository,
                $this->friendshipLog,
                $this->pokedex,
            ),
            GetIndex::class => new GetIndex(
                $this->db,
                $this->session,
                $this->pokemonRepository,
                $this->bagRepository,
                $this->viewModelFactory,
            ),
        };
    }
}