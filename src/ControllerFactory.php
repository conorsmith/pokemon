<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon;

use ConorSmith\Pokemon\Battle\Controllers\GetBattle;
use ConorSmith\Pokemon\Battle\Controllers\GetHallOfFame;
use ConorSmith\Pokemon\Battle\Controllers\GetSwitch;
use ConorSmith\Pokemon\Battle\Controllers\GetEncounter;
use ConorSmith\Pokemon\Battle\Controllers\PostBattleFight;
use ConorSmith\Pokemon\Battle\Controllers\PostBattleFinish;
use ConorSmith\Pokemon\Battle\Controllers\PostBattleStart;
use ConorSmith\Pokemon\Battle\Controllers\PostChallengeEliteFour;
use ConorSmith\Pokemon\Battle\Controllers\PostEncounterGenerate;
use ConorSmith\Pokemon\Battle\Controllers\PostEncounterStart;
use ConorSmith\Pokemon\Battle\Controllers\PostSwitch;
use ConorSmith\Pokemon\Battle\Controllers\PostEncounterGenerateAndStart;
use ConorSmith\Pokemon\Battle\Controllers\PostEncounterCatch;
use ConorSmith\Pokemon\Battle\Controllers\PostEncounterFight;
use ConorSmith\Pokemon\Battle\Controllers\PostEncounterRun;
use ConorSmith\Pokemon\Battle\EventFactory;
use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Battle\Repositories\EncounterRepository;
use ConorSmith\Pokemon\Battle\Repositories\AreaRepository;
use ConorSmith\Pokemon\Battle\Repositories\LocationRepository;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\Battle\UseCase\StartABattle;
use ConorSmith\Pokemon\Battle\UseCase\CreateALegendaryEncounter;
use ConorSmith\Pokemon\Battle\UseCase\CreateAWildEncounter;
use ConorSmith\Pokemon\Battle\UseCase\StartAnEncounter;
use ConorSmith\Pokemon\Controllers\GetBag;
use ConorSmith\Pokemon\Controllers\GetPokedex;
use ConorSmith\Pokemon\Controllers\GetTrackPokemon;
use ConorSmith\Pokemon\Location\Controllers\ControllerFactory as LocationControllerFactory;
use ConorSmith\Pokemon\SharedKernel\CatchPokemonCommand;
use ConorSmith\Pokemon\SharedKernel\ReportBattleWithGymLeaderCommand;
use ConorSmith\Pokemon\SharedKernel\ReportTeamPokemonFaintedCommand;
use ConorSmith\Pokemon\SharedKernel\WeeklyUpdateForTeamCommand;
use ConorSmith\Pokemon\Team\Controllers\GetPokemon;
use ConorSmith\Pokemon\Team\Controllers\GetTeam;
use ConorSmith\Pokemon\Controllers\GetIndex;
use ConorSmith\Pokemon\Controllers\GetMap;
use ConorSmith\Pokemon\Controllers\GetTeamItemUse;
use ConorSmith\Pokemon\Controllers\PostItemUse;
use ConorSmith\Pokemon\Controllers\PostMapMove;
use ConorSmith\Pokemon\Team\Controllers\GetTeamCompare;
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
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\Team\FriendshipLog;
use ConorSmith\Pokemon\Team\LevelUpPokemon;
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
        $r->get("/track-pokemon/{encounterType}", GetTrackPokemon::class);
        $r->post("/encounter", PostEncounterGenerateAndStart::class);
        $r->post("/encounter/generate", PostEncounterGenerate::class);
        $r->get("/team", GetTeam::class);
        $r->get("/team/compare", GetTeamCompare::class);
        $r->Get("/team/member/{id}", GetPokemon::class);
        $r->get("/encounter/{id}", GetEncounter::class);
        $r->post("/encounter/{id}/start", PostEncounterStart::class);
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
        $r->post("/challenge/elite-four/{region}", PostChallengeEliteFour::class);
        $r->get("/hall-of-fame/{region}", GetHallOfFame::class);
        $r->get("/bag", GetBag::class);
        $r->post("/item/{id}/use", PostItemUse::class);
        $r->get("/team/use/{id}", GetTeamItemUse::class);
        $r->post("/team/use/{id}", PostTeamItemUse::class);
        $r->get("/", GetIndex::class);
    }

    public function __construct(
        private readonly LocationControllerFactory $locationControllerFactory,
        private readonly Connection $db,
        private readonly Session $session,
        private readonly CaughtPokemonRepository $caughtPokemonRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly TrainerConfigRepository $trainerConfigRepository,
        private readonly EncounterRepository $encounterRepository,
        private readonly LocationRepository $locationRepository,
        private readonly TrainerRepository $trainerRepository,
        private readonly PlayerRepository $playerRepository,
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
        private readonly AreaRepository $areaRepository,
        private readonly BagRepository $bagRepository,
        private readonly DailyHabitLogRepository $dailyHabitLogRepository,
        private readonly UnlimitedHabitLogRepository $unlimitedHabitLogRepository,
        private readonly WeeklyHabitLogRepository $weeklyHabitLogRepository,
        private readonly PokemonRepository $pokemonRepository,
        private readonly FriendshipLog $friendshipLog,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly CatchPokemonCommand $catchPokemonCommand,
        private readonly ReportTeamPokemonFaintedCommand $reportTeamPokemonFaintedCommand,
        private readonly ReportBattleWithGymLeaderCommand $reportBattleWithGymLeaderCommand,
        private readonly WeeklyUpdateForTeamCommand $weeklyUpdateForTeamCommand,
        private readonly LevelUpPokemon $levelUpPokemon,
        private readonly array $pokedex,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function create(string $className): mixed
    {
        $controller = $this->locationControllerFactory->create($className);

        if (!is_null($controller)) {
            return $controller;
        }

        return match ($className) {
            GetLogFoodDiary::class => new GetLogFoodDiary(
                $this->dailyHabitLogRepository,
                $this->templateEngine,
            ),
            PostLogFoodDiary::class => new PostLogFoodDiary(
                $this->db,
                $this->session,
                $this->dailyHabitLogRepository,
                $this->bagRepository,
            ),
            GetLogWeeklyReview::class => new GetLogWeeklyReview(
                $this->templateEngine,
            ),
            PostLogWeeklyReview::class => new PostLogWeeklyReview(
                $this->db,
                $this->session,
                $this->bagRepository,
                $this->dailyHabitLogRepository,
                $this->weeklyHabitLogRepository,
                $this->weeklyUpdateForTeamCommand,
            ),
            GetPokedex::class => new GetPokedex(
                $this->db,
                $this->pokedex,
                $this->templateEngine,
            ),
            GetLogCalorieGoal::class => new GetLogCalorieGoal(
                $this->dailyHabitLogRepository,
                $this->templateEngine,
            ),
            PostLogCalorieGoal::class => new PostLogCalorieGoal(
                $this->db,
                $this->session,
                $this->dailyHabitLogRepository,
                $this->bagRepository,
            ),
            PostMapMove::class => new PostMapMove(
                $this->db,
                $this->session,
                $this->locationConfigRepository,
            ),
            GetLogExercise::class => new GetLogExercise(
                $this->unlimitedHabitLogRepository,
                $this->templateEngine,
            ),
            PostLogExercise::class => new PostLogExercise(
                $this->db,
                $this->session,
                $this->bagRepository,
                $this->unlimitedHabitLogRepository,
            ),
            PostEncounterGenerateAndStart::class => new PostEncounterGenerateAndStart(
                new CreateAWildEncounter(
                    $this->encounterRepository,
                    $this->locationRepository,
                ),
                new CreateALegendaryEncounter(
                    $this->encounterRepository,
                    $this->bagRepository,
                ),
                new StartAnEncounter(
                    $this->encounterRepository,
                ),
            ),
            PostEncounterGenerate::class => new PostEncounterGenerate(
                new CreateAWildEncounter(
                    $this->encounterRepository,
                    $this->locationRepository,
                ),
                $this->viewModelFactory,
            ),
            PostEncounterStart::class => new PostEncounterStart(
                new StartAnEncounter(
                    $this->encounterRepository,
                ),
            ),
            GetTeam::class => new GetTeam(
                $this->pokemonRepository,
                $this->templateEngine,
            ),
            GetTeamCompare::class => new GetTeamCompare(
                $this->pokemonRepository,
                $this->templateEngine,
            ),
            GetPokemon::class => new GetPokemon(
                $this->pokemonRepository,
                $this->locationConfigRepository,
                $this->templateEngine,
            ),
            GetEncounter::class => new GetEncounter(
                $this->playerRepository,
                $this->encounterRepository,
                $this->bagRepository,
                $this->viewModelFactory,
                $this->templateEngine,
            ),
            PostEncounterCatch::class => new PostEncounterCatch(
                $this->db,
                $this->encounterRepository,
                $this->bagRepository,
                $this->locationConfigRepository,
                $this->catchPokemonCommand,
                new EventFactory($this->viewModelFactory),
            ),
            PostEncounterRun::class => new PostEncounterRun(
                $this->encounterRepository,
                $this->playerRepository,
            ),
            PostEncounterFight::class => new PostEncounterFight(
                $this->session,
                $this->encounterRepository,
                $this->playerRepository,
                new EventFactory($this->viewModelFactory),
                $this->reportTeamPokemonFaintedCommand,
            ),
            PostTeamMoveUp::class => new PostTeamMoveUp(
                $this->db,
                $this->session,
                $this->caughtPokemonRepository,
            ),
            PostTeamMoveDown::class => new PostTeamMoveDown(
                $this->db,
                $this->session,
                $this->caughtPokemonRepository,
            ),
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
                $this->session,
                new StartABattle(
                    $this->bagRepository,
                    $this->playerRepository,
                    $this->trainerRepository,
                    $this->eliteFourChallengeRepository,
                    $this->reportBattleWithGymLeaderCommand,
                ),
            ),
            GetBattle::class => new GetBattle(
                $this->db,
                $this->trainerConfigRepository,
                $this->trainerRepository,
                $this->playerRepository,
                $this->viewModelFactory,
                $this->templateEngine,
            ),
            GetHallOfFame::class => new GetHallOfFame(
                $this->session,
                $this->eliteFourChallengeRepository,
                new PokedexConfigRepository(),
                $this->templateEngine,
            ),
            PostBattleFight::class => new PostBattleFight(
                $this->db,
                $this->session,
                new ItemConfigRepository(),
                $this->trainerRepository,
                $this->playerRepository,
                $this->areaRepository,
                $this->bagRepository,
                $this->reportTeamPokemonFaintedCommand,
                new EventFactory($this->viewModelFactory),
                $this->viewModelFactory,
            ),
            GetSwitch::class => new GetSwitch(
                $this->playerRepository,
                $this->viewModelFactory,
                $this->templateEngine,
            ),
            PostSwitch::class => new PostSwitch(
                $this->playerRepository,
            ),
            PostBattleFinish::class => new PostBattleFinish(
                $this->trainerRepository,
                $this->eliteFourChallengeRepository,
                new StartABattle(
                    $this->bagRepository,
                    $this->playerRepository,
                    $this->trainerRepository,
                    $this->eliteFourChallengeRepository,
                    $this->reportBattleWithGymLeaderCommand,
                ),
            ),
            GetBag::class => new GetBag(
                $this->bagRepository,
                new ItemConfigRepository(),
                $this->templateEngine,
            ),
            PostItemUse::class => new PostItemUse(
            ),
            GetTeamItemUse::class => new GetTeamItemUse(
                $this->session,
                $this->bagRepository,
                $this->playerRepository,
                $this->viewModelFactory,
                $this->templateEngine,
            ),
            PostTeamItemUse::class => new PostTeamItemUse(
                $this->db,
                $this->session,
                $this->bagRepository,
                $this->pokemonRepository,
                $this->levelUpPokemon,
                $this->pokedex,
            ),
            PostChallengeEliteFour::class => new PostChallengeEliteFour(
                $this->session,
                $this->bagRepository,
                $this->playerRepository,
                $this->eliteFourChallengeRepository,
                new StartABattle(
                    $this->bagRepository,
                    $this->playerRepository,
                    $this->trainerRepository,
                    $this->eliteFourChallengeRepository,
                    $this->reportBattleWithGymLeaderCommand,
                ),
            ),
            GetIndex::class => new GetIndex(
                $this->db,
                $this->pokemonRepository,
                $this->bagRepository,
                $this->eliteFourChallengeRepository,
                $this->viewModelFactory,
                $this->templateEngine,
            ),
        };
    }
}