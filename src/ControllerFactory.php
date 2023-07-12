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
use ConorSmith\Pokemon\Habit\Controllers\GetLogStretches;
use ConorSmith\Pokemon\Habit\Controllers\PostLogStretches;
use ConorSmith\Pokemon\Location\RegionRepositoryRegionIsLockedQuery;
use ConorSmith\Pokemon\Location\Repositories\RegionRepository;
use ConorSmith\Pokemon\Player\HighestRankedGymBadgeQueryDb;
use ConorSmith\Pokemon\Pokedex\Controllers\GetPokedex;
use ConorSmith\Pokemon\Controllers\GetTrackPokemon;
use ConorSmith\Pokemon\Location\Controllers\ControllerFactory as LocationControllerFactory;
use ConorSmith\Pokemon\Pokedex\Controllers\GetPokedexEntry;
use ConorSmith\Pokemon\Pokedex\RegisterNewPokemonCommand;
use ConorSmith\Pokemon\Pokedex\Repositories\PokedexEntryRepository;
use ConorSmith\Pokemon\Pokedex\TotalRegisteredPokemonQuery;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\SharedKernel\ReportBattleWithGymLeaderCommand;
use ConorSmith\Pokemon\SharedKernel\ReportTeamPokemonFaintedCommand;
use ConorSmith\Pokemon\Team\BoostPokemonEvsCommand;
use ConorSmith\Pokemon\Team\CatchPokemonCommand;
use ConorSmith\Pokemon\Team\Controllers\GetPokemon;
use ConorSmith\Pokemon\Team\Controllers\GetPokemonBreed;
use ConorSmith\Pokemon\Team\Controllers\GetTeam;
use ConorSmith\Pokemon\Controllers\GetIndex;
use ConorSmith\Pokemon\Controllers\GetMap;
use ConorSmith\Pokemon\Controllers\GetTeamItemUse;
use ConorSmith\Pokemon\Controllers\PostItemUse;
use ConorSmith\Pokemon\Controllers\PostMapMove;
use ConorSmith\Pokemon\Team\Controllers\GetTeamCombinations;
use ConorSmith\Pokemon\Team\Controllers\GetTeamCompare;
use ConorSmith\Pokemon\Team\Controllers\PostPokemonBreed;
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
use ConorSmith\Pokemon\Team\ReduceEggCyclesCommand;
use ConorSmith\Pokemon\Team\Repositories\EggRepositoryDb;
use ConorSmith\Pokemon\Team\Repositories\EvolutionRepository;
use ConorSmith\Pokemon\Team\Repositories\PokemonConfigRepository;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepositoryDb;
use ConorSmith\Pokemon\Team\UseCases\ShowBox;
use ConorSmith\Pokemon\Team\UseCases\ShowDayCare;
use ConorSmith\Pokemon\Team\UseCases\ShowEggs;
use ConorSmith\Pokemon\Team\UseCases\ShowTeam;
use ConorSmith\Pokemon\Team\UseCases\ShowTeamCoverage;
use ConorSmith\Pokemon\Team\WeeklyUpdateForTeamCommand;
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
        $r->get("/log/stretches", GetLogStretches::class);
        $r->post("/log/stretches", PostLogStretches::class);

        $r->get("/pokedex", GetPokedex::class);
        $r->get("/pokedex/{number}", GetPokedexEntry::class);
        $r->post("/map/move", PostMapMove::class);
        $r->get("/map", GetMap::class);
        $r->get("/track-pokemon/{encounterType}", GetTrackPokemon::class);
        $r->post("/encounter", PostEncounterGenerateAndStart::class);
        $r->post("/encounter/generate", PostEncounterGenerate::class);
        $r->get("/team", GetTeam::class);
        $r->get("/team/compare", GetTeamCompare::class);
        $r->get("/team/combinations", GetTeamCombinations::class);
        $r->get("/team/member/{id}", GetPokemon::class);
        $r->get("/team/member/{id}/breed", GetPokemonBreed::class);
        $r->post("/team/member/{id}/breed", PostPokemonBreed::class);
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
        private readonly RepositoryFactory $repositoryFactory,
        private readonly LocationControllerFactory $locationControllerFactory,
        private readonly Connection $db,
        private readonly Session $session,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly TrainerConfigRepository $trainerConfigRepository,
        private readonly FriendshipLog $friendshipLog,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly ReportTeamPokemonFaintedCommand $reportTeamPokemonFaintedCommand,
        private readonly ReportBattleWithGymLeaderCommand $reportBattleWithGymLeaderCommand,
        private readonly array $pokedex,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function create(string $className, InstanceId $instanceId): mixed
    {
        $controller = $this->locationControllerFactory->create($className, $instanceId);

        if (!is_null($controller)) {
            return $controller;
        }

        return match ($className) {
            GetLogFoodDiary::class => new GetLogFoodDiary(
                $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId),
                $this->templateEngine,
            ),
            PostLogFoodDiary::class => new PostLogFoodDiary(
                $this->db,
                $this->session,
                $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
            ),
            GetLogWeeklyReview::class => new GetLogWeeklyReview(
                $this->templateEngine,
            ),
            PostLogWeeklyReview::class => new PostLogWeeklyReview(
                $this->db,
                $this->session,
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId),
                $this->repositoryFactory->create(WeeklyHabitLogRepository::class, $instanceId),
                new WeeklyUpdateForTeamCommand(
                    $this->session,
                    $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId),
                    new LevelUpPokemon(
                        $this->db,
                        $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId),
                        $this->repositoryFactory->create(EvolutionRepository::class, $instanceId),
                        new FriendshipLog($this->db),
                        new HighestRankedGymBadgeQueryDb(
                            $this->db,
                            $instanceId,
                        ),
                        $instanceId,
                    ),
                    new PokedexConfigRepository(),
                ),
            ),
            GetLogStretches::class => new GetLogStretches(
                $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId),
                $this->templateEngine,
            ),
            PostLogStretches::class => new PostLogStretches(
                $this->db,
                $this->session,
                $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
            ),
            GetPokedex::class => new GetPokedex(
                $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                new PokedexConfigRepository(),
                $this->templateEngine,
            ),
            GetPokedexEntry::class => new GetPokedexEntry(
                $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                new RegionRepositoryRegionIsLockedQuery(
                    $this->repositoryFactory->create(RegionRepository::class, $instanceId),
                ),
                new EncounterConfigRepository(),
                new LocationConfigRepository(),
                new PokedexConfigRepository(),
                $this->templateEngine,
            ),
            GetLogCalorieGoal::class => new GetLogCalorieGoal(
                $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId),
                $this->templateEngine,
            ),
            PostLogCalorieGoal::class => new PostLogCalorieGoal(
                $this->db,
                $this->session,
                $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
            ),
            PostMapMove::class => new PostMapMove(
                $this->db,
                $this->session,
                $this->locationConfigRepository,
            ),
            GetLogExercise::class => new GetLogExercise(
                $this->repositoryFactory->create(UnlimitedHabitLogRepository::class, $instanceId),
                $this->templateEngine,
            ),
            PostLogExercise::class => new PostLogExercise(
                $this->db,
                $this->session,
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(UnlimitedHabitLogRepository::class, $instanceId),
                new ReduceEggCyclesCommand(
                    $this->repositoryFactory->create(EggRepositoryDb::class, $instanceId)
                ),
            ),
            PostEncounterGenerateAndStart::class => new PostEncounterGenerateAndStart(
                new CreateALegendaryEncounter(
                    $this->repositoryFactory->create(EncounterRepository::class, $instanceId),
                    $this->repositoryFactory->create(BagRepository::class, $instanceId),
                ),
                new StartAnEncounter(
                    $this->repositoryFactory->create(EncounterRepository::class, $instanceId),
                ),
            ),
            PostEncounterGenerate::class => new PostEncounterGenerate(
                new CreateAWildEncounter(
                    $this->repositoryFactory->create(EncounterRepository::class, $instanceId),
                    $this->repositoryFactory->create(LocationRepository::class, $instanceId),
                ),
                $this->viewModelFactory,
            ),
            PostEncounterStart::class => new PostEncounterStart(
                new StartAnEncounter(
                    $this->repositoryFactory->create(EncounterRepository::class, $instanceId),
                ),
            ),
            GetTeam::class => new GetTeam(
                new ShowTeam(
                    $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId)
                ),
                new ShowEggs(
                    $this->repositoryFactory->create(EggRepositoryDb::class, $instanceId)
                ),
                new ShowDayCare(
                    $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId)
                ),
                new ShowBox(
                    $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId)
                ),
                new ShowTeamCoverage(
                    $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId)
                ),
                $this->templateEngine,
            ),
            GetTeamCompare::class => new GetTeamCompare(
                $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId),
                $this->templateEngine,
            ),
            GetTeamCombinations::class => new GetTeamCombinations(
                $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                new PokemonConfigRepository(),
                $this->templateEngine,
            ),
            GetPokemon::class => new GetPokemon(
                $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId),
                $this->locationConfigRepository,
                $this->templateEngine,
            ),
            GetPokemonBreed::class => new GetPokemonBreed(
                $this->session,
                $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId),
                $this->templateEngine,
            ),
            PostPokemonBreed::class => new PostPokemonBreed(
                $this->session,
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(EggRepositoryDb::class, $instanceId),
                $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId),
                new PokedexConfigRepository(),
            ),
            GetEncounter::class => new GetEncounter(
                $this->repositoryFactory->create(PlayerRepository::class, $instanceId),
                $this->repositoryFactory->create(EncounterRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->viewModelFactory,
                $this->templateEngine,
            ),
            PostEncounterCatch::class => new PostEncounterCatch(
                $this->db,
                $this->repositoryFactory->create(EncounterRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->locationConfigRepository,
                new CatchPokemonCommand(
                    $this->db,
                    new FriendshipLog($this->db),
                    new RegisterNewPokemonCommand(
                        $this->db,
                        $instanceId,
                    ),
                    new PokedexConfigRepository(),
                    new LocationConfigRepository(),
                    $instanceId,
                ),
                new TotalRegisteredPokemonQuery(
                    $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                ),
                new EventFactory(
                    $this->viewModelFactory,
                    new PokedexConfigRepository(),
                ),
            ),
            PostEncounterRun::class => new PostEncounterRun(
                $this->repositoryFactory->create(EncounterRepository::class, $instanceId),
                $this->repositoryFactory->create(PlayerRepository::class, $instanceId),
            ),
            PostEncounterFight::class => new PostEncounterFight(
                $this->session,
                $this->repositoryFactory->create(EncounterRepository::class, $instanceId),
                $this->repositoryFactory->create(PlayerRepository::class, $instanceId),
                new EventFactory(
                    $this->viewModelFactory,
                    new PokedexConfigRepository(),
                ),
                $this->reportTeamPokemonFaintedCommand,
            ),
            PostTeamMoveUp::class => new PostTeamMoveUp(
                $this->db,
                $this->session,
                $this->repositoryFactory->create(CaughtPokemonRepository::class, $instanceId),
            ),
            PostTeamMoveDown::class => new PostTeamMoveDown(
                $this->db,
                $this->session,
                $this->repositoryFactory->create(CaughtPokemonRepository::class, $instanceId),
            ),
            PostTeamSendToBox::class => new PostTeamSendToBox(
                $this->session,
                $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId),
                $this->friendshipLog,
            ),
            PostTeamSendToTeam::class => new PostTeamSendToTeam(
                $this->session,
                $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId),
                $this->friendshipLog,
            ),
            PostTeamSendToDayCare::class => new PostTeamSendToDayCare(
                $this->session,
                $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId),
                $this->friendshipLog,
            ),
            PostBattleStart::class => new PostBattleStart(
                $this->session,
                new StartABattle(
                    $this->repositoryFactory->create(BagRepository::class, $instanceId),
                    $this->repositoryFactory->create(PlayerRepository::class, $instanceId),
                    $this->repositoryFactory->create(TrainerRepository::class, $instanceId),
                    $this->repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId),
                    $this->reportBattleWithGymLeaderCommand,
                ),
            ),
            GetBattle::class => new GetBattle(
                $this->db,
                $this->trainerConfigRepository,
                $this->repositoryFactory->create(TrainerRepository::class, $instanceId),
                $this->repositoryFactory->create(PlayerRepository::class, $instanceId),
                $this->viewModelFactory,
                $this->templateEngine,
            ),
            GetHallOfFame::class => new GetHallOfFame(
                $this->session,
                $this->repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId),
                new PokedexConfigRepository(),
                $this->templateEngine,
            ),
            PostBattleFight::class => new PostBattleFight(
                $this->db,
                $this->session,
                new ItemConfigRepository(),
                $this->repositoryFactory->create(TrainerRepository::class, $instanceId),
                $this->repositoryFactory->create(PlayerRepository::class, $instanceId),
                $this->repositoryFactory->create(AreaRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->reportTeamPokemonFaintedCommand,
                new BoostPokemonEvsCommand(
                    $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId)
                ),
                new EventFactory(
                    $this->viewModelFactory,
                    new PokedexConfigRepository(),
                ),
                $this->viewModelFactory,
            ),
            GetSwitch::class => new GetSwitch(
                $this->repositoryFactory->create(PlayerRepository::class, $instanceId),
                $this->viewModelFactory,
                $this->templateEngine,
            ),
            PostSwitch::class => new PostSwitch(
                $this->repositoryFactory->create(PlayerRepository::class, $instanceId),
            ),
            PostBattleFinish::class => new PostBattleFinish(
                $this->repositoryFactory->create(TrainerRepository::class, $instanceId),
                $this->repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId),
                new StartABattle(
                    $this->repositoryFactory->create(BagRepository::class, $instanceId),
                    $this->repositoryFactory->create(PlayerRepository::class, $instanceId),
                    $this->repositoryFactory->create(TrainerRepository::class, $instanceId),
                    $this->repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId),
                    $this->reportBattleWithGymLeaderCommand,
                ),
            ),
            GetBag::class => new GetBag(
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                new ItemConfigRepository(),
                $this->templateEngine,
            ),
            PostItemUse::class => new PostItemUse(
            ),
            GetTeamItemUse::class => new GetTeamItemUse(
                $this->session,
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId),
                $this->templateEngine,
            ),
            PostTeamItemUse::class => new PostTeamItemUse(
                $this->db,
                $this->session,
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId),
                new LevelUpPokemon(
                    $this->db,
                    $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId),
                    $this->repositoryFactory->create(EvolutionRepository::class, $instanceId),
                    new FriendshipLog($this->db),
                    new HighestRankedGymBadgeQueryDb(
                        $this->db,
                        $instanceId,
                    ),
                    $instanceId,
                ),
                new ItemConfigRepository(),
                $this->pokedex,
            ),
            PostChallengeEliteFour::class => new PostChallengeEliteFour(
                $this->session,
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(PlayerRepository::class, $instanceId),
                $this->repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId),
                new StartABattle(
                    $this->repositoryFactory->create(BagRepository::class, $instanceId),
                    $this->repositoryFactory->create(PlayerRepository::class, $instanceId),
                    $this->repositoryFactory->create(TrainerRepository::class, $instanceId),
                    $this->repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId),
                    $this->reportBattleWithGymLeaderCommand,
                ),
            ),
            GetIndex::class => new GetIndex(
                $this->db,
                $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId),
                $this->viewModelFactory,
                $this->templateEngine,
            ),
        };
    }
}