<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon;

use ConorSmith\Pokemon\Battle\Controllers\GetBattle;
use ConorSmith\Pokemon\Battle\Controllers\GetBattleSwitch;
use ConorSmith\Pokemon\Battle\Controllers\PostBattleFight;
use ConorSmith\Pokemon\Battle\Controllers\PostBattleSwitch;
use ConorSmith\Pokemon\Battle\Controllers\PostBattleTrainer;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\Controllers\GetBag;
use ConorSmith\Pokemon\Controllers\GetPokedex;
use ConorSmith\Pokemon\Controllers\GetTeam;
use ConorSmith\Pokemon\Controllers\GetEncounter;
use ConorSmith\Pokemon\Controllers\GetIndex;
use ConorSmith\Pokemon\Controllers\GetMap;
use ConorSmith\Pokemon\Controllers\GetTeamItemUse;
use ConorSmith\Pokemon\Controllers\PostEncounterCatch;
use ConorSmith\Pokemon\Controllers\PostEncounterRun;
use ConorSmith\Pokemon\Controllers\PostItemUse;
use ConorSmith\Pokemon\Controllers\PostMap;
use ConorSmith\Pokemon\Controllers\PostMapMove;
use ConorSmith\Pokemon\Controllers\PostTeamItemUse;
use ConorSmith\Pokemon\Controllers\PostTeamMoveDown;
use ConorSmith\Pokemon\Controllers\PostTeamMoveUp;
use ConorSmith\Pokemon\Controllers\PostTeamSendToBox;
use ConorSmith\Pokemon\Controllers\PostTeamSendToTeam;
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
        $r->post("/map", PostMap::class);
        $r->get("/team", GetTeam::class);
        $r->get("/encounter/{id}", GetEncounter::class);
        $r->post("/encounter/{id}/catch", PostEncounterCatch::class);
        $r->post("/encounter/{id}/run", PostEncounterRun::class);
        $r->post("/team/move-up", PostTeamMoveUp::class);
        $r->post("/team/move-down", PostTeamMoveDown::class);
        $r->post("/team/send-to-box", PostTeamSendToBox::class);
        $r->post("/team/send-to-team", PostTeamSendToTeam::class);
        $r->post("/battle/trainer/{id}", PostBattleTrainer::class);
        $r->get("/battle/{id}", GetBattle::class);
        $r->post("/battle/{id}/fight", PostBattleFight::class);
        $r->get("/battle/{id}/switch", GetBattleSwitch::class);
        $r->post("/battle/{id}/switch", PostBattleSwitch::class);
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
        private readonly TrainerRepository           $trainerRepository,
        private readonly PlayerRepository            $playerRepository,
        private readonly BagRepository               $bagRepository,
        private readonly DailyHabitLogRepository     $dailyHabitLogRepository,
        private readonly UnlimitedHabitLogRepository $unlimitedHabitLogRepository,
        private readonly WeeklyHabitLogRepository    $weeklyHabitLogRepository,
        private readonly ViewModelFactory            $viewModelFactory,
        private readonly HabitStreakQuery            $habitStreakQuery,
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
            ),
            PostMap::class => new PostMap(
                $this->db,
                $this->session,
                $this->bagRepository,
                $this->habitStreakQuery,
                $this->map,
            ),
            GetTeam::class => new GetTeam(
                $this->db,
                $this->session,
                $this->playerRepository,
                $this->pokedex,
                $this->viewModelFactory,
            ),
            GetEncounter::class => new GetEncounter(
                $this->db,
                $this->session,
                $this->bagRepository,
                $this->pokedex,
            ),
            PostEncounterCatch::class => new PostEncounterCatch(
                $this->db,
                $this->session,
                $this->bagRepository,
                $this->pokedex,
                $this->map,
            ),
            PostEncounterRun::class => new PostEncounterRun($this->db),
            PostTeamMoveUp::class => new PostTeamMoveUp($this->db, $this->session, $this->caughtPokemonRepository),
            PostTeamMoveDown::class => new PostTeamMoveDown($this->db, $this->session, $this->caughtPokemonRepository),
            PostTeamSendToBox::class => new PostTeamSendToBox($this->db, $this->session, $this->caughtPokemonRepository),
            PostTeamSendToTeam::class => new PostTeamSendToTeam($this->db, $this->session, $this->caughtPokemonRepository),
            PostBattleTrainer::class => new PostBattleTrainer(
                $this->db,
                $this->session,
                $this->trainerRepository,
                $this->bagRepository,
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
                $this->viewModelFactory,
            ),
            GetBattleSwitch::class => new GetBattleSwitch(
                $this->playerRepository,
                $this->viewModelFactory,
            ),
            PostBattleSwitch::class => new PostBattleSwitch(
                $this->playerRepository,
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
                $this->pokedex,
            ),
            GetIndex::class => new GetIndex(
                $this->db,
                $this->session,
                $this->playerRepository,
                $this->bagRepository,
                $this->viewModelFactory,
            ),
        };
    }
}