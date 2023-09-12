<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\System;

use ConorSmith\Pokemon\Battle\Controllers\GetBattle;
use ConorSmith\Pokemon\Battle\Controllers\GetEncounter;
use ConorSmith\Pokemon\Battle\Controllers\GetHallOfFame;
use ConorSmith\Pokemon\Battle\Controllers\GetSwitch;
use ConorSmith\Pokemon\Battle\Controllers\PostBattleFight;
use ConorSmith\Pokemon\Battle\Controllers\PostBattleFinish;
use ConorSmith\Pokemon\Battle\Controllers\PostBattleStart;
use ConorSmith\Pokemon\Battle\Controllers\PostChallengeEliteFour;
use ConorSmith\Pokemon\Battle\Controllers\PostEncounterCatch;
use ConorSmith\Pokemon\Battle\Controllers\PostEncounterFight;
use ConorSmith\Pokemon\Battle\Controllers\PostEncounterGenerate;
use ConorSmith\Pokemon\Battle\Controllers\PostEncounterGenerateAndStart;
use ConorSmith\Pokemon\Battle\Controllers\PostEncounterRun;
use ConorSmith\Pokemon\Battle\Controllers\PostEncounterStart;
use ConorSmith\Pokemon\Battle\Controllers\PostSwitch;
use ConorSmith\Pokemon\Battle\Domain\BattleRepository;
use ConorSmith\Pokemon\Battle\EliteFourChallengeCurrentPokemonLeagueQuery;
use ConorSmith\Pokemon\Battle\EventFactory;
use ConorSmith\Pokemon\Battle\Repositories\AreaRepository;
use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Battle\Repositories\EncounterRepository;
use ConorSmith\Pokemon\Battle\Repositories\LeagueChampionRepository;
use ConorSmith\Pokemon\Battle\Repositories\LocationRepository;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepositoryDb;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\Battle\UseCases\CreateALegendaryEncounter;
use ConorSmith\Pokemon\Battle\UseCases\CreateAWildEncounter;
use ConorSmith\Pokemon\Battle\UseCases\StartABattle;
use ConorSmith\Pokemon\Battle\UseCases\StartAnEncounter;
use ConorSmith\Pokemon\EncounterConfigRepository;
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
use ConorSmith\Pokemon\Habit\FoodDiaryHabitStreakQuery;
use ConorSmith\Pokemon\Habit\Repositories\DailyHabitLogRepository;
use ConorSmith\Pokemon\Habit\Repositories\UnlimitedHabitLogRepository;
use ConorSmith\Pokemon\Habit\Repositories\WeeklyHabitLogRepository;
use ConorSmith\Pokemon\ItemConfigRepository;
use ConorSmith\Pokemon\Location\Controllers\ControllerFactory as LocationControllerFactory;
use ConorSmith\Pokemon\Location\Controllers\GetMap;
use ConorSmith\Pokemon\Location\Controllers\GetTrackPokemon;
use ConorSmith\Pokemon\Location\Controllers\PostMapMove;
use ConorSmith\Pokemon\Location\LocationRepositoryCurrentLocationQuery;
use ConorSmith\Pokemon\Location\RegionRepositoryRegionIsLockedQuery;
use ConorSmith\Pokemon\Location\Repositories\RegionRepository;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\Party\BoostPokemonEvsCommand;
use ConorSmith\Pokemon\Party\CapturedPokemonQuery;
use ConorSmith\Pokemon\Party\CatchPokemonCommand;
use ConorSmith\Pokemon\Party\Controllers\GetParty;
use ConorSmith\Pokemon\Party\Controllers\GetPartyBox;
use ConorSmith\Pokemon\Party\Controllers\GetPartyCombinations;
use ConorSmith\Pokemon\Party\Controllers\GetPartyCompare;
use ConorSmith\Pokemon\Party\Controllers\GetPartyDayCare;
use ConorSmith\Pokemon\Party\Controllers\GetPartyEggs;
use ConorSmith\Pokemon\Party\Controllers\GetPartyItemUse;
use ConorSmith\Pokemon\Party\Controllers\GetPokemon;
use ConorSmith\Pokemon\Party\Controllers\GetPokemonBreed;
use ConorSmith\Pokemon\Party\Controllers\PostPartyItemUse;
use ConorSmith\Pokemon\Party\Controllers\PostPartyMoveDown;
use ConorSmith\Pokemon\Party\Controllers\PostPartyMoveUp;
use ConorSmith\Pokemon\Party\Controllers\PostPartySendToBox;
use ConorSmith\Pokemon\Party\Controllers\PostPartySendToDayCare;
use ConorSmith\Pokemon\Party\Controllers\PostPartySendToParty;
use ConorSmith\Pokemon\Party\Controllers\PostPokemonBreed;
use ConorSmith\Pokemon\Party\Domain\GenealogyRepository;
use ConorSmith\Pokemon\Party\FriendshipLog;
use ConorSmith\Pokemon\Party\LevelUpPokemon;
use ConorSmith\Pokemon\Party\ReduceEggCyclesCommand;
use ConorSmith\Pokemon\Party\Repositories\CaughtPokemonRepository;
use ConorSmith\Pokemon\Party\Repositories\EggRepositoryDb;
use ConorSmith\Pokemon\Party\Repositories\EvolutionRepository;
use ConorSmith\Pokemon\Party\Repositories\PokemonConfigRepository;
use ConorSmith\Pokemon\Party\Repositories\PokemonRepositoryDb;
use ConorSmith\Pokemon\Party\UseCases\AddNewPokemon;
use ConorSmith\Pokemon\Party\UseCases\ShowBox;
use ConorSmith\Pokemon\Party\UseCases\ShowDayCare;
use ConorSmith\Pokemon\Party\UseCases\ShowEggs;
use ConorSmith\Pokemon\Party\UseCases\ShowParty;
use ConorSmith\Pokemon\Party\UseCases\ShowPartyCoverage;
use ConorSmith\Pokemon\Party\WeeklyUpdateForPartyCommand;
use ConorSmith\Pokemon\Player\Controllers\GetBag;
use ConorSmith\Pokemon\Player\Controllers\GetIndex;
use ConorSmith\Pokemon\Player\Controllers\PostItemUse;
use ConorSmith\Pokemon\Player\HighestRankedGymBadgeQueryDb;
use ConorSmith\Pokemon\Pokedex\Controllers\GetPokedex;
use ConorSmith\Pokemon\Pokedex\Controllers\GetPokedexEntry;
use ConorSmith\Pokemon\Pokedex\RegisteredPokedexNumbersQuery;
use ConorSmith\Pokemon\Pokedex\RegisterNewPokemonCommand;
use ConorSmith\Pokemon\Pokedex\Repositories\EvolutionaryLineRepository;
use ConorSmith\Pokemon\Pokedex\Repositories\PokedexEntryRepository;
use ConorSmith\Pokemon\Pokedex\TotalRegisteredPokemonQuery;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Commands\ReportBattleWithGymLeaderCommand;
use ConorSmith\Pokemon\SharedKernel\Commands\ReportPartyPokemonFaintedCommand;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\SharedKernel\UseCases\SpendChallengeTokensUseCase;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\TrainerConfigRepository;
use ConorSmith\Pokemon\ViewModelFactory;
use Doctrine\DBAL\Connection;
use FastRoute\RouteCollector;
use LogicException;
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
        $r->get("/party", GetParty::class);
        $r->get("/party/eggs", GetPartyEggs::class);
        $r->get("/party/day-care", GetPartyDayCare::class);
        $r->get("/party/box", GetPartyBox::class);
        $r->get("/party/compare", GetPartyCompare::class);
        $r->get("/party/combinations", GetPartyCombinations::class);
        $r->get("/party/member/{id}", GetPokemon::class);
        $r->get("/party/member/{id}/breed", GetPokemonBreed::class);
        $r->post("/party/member/{id}/breed", PostPokemonBreed::class);
        $r->get("/encounter/{id}", GetEncounter::class);
        $r->post("/encounter/{id}/start", PostEncounterStart::class);
        $r->post("/encounter/{id}/catch", PostEncounterCatch::class);
        $r->post("/encounter/{id}/fight", PostEncounterFight::class);
        $r->post("/encounter/{id}/run", PostEncounterRun::class);
        $r->post("/party/move-up", PostPartyMoveUp::class);
        $r->post("/party/move-down", PostPartyMoveDown::class);
        $r->post("/party/send-to-box", PostPartySendToBox::class);
        $r->post("/party/send-to-party", PostPartySendToParty::class);
        $r->post("/party/send-to-day-care", PostPartySendToDayCare::class);
        $r->post("/battle/trainer/{id}", PostBattleStart::class);
        $r->get("/battle/{id}", GetBattle::class);
        $r->post("/battle/{id}/fight", PostBattleFight::class);
        $r->get("/party/switch", GetSwitch::class);
        $r->post("/party/switch", PostSwitch::class);
        $r->post("/battle/{id}/finish", PostBattleFinish::class);
        $r->post("/challenge/elite-four/{region}", PostChallengeEliteFour::class);
        $r->get("/hall-of-fame/{region}", GetHallOfFame::class);
        $r->get("/bag", GetBag::class);
        $r->post("/item/{id}/use", PostItemUse::class);
        $r->get("/party/use/{id}", GetPartyItemUse::class);
        $r->post("/party/use/{id}", PostPartyItemUse::class);
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
        private readonly ReportPartyPokemonFaintedCommand $reportPartyPokemonFaintedCommand,
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
            GetLogFoodDiary::class               => new GetLogFoodDiary(
                $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId),
                $this->templateEngine,
            ),
            PostLogFoodDiary::class              => new PostLogFoodDiary(
                $this->db,
                $this->session,
                $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
            ),
            GetLogWeeklyReview::class            => new GetLogWeeklyReview(
                $this->templateEngine,
            ),
            PostLogWeeklyReview::class           => new PostLogWeeklyReview(
                $this->db,
                $this->session,
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId),
                $this->repositoryFactory->create(WeeklyHabitLogRepository::class, $instanceId),
                new WeeklyUpdateForPartyCommand(
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
            GetLogStretches::class               => new GetLogStretches(
                $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId),
                $this->templateEngine,
            ),
            PostLogStretches::class              => new PostLogStretches(
                $this->db,
                $this->session,
                $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
            ),
            GetPokedex::class                    => new GetPokedex(
                $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                new PokedexConfigRepository(),
                new RegionRepositoryRegionIsLockedQuery(
                    $this->repositoryFactory->create(RegionRepository::class, $instanceId),
                ),
                $this->templateEngine,
            ),
            GetPokedexEntry::class               => new GetPokedexEntry(
                $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                new EvolutionaryLineRepository(
                    new PokedexConfigRepository(),
                ),
                new RegionRepositoryRegionIsLockedQuery(
                    $this->repositoryFactory->create(RegionRepository::class, $instanceId),
                ),
                new EncounterConfigRepository(),
                new ItemConfigRepository(),
                new LocationConfigRepository(),
                new PokedexConfigRepository(),
                $this->templateEngine,
            ),
            GetLogCalorieGoal::class             => new GetLogCalorieGoal(
                $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId),
                $this->templateEngine,
            ),
            PostLogCalorieGoal::class            => new PostLogCalorieGoal(
                $this->db,
                $this->session,
                $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
            ),
            PostMapMove::class                   => new PostMapMove(
                $this->db,
                $this->session,
                $this->locationConfigRepository,
            ),
            GetLogExercise::class                => new GetLogExercise(
                $this->repositoryFactory->create(UnlimitedHabitLogRepository::class, $instanceId),
                $this->templateEngine,
            ),
            PostLogExercise::class               => new PostLogExercise(
                $this->db,
                $this->session,
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(UnlimitedHabitLogRepository::class, $instanceId),
                new ReduceEggCyclesCommand(
                    $this->session,
                    $this->repositoryFactory->create(EggRepositoryDb::class, $instanceId),
                    $this->repositoryFactory->create(GenealogyRepository::class, $instanceId),
                    new AddNewPokemon(
                        $this->db,
                        new RegisterNewPokemonCommand(
                            $this->db,
                            $instanceId,
                        ),
                        new PokedexConfigRepository(),
                        new LocationConfigRepository(),
                        $instanceId,
                    ),
                    new PokedexConfigRepository(),
                    new FoodDiaryHabitStreakQuery(
                        $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId)
                    ),
                    new LocationRepositoryCurrentLocationQuery(
                        new \ConorSmith\Pokemon\Location\Repositories\LocationRepository(
                            $this->db,
                            $this->repositoryFactory->create(RegionRepository::class, $instanceId),
                            new LocationConfigRepository(),
                            $instanceId,
                        ),
                    ),
                    new TotalRegisteredPokemonQuery(
                        $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                    ),
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
            PostEncounterGenerate::class         => new PostEncounterGenerate(
                new CreateAWildEncounter(
                    $this->repositoryFactory->create(EncounterRepository::class, $instanceId),
                    $this->repositoryFactory->create(LocationRepository::class, $instanceId),
                ),
                $this->viewModelFactory,
            ),
            PostEncounterStart::class            => new PostEncounterStart(
                new StartAnEncounter(
                    $this->repositoryFactory->create(EncounterRepository::class, $instanceId),
                ),
            ),
            GetParty::class                      => new GetParty(
                new ShowParty(
                    $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId)
                ),
                new ShowEggs(
                    $this->repositoryFactory->create(EggRepositoryDb::class, $instanceId),
                    $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId),
                ),
                new ShowDayCare(
                    $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId)
                ),
                new ShowBox(
                    $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId)
                ),
                new ShowPartyCoverage(
                    $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId)
                ),
                $this->templateEngine,
            ),
            GetPartyEggs::class                  => new GetPartyEggs(),
            GetPartyDayCare::class               => new GetPartyDayCare(),
            GetPartyBox::class                   => new GetPartyBox(),
            GetPartyCompare::class               => new GetPartyCompare(
                $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId),
                $this->templateEngine,
            ),
            GetPartyCombinations::class          => new GetPartyCombinations(
                new RegisteredPokedexNumbersQuery(
                    $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId)
                ),
                new PokemonConfigRepository(),
                $this->templateEngine,
            ),
            GetPokemon::class                    => new GetPokemon(
                $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId),
                $this->locationConfigRepository,
                $this->templateEngine,
            ),
            GetPokemonBreed::class               => new GetPokemonBreed(
                $this->session,
                $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId),
                $this->templateEngine,
            ),
            PostPokemonBreed::class              => new PostPokemonBreed(
                $this->session,
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(EggRepositoryDb::class, $instanceId),
                $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId),
                new PokedexConfigRepository(),
            ),
            GetEncounter::class                  => new GetEncounter(
                $this->repositoryFactory->create(PlayerRepositoryDb::class, $instanceId),
                $this->repositoryFactory->create(EncounterRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->viewModelFactory,
                $this->templateEngine,
            ),
            PostEncounterCatch::class            => new PostEncounterCatch(
                $this->db,
                $this->repositoryFactory->create(EncounterRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->locationConfigRepository,
                new CatchPokemonCommand(
                    new AddNewPokemon(
                        $this->db,
                        new RegisterNewPokemonCommand(
                            $this->db,
                            $instanceId,
                        ),
                        new PokedexConfigRepository(),
                        new LocationConfigRepository(),
                        $instanceId,
                    ),
                    $this->db,
                    new FriendshipLog($this->db),
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
            PostEncounterRun::class              => new PostEncounterRun(
                $this->repositoryFactory->create(EncounterRepository::class, $instanceId),
                $this->repositoryFactory->create(PlayerRepositoryDb::class, $instanceId),
            ),
            PostEncounterFight::class            => new PostEncounterFight(
                $this->session,
                $this->repositoryFactory->create(EncounterRepository::class, $instanceId),
                $this->repositoryFactory->create(PlayerRepositoryDb::class, $instanceId),
                new EventFactory(
                    $this->viewModelFactory,
                    new PokedexConfigRepository(),
                ),
                $this->reportPartyPokemonFaintedCommand,
            ),
            PostPartyMoveUp::class               => new PostPartyMoveUp(
                $this->db,
                $this->session,
                $this->repositoryFactory->create(CaughtPokemonRepository::class, $instanceId),
            ),
            PostPartyMoveDown::class             => new PostPartyMoveDown(
                $this->db,
                $this->session,
                $this->repositoryFactory->create(CaughtPokemonRepository::class, $instanceId),
            ),
            PostPartySendToBox::class            => new PostPartySendToBox(
                $this->session,
                $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId),
                $this->friendshipLog,
            ),
            PostPartySendToParty::class          => new PostPartySendToParty(
                $this->session,
                $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId),
                $this->friendshipLog,
            ),
            PostPartySendToDayCare::class        => new PostPartySendToDayCare(
                $this->session,
                $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId),
                $this->friendshipLog,
            ),
            PostBattleStart::class               => new PostBattleStart(
                $this->session,
                new StartABattle(
                    $this->repositoryFactory->create(BattleRepository::class, $instanceId),
                    $this->repositoryFactory->create(PlayerRepositoryDb::class, $instanceId),
                    $this->repositoryFactory->create(TrainerRepository::class, $instanceId),
                    $this->reportBattleWithGymLeaderCommand,
                ),
                new SpendChallengeTokensUseCase(
                    $this->repositoryFactory->create(BagRepository::class, $instanceId),
                ),
            ),
            GetBattle::class                     => new GetBattle(
                $this->db,
                $this->trainerConfigRepository,
                $this->repositoryFactory->create(TrainerRepository::class, $instanceId),
                $this->repositoryFactory->create(PlayerRepositoryDb::class, $instanceId),
                $this->viewModelFactory,
                $this->templateEngine,
            ),
            GetHallOfFame::class                 => new GetHallOfFame(
                $this->session,
                $this->repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId),
                new PokedexConfigRepository(),
                $this->templateEngine,
            ),
            PostBattleFight::class               => new PostBattleFight(
                $this->db,
                $this->session,
                new ItemConfigRepository(),
                $this->repositoryFactory->create(TrainerRepository::class, $instanceId),
                $this->repositoryFactory->create(PlayerRepositoryDb::class, $instanceId),
                $this->repositoryFactory->create(AreaRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(BattleRepository::class, $instanceId),
                $this->reportPartyPokemonFaintedCommand,
                new BoostPokemonEvsCommand(
                    $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId)
                ),
                new EventFactory(
                    $this->viewModelFactory,
                    new PokedexConfigRepository(),
                ),
                $this->viewModelFactory,
            ),
            GetSwitch::class                     => new GetSwitch(
                $this->repositoryFactory->create(PlayerRepositoryDb::class, $instanceId),
                $this->viewModelFactory,
                $this->templateEngine,
            ),
            PostSwitch::class                    => new PostSwitch(
                $this->repositoryFactory->create(PlayerRepositoryDb::class, $instanceId),
            ),
            PostBattleFinish::class              => new PostBattleFinish(
                $this->repositoryFactory->create(PlayerRepositoryDb::class, $instanceId),
                $this->repositoryFactory->create(TrainerRepository::class, $instanceId),
                $this->repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId),
                $this->repositoryFactory->create(LeagueChampionRepository::class, $instanceId),
                new StartABattle(
                    $this->repositoryFactory->create(BattleRepository::class, $instanceId),
                    $this->repositoryFactory->create(PlayerRepositoryDb::class, $instanceId),
                    $this->repositoryFactory->create(TrainerRepository::class, $instanceId),
                    $this->reportBattleWithGymLeaderCommand,
                ),
            ),
            GetBag::class                        => new GetBag(
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                new ItemConfigRepository(),
                $this->templateEngine,
            ),
            PostItemUse::class                   => new PostItemUse(
            ),
            GetPartyItemUse::class               => new GetPartyItemUse(
                $this->session,
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId),
                $this->templateEngine,
            ),
            PostPartyItemUse::class              => new PostPartyItemUse(
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
            PostChallengeEliteFour::class        => new PostChallengeEliteFour(
                $this->session,
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(PlayerRepositoryDb::class, $instanceId),
                $this->repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId),
                new StartABattle(
                    $this->repositoryFactory->create(BattleRepository::class, $instanceId),
                    $this->repositoryFactory->create(PlayerRepositoryDb::class, $instanceId),
                    $this->repositoryFactory->create(TrainerRepository::class, $instanceId),
                    $this->reportBattleWithGymLeaderCommand,
                ),
            ),
            GetIndex::class                      => new GetIndex(
                $this->db,
                new CapturedPokemonQuery(
                    $this->repositoryFactory->create(PokemonRepositoryDb::class, $instanceId),
                ),
                new LocationRepositoryCurrentLocationQuery(
                    new \ConorSmith\Pokemon\Location\Repositories\LocationRepository(
                        $this->db,
                        $this->repositoryFactory->create(RegionRepository::class, $instanceId),
                        new LocationConfigRepository(),
                        $instanceId,
                    ),
                ),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->locationConfigRepository,
                new EliteFourChallengeCurrentPokemonLeagueQuery(
                    $this->repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId),
                ),
                $this->viewModelFactory,
                $this->templateEngine,
            ),
            default                              => throw new LogicException(),
        };
    }
}