<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon;

use ConorSmith\Pokemon\Controllers\GetBattle;
use ConorSmith\Pokemon\Controllers\GetTeam;
use ConorSmith\Pokemon\Controllers\GetEncounter;
use ConorSmith\Pokemon\Controllers\GetIndex;
use ConorSmith\Pokemon\Controllers\GetLogCalorieGoal;
use ConorSmith\Pokemon\Controllers\GetLogExercise;
use ConorSmith\Pokemon\Controllers\GetLogFoodDiary;
use ConorSmith\Pokemon\Controllers\GetMapEncounter;
use ConorSmith\Pokemon\Controllers\GetMapMove;
use ConorSmith\Pokemon\Controllers\GetTeamLevelUp;
use ConorSmith\Pokemon\Controllers\PostBattleFight;
use ConorSmith\Pokemon\Controllers\PostBattleTrainer;
use ConorSmith\Pokemon\Controllers\PostEncounterCatch;
use ConorSmith\Pokemon\Controllers\PostEncounterRun;
use ConorSmith\Pokemon\Controllers\PostLogCalorieGoal;
use ConorSmith\Pokemon\Controllers\PostLogExercise;
use ConorSmith\Pokemon\Controllers\PostLogFoodDiary;
use ConorSmith\Pokemon\Controllers\PostMapEncounter;
use ConorSmith\Pokemon\Controllers\PostMapMove;
use ConorSmith\Pokemon\Controllers\PostTeamLevelUp;
use ConorSmith\Pokemon\Controllers\PostTeamMoveDown;
use ConorSmith\Pokemon\Controllers\PostTeamMoveUp;
use ConorSmith\Pokemon\Controllers\PostTeamSendToBox;
use ConorSmith\Pokemon\Controllers\PostTeamSendToTeam;
use ConorSmith\Pokemon\Repositories\Battle\PlayerRepository;
use ConorSmith\Pokemon\Repositories\Battle\TrainerRepository;
use ConorSmith\Pokemon\Repositories\CaughtPokemonRepository;
use Doctrine\DBAL\Connection;
use FastRoute\RouteCollector;
use Symfony\Component\HttpFoundation\Session\Session;

final class ControllerFactory
{
    public static function routes(RouteCollector $r): void
    {
        $r->get("/log/food-diary", GetLogFoodDiary::class);
        $r->post("/log/food-diary", PostLogFoodDiary::class);
        $r->get("/team/level-up", GetTeamLevelUp::class);
        $r->post("/team/level-up", PostTeamLevelUp::class);
        $r->get("/log/calorie-goal", GetLogCalorieGoal::class);
        $r->post("/log/calorie-goal", PostLogCalorieGoal::class);
        $r->get("/map/move", GetMapMove::class);
        $r->post("/map/move", PostMapMove::class);
        $r->get("/log/exercise", GetLogExercise::class);
        $r->post("/log/exercise", PostLogExercise::class);
        $r->get("/map/encounter", GetMapEncounter::class);
        $r->post("/map/encounter", PostMapEncounter::class);
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
        $r->get("/", GetIndex::class);
    }

    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly CaughtPokemonRepository $caughtPokemonRepository,
        private readonly TrainerRepository $trainerRepository,
        private readonly PlayerRepository $playerRepository,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly array $pokedex,
        private readonly array $map,
    ) {}

    public function create(string $className): mixed
    {
        return match ($className) {
            GetLogFoodDiary::class => new GetLogFoodDiary($this->db, $this->session),
            PostLogFoodDiary::class => new PostLogFoodDiary($this->db, $this->session),
            GetTeamLevelUp::class => new GetTeamLevelUp($this->db, $this->caughtPokemonRepository, $this->pokedex),
            PostTeamLevelUp::class => new PostTeamLevelUp($this->db, $this->session, $this->pokedex),
            GetLogCalorieGoal::class => new GetLogCalorieGoal($this->db, $this->session),
            PostLogCalorieGoal::class => new PostLogCalorieGoal($this->db, $this->session),
            GetMapMove::class => new GetMapMove($this->db, $this->session, $this->map),
            PostMapMove::class => new PostMapMove($this->db, $this->session, $this->map),
            GetLogExercise::class => new GetLogExercise($this->db, $this->session),
            PostLogExercise::class => new PostLogExercise($this->db, $this->session),
            GetMapEncounter::class => new GetMapEncounter(
                $this->db,
                $this->session,
                $this->viewModelFactory,
                $this->map,
            ),
            PostMapEncounter::class => new PostMapEncounter($this->db, $this->session, $this->map),
            GetTeam::class => new GetTeam(
                $this->db,
                $this->playerRepository,
                $this->pokedex,
                $this->viewModelFactory,
            ),
            GetEncounter::class => new GetEncounter($this->db, $this->session, $this->pokedex),
            PostEncounterCatch::class => new PostEncounterCatch($this->db, $this->session, $this->pokedex, $this->map),
            PostEncounterRun::class => new PostEncounterRun($this->db),
            PostTeamMoveUp::class => new PostTeamMoveUp($this->db, $this->session, $this->caughtPokemonRepository),
            PostTeamMoveDown::class => new PostTeamMoveDown($this->db, $this->session, $this->caughtPokemonRepository),
            PostTeamSendToBox::class => new PostTeamSendToBox($this->db, $this->session, $this->caughtPokemonRepository),
            PostTeamSendToTeam::class => new PostTeamSendToTeam($this->db, $this->session, $this->caughtPokemonRepository),
            PostBattleTrainer::class => new PostBattleTrainer(
                $this->db,
                $this->session,
                $this->trainerRepository
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
                $this->viewModelFactory,
            ),
            GetIndex::class => new GetIndex(
                $this->db,
                $this->session,
                $this->playerRepository,
                $this->viewModelFactory,
            ),
        };
    }
}