<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\System;

use ConorSmith\Pokemon\Gameplay\App\UseCases\AddNewEgg;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\AreaRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\EncounterRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\LeagueChampionRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\LocationRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\TrainerRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\EggRepository;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers\GetBattle;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers\GetEncounter;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers\GetHallOfFame;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers\GetSwitch;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers\PostBattleFight;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers\PostBattleFinish;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers\PostBattleStart;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers\PostChallengeEliteFour;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers\PostEncounterCatch;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers\PostEncounterFight;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers\PostEncounterGenerate;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers\PostEncounterGenerateAndStart;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers\PostEncounterRun;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers\PostEncounterStart;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers\PostSwitch;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\BattleRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\PlayerRepository;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\ViewModels\EventFactory;
use ConorSmith\Pokemon\Gameplay\App\UseCases\CreateAFixedEncounter;
use ConorSmith\Pokemon\Gameplay\App\UseCases\CreateAWildEncounter;
use ConorSmith\Pokemon\Gameplay\App\UseCases\StartABattle;
use ConorSmith\Pokemon\Gameplay\App\UseCases\StartAnEncounter;
use ConorSmith\Pokemon\EliteFourConfigRepository;
use ConorSmith\Pokemon\FixedEncounterConfigRepository;
use ConorSmith\Pokemon\Gameplay\App\UseCases\FinishSurveyingPokemon;
use ConorSmith\Pokemon\Gameplay\App\UseCases\ShowActiveSurvey;
use ConorSmith\Pokemon\Gameplay\App\UseCases\ShowSurveyRecord;
use ConorSmith\Pokemon\Gameplay\App\UseCases\StartSurveyingPokemon;
use ConorSmith\Pokemon\Gameplay\Domain\Evolution\EvolutionRepository;
use ConorSmith\Pokemon\Gameplay\Domain\InGameEvents\FixedEncounterCaptureEventRepository;
use ConorSmith\Pokemon\Gameplay\Domain\InGameEvents\ObtainedGiftPokemonRepository;
use ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures\FindFeatures;
use ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures\FindFixedEncounters;
use ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures\FindPokemonLeague;
use ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures\FindTrainers;
use ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures\FindWildEncounters;
use ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures\RegionRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Notifications\NotificationRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\CaughtPokemonRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\FriendshipEventLogRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Pokedex\PokedexEntryRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Surveying\SurveyRepository;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\Controllers\GetEliteFour;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\Controllers\GetSurveyPokemon;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\Controllers\GetTrainers;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\Controllers\PostSurveyPokemonFinish;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\Controllers\PostSurveyPokemonStart;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Player\Controllers\GetNotifications;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Player\Controllers\GetStatus;
use ConorSmith\Pokemon\Gameplay\Domain\GymBadgeRepository;
use ConorSmith\Pokemon\MainMenu\Infra\Endpoints\NewGame\Controllers\GetNewGame;
use ConorSmith\Pokemon\MainMenu\Infra\Endpoints\NewGame\Controllers\PostNewGame;
use ConorSmith\Pokemon\MainMenu\Infra\Repositories\InstanceRepositoryDb;
use ConorSmith\Pokemon\WildEncounterConfigRepository;
use ConorSmith\Pokemon\GiftPokemonConfigRepository;
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
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\Controllers\GetMap;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\Controllers\GetTrackPokemon;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\Controllers\GetObtainablePokemon;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\Controllers\PostMapMove;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers\GetParty;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers\GetPartyBox;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers\GetPartyCombinations;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers\GetPartyCompare;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers\GetPartyDayCare;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers\GetPartyEggs;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers\GetPartyItemUse;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers\GetPokemon;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers\GetPokemonBreed;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers\GetPokemonItemGive;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers\GetPokemonItemUse;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers\PostObtain;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers\PostPartyItemGive;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers\PostPartyItemUse;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers\PostPartyMoveDown;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers\PostPartyMoveUp;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers\PostPartySendToBox;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers\PostPartySendToDayCare;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers\PostPartySendToParty;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers\PostPokemonBreed;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers\PostPokemonItemTake;
use ConorSmith\Pokemon\Gameplay\Domain\Breeding\GenealogyRepository;
use ConorSmith\Pokemon\Gameplay\App\UseCases\LevelUpPokemon;
use ConorSmith\Pokemon\Gameplay\Infra\ReduceEggCyclesCommand;
use ConorSmith\Pokemon\Gameplay\App\UseCases\AddNewPokemon;
use ConorSmith\Pokemon\Gameplay\App\UseCases\ShowBox;
use ConorSmith\Pokemon\Gameplay\App\UseCases\ShowDayCare;
use ConorSmith\Pokemon\Gameplay\App\UseCases\ShowEggs;
use ConorSmith\Pokemon\Gameplay\App\UseCases\ShowParty;
use ConorSmith\Pokemon\Gameplay\App\UseCases\ShowPartyCoverage;
use ConorSmith\Pokemon\Gameplay\Infra\WeeklyUpdateForPartyCommand;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Bag\Controllers\GetBag;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Index\Controllers\GetIndex;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Bag\Controllers\PostItemUse;
use ConorSmith\Pokemon\Gameplay\Infra\NotifyPlayerCommand;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Pokedex\Controllers\GetPokedex;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Pokedex\Controllers\GetPokedexEntry;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\EvolutionaryLineRepositoryConfig;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand as NotifyPlayerCommandInterface;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\SharedKernel\UseCases\SpendChallengeTokensUseCase;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\TrainerConfigRepository;
use ConorSmith\Pokemon\ViewModelFactory;
use Doctrine\DBAL\Connection;
use FastRoute\RouteCollector;
use LogicException;

final class ControllerFactory
{
    public static function routes(RouteCollector $r): void
    {
        $r->get("/new-game", GetNewGame::class);
        $r->post("/new-game", PostNewGame::class);

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
        $r->get("/map/pokemon", GetObtainablePokemon::class);
        $r->get("/map/trainers", GetTrainers::class);
        $r->get("/map/elite-four", GetEliteFour::class);
        $r->get("/track-pokemon/{encounterType}", GetTrackPokemon::class);
        $r->get("/survey-pokemon/{encounterType}", GetSurveyPokemon::class);
        $r->post("/survey-pokemon/{encounterType}/start", PostSurveyPokemonStart::class);
        $r->post("/survey-pokemon/{encounterType}/finish", PostSurveyPokemonFinish::class);
        $r->post("/encounter", PostEncounterGenerateAndStart::class);
        $r->post("/encounter/generate", PostEncounterGenerate::class);
        $r->get("/party", GetParty::class);
        $r->get("/party/eggs", GetPartyEggs::class);
        $r->get("/party/day-care", GetPartyDayCare::class);
        $r->get("/party/box", GetPartyBox::class);
        $r->get("/party/compare", GetPartyCompare::class);
        $r->get("/party/combinations", GetPartyCombinations::class);
        $r->get("/party/member/{id}", GetPokemon::class);
        $r->get("/party/member/{id}/item-use", GetPokemonItemUse::class);
        $r->get("/party/member/{id}/item-give", GetPokemonItemGive::class);
        $r->post("/party/member/{id}/item-take", PostPokemonItemTake::class);
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
        $r->post("/party/give/{id}", PostPartyItemGive::class);
        $r->post("/obtain", PostObtain::class);
        $r->get("/status", GetStatus::class);
        $r->get("/notifications", GetNotifications::class);
        $r->get("/", GetIndex::class);
    }

    public function __construct(
        private readonly RepositoryFactory $repositoryFactory,
        private readonly Connection $db,
        private readonly EliteFourConfigRepository $eliteFourConfigRepository,
        private readonly FixedEncounterConfigRepository $fixedEncounterConfigRepository,
        private readonly GiftPokemonConfigRepository $giftPokemonConfigRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly TrainerConfigRepository $trainerConfigRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly WildEncounterConfigRepository $wildEncounterConfigRepository,
        private readonly ViewModelFactory $viewModelFactory,
    ) {}

    public function create(string $className, InstanceId $instanceId): mixed
    {
        return match ($className) {
            GetNewGame::class                    => new GetNewGame(
                $this->createTemplateEngine($instanceId),
            ),
            PostNewGame::class                   => new PostNewGame(
                new InstanceRepositoryDb($this->db),
            ),
            GetLogFoodDiary::class               => new GetLogFoodDiary(
                $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId),
                $this->createTemplateEngine($instanceId),
            ),
            PostLogFoodDiary::class              => new PostLogFoodDiary(
                $this->db,
                $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->createNotifyPlayerCommand($instanceId),
            ),
            GetLogWeeklyReview::class            => new GetLogWeeklyReview(
                $this->repositoryFactory->create(WeeklyHabitLogRepository::class, $instanceId),
                $this->createTemplateEngine($instanceId),
            ),
            PostLogWeeklyReview::class           => new PostLogWeeklyReview(
                $this->db,
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId),
                $this->repositoryFactory->create(WeeklyHabitLogRepository::class, $instanceId),
                new WeeklyUpdateForPartyCommand(
                    $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                    new LevelUpPokemon(
                        $this->repositoryFactory->create(GymBadgeRepository::class, $instanceId),
                        $this->repositoryFactory->create(\ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository::class, $instanceId),
                        $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                        $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                        $this->repositoryFactory->create(EvolutionRepository::class, $instanceId),
                        $this->repositoryFactory->create(FriendshipEventLogRepository::class, $instanceId),
                        new FoodDiaryHabitStreakQuery(
                            $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId)
                        ),
                        new AddNewPokemon(
                            $this->db,
                            $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                            new PokedexConfigRepository(),
                            new LocationConfigRepository(),
                            $instanceId,
                        ),
                        new PokedexConfigRepository(),
                    ),
                    new PokedexConfigRepository(),
                    $this->createNotifyPlayerCommand($instanceId),
                ),
                $this->createNotifyPlayerCommand($instanceId),
            ),
            GetLogStretches::class               => new GetLogStretches(
                $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId),
                $this->createTemplateEngine($instanceId),
            ),
            PostLogStretches::class              => new PostLogStretches(
                $this->db,
                $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->createNotifyPlayerCommand($instanceId),
            ),
            GetPokedex::class                    => new GetPokedex(
                $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                $this->repositoryFactory->create(RegionRepository::class, $instanceId),
                new PokedexConfigRepository(),
                $this->createTemplateEngine($instanceId),
            ),
            GetPokedexEntry::class               => new GetPokedexEntry(
                $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                $this->repositoryFactory->create(RegionRepository::class, $instanceId),
                new EvolutionaryLineRepositoryConfig(
                    new PokedexConfigRepository(),
                ),
                new WildEncounterConfigRepository(),
                new ItemConfigRepository(),
                new LocationConfigRepository(),
                new PokedexConfigRepository(),
                $this->createTemplateEngine($instanceId),
            ),
            GetLogCalorieGoal::class             => new GetLogCalorieGoal(
                $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId),
                $this->createTemplateEngine($instanceId),
            ),
            PostLogCalorieGoal::class            => new PostLogCalorieGoal(
                $this->db,
                $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->createNotifyPlayerCommand($instanceId),
            ),
            PostMapMove::class                   => new PostMapMove(
                $this->db,
                $this->locationConfigRepository,
                $this->createNotifyPlayerCommand($instanceId),
            ),
            GetLogExercise::class                => new GetLogExercise(
                $this->repositoryFactory->create(UnlimitedHabitLogRepository::class, $instanceId),
                $this->createTemplateEngine($instanceId),
            ),
            PostLogExercise::class               => new PostLogExercise(
                $this->db,
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(UnlimitedHabitLogRepository::class, $instanceId),
                new ReduceEggCyclesCommand(
                    $this->repositoryFactory->create(EggRepository::class, $instanceId),
                    $this->repositoryFactory->create(GenealogyRepository::class, $instanceId),
                    $this->repositoryFactory->create(\ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository::class, $instanceId),
                    $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                    $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                    new AddNewPokemon(
                        $this->db,
                        $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                        new PokedexConfigRepository(),
                        new LocationConfigRepository(),
                        $instanceId,
                    ),
                    new PokedexConfigRepository(),
                    new FoodDiaryHabitStreakQuery(
                        $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId)
                    ),
                    $this->createNotifyPlayerCommand($instanceId),
                    $this->repositoryFactory->create(FriendshipEventLogRepository::class, $instanceId),
                ),
                $this->createNotifyPlayerCommand($instanceId),
            ),
            PostEncounterGenerateAndStart::class => new PostEncounterGenerateAndStart(
                $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                new CreateAFixedEncounter(
                    $this->repositoryFactory->create(BagRepository::class, $instanceId),
                    $this->repositoryFactory->create(EncounterRepository::class, $instanceId),
                    $this->repositoryFactory->create(LocationRepository::class, $instanceId),
                ),
                new StartAnEncounter(
                    $this->repositoryFactory->create(EncounterRepository::class, $instanceId),
                ),
                $this->createNotifyPlayerCommand($instanceId),
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
                    $this->repositoryFactory->create(PokemonRepository::class, $instanceId)
                ),
                new ShowPartyCoverage(
                    $this->repositoryFactory->create(PokemonRepository::class, $instanceId)
                ),
                $this->createTemplateEngine($instanceId),
            ),
            GetPartyEggs::class                  => new GetPartyEggs(
                new ShowEggs(
                    $this->repositoryFactory->create(EggRepository::class, $instanceId),
                    $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                ),
                $this->createTemplateEngine($instanceId),
            ),
            GetPartyDayCare::class               => new GetPartyDayCare(
                new ShowDayCare(
                    $this->repositoryFactory->create(PokemonRepository::class, $instanceId)
                ),
                $this->createTemplateEngine($instanceId),
            ),
            GetPartyBox::class                   => new GetPartyBox(
                new ShowBox(
                    $this->repositoryFactory->create(PokemonRepository::class, $instanceId)
                ),
                $this->createTemplateEngine($instanceId),
            ),
            GetPartyCompare::class               => new GetPartyCompare(
                $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                $this->createTemplateEngine($instanceId),
            ),
            GetPartyCombinations::class          => new GetPartyCombinations(
                $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                new PokedexConfigRepository(),
                $this->createTemplateEngine($instanceId),
            ),
            GetPokemon::class                    => new GetPokemon(
                $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                $this->locationConfigRepository,
                $this->createTemplateEngine($instanceId),
            ),
            GetPokemonItemUse::class             => new GetPokemonItemUse(
                $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                new ItemConfigRepository(),
                $this->createTemplateEngine($instanceId),
            ),
            GetPokemonItemGive::class             => new GetPokemonItemGive(
                $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                new ItemConfigRepository(),
                $this->createTemplateEngine($instanceId),
            ),
            GetPokemonBreed::class               => new GetPokemonBreed(
                $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                $this->createTemplateEngine($instanceId),
                $this->createNotifyPlayerCommand($instanceId),
            ),
            PostPokemonBreed::class              => new PostPokemonBreed(
                new AddNewEgg(
                    $this->repositoryFactory->create(EggRepository::class, $instanceId),
                    new PokedexConfigRepository(),
                ),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                new PokedexConfigRepository(),
                $this->createNotifyPlayerCommand($instanceId),
            ),
            GetEncounter::class                  => new GetEncounter(
                $this->repositoryFactory->create(PlayerRepository::class, $instanceId),
                $this->repositoryFactory->create(EncounterRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->viewModelFactory,
                $this->createTemplateEngine($instanceId),
            ),
            PostEncounterCatch::class            => new PostEncounterCatch(
                $this->db,
                $this->repositoryFactory->create(EncounterRepository::class, $instanceId),
                $this->repositoryFactory->create(FixedEncounterCaptureEventRepository::class, $instanceId),
                $this->repositoryFactory->create(FriendshipEventLogRepository::class, $instanceId),
                $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                new FixedEncounterConfigRepository(),
                $this->locationConfigRepository,
                new AddNewPokemon(
                    $this->db,
                    $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                    new PokedexConfigRepository(),
                    new LocationConfigRepository(),
                    $instanceId,
                ),
                new EventFactory(
                    $this->viewModelFactory,
                    new PokedexConfigRepository(),
                ),
            ),
            PostEncounterRun::class              => new PostEncounterRun(
                $this->repositoryFactory->create(EncounterRepository::class, $instanceId),
                $this->repositoryFactory->create(PlayerRepository::class, $instanceId),
            ),
            PostEncounterFight::class            => new PostEncounterFight(
                $this->repositoryFactory->create(EncounterRepository::class, $instanceId),
                $this->repositoryFactory->create(FriendshipEventLogRepository::class, $instanceId),
                $this->repositoryFactory->create(PlayerRepository::class, $instanceId),
                new EventFactory(
                    $this->viewModelFactory,
                    new PokedexConfigRepository(),
                ),
                $this->createNotifyPlayerCommand($instanceId),
            ),
            PostPartyMoveUp::class               => new PostPartyMoveUp(
                $this->db,
                $this->repositoryFactory->create(CaughtPokemonRepository::class, $instanceId),
                $this->createNotifyPlayerCommand($instanceId),
            ),
            PostPartyMoveDown::class             => new PostPartyMoveDown(
                $this->db,
                $this->repositoryFactory->create(CaughtPokemonRepository::class, $instanceId),
                $this->createNotifyPlayerCommand($instanceId),
            ),
            PostPartySendToBox::class            => new PostPartySendToBox(
                $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                $this->repositoryFactory->create(FriendshipEventLogRepository::class, $instanceId),
                $this->createNotifyPlayerCommand($instanceId),
            ),
            PostPartySendToParty::class          => new PostPartySendToParty(
                $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                $this->repositoryFactory->create(FriendshipEventLogRepository::class, $instanceId),
                $this->createNotifyPlayerCommand($instanceId),
            ),
            PostPartySendToDayCare::class        => new PostPartySendToDayCare(
                $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                $this->repositoryFactory->create(FriendshipEventLogRepository::class, $instanceId),
                $this->createNotifyPlayerCommand($instanceId),
            ),
            PostBattleStart::class               => new PostBattleStart(
                $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                new StartABattle(
                    $this->repositoryFactory->create(BattleRepository::class, $instanceId),
                    $this->repositoryFactory->create(FriendshipEventLogRepository::class, $instanceId),
                    $this->repositoryFactory->create(PlayerRepository::class, $instanceId),
                    $this->repositoryFactory->create(TrainerRepository::class, $instanceId),
                ),
                new SpendChallengeTokensUseCase(
                    $this->repositoryFactory->create(BagRepository::class, $instanceId),
                ),
                $this->createNotifyPlayerCommand($instanceId),
            ),
            GetBattle::class                     => new GetBattle(
                $this->db,
                $this->trainerConfigRepository,
                $this->repositoryFactory->create(TrainerRepository::class, $instanceId),
                $this->repositoryFactory->create(PlayerRepository::class, $instanceId),
                $this->viewModelFactory,
                $this->createTemplateEngine($instanceId),
            ),
            GetHallOfFame::class                 => new GetHallOfFame(
                $this->repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId),
                new PokedexConfigRepository(),
                $this->createNotifyPlayerCommand($instanceId),
                $this->createTemplateEngine($instanceId),
            ),
            PostBattleFight::class               => new PostBattleFight(
                $this->db,
                $this->repositoryFactory->create(FriendshipEventLogRepository::class, $instanceId),
                new ItemConfigRepository(),
                $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                $this->repositoryFactory->create(TrainerRepository::class, $instanceId),
                $this->repositoryFactory->create(PlayerRepository::class, $instanceId),
                $this->repositoryFactory->create(AreaRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(BattleRepository::class, $instanceId),
                new EventFactory(
                    $this->viewModelFactory,
                    new PokedexConfigRepository(),
                ),
                $this->viewModelFactory,
                $this->createNotifyPlayerCommand($instanceId),
            ),
            GetSwitch::class                     => new GetSwitch(
                $this->repositoryFactory->create(PlayerRepository::class, $instanceId),
                $this->viewModelFactory,
                $this->createTemplateEngine($instanceId),
            ),
            PostSwitch::class                    => new PostSwitch(
                $this->repositoryFactory->create(PlayerRepository::class, $instanceId),
            ),
            PostBattleFinish::class              => new PostBattleFinish(
                $this->repositoryFactory->create(PlayerRepository::class, $instanceId),
                $this->repositoryFactory->create(TrainerRepository::class, $instanceId),
                $this->repositoryFactory->create(BattleRepository::class, $instanceId),
                $this->repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId),
                $this->repositoryFactory->create(LeagueChampionRepository::class, $instanceId),
                new StartABattle(
                    $this->repositoryFactory->create(BattleRepository::class, $instanceId),
                    $this->repositoryFactory->create(FriendshipEventLogRepository::class, $instanceId),
                    $this->repositoryFactory->create(PlayerRepository::class, $instanceId),
                    $this->repositoryFactory->create(TrainerRepository::class, $instanceId),
                ),
            ),
            GetBag::class                        => new GetBag(
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                new ItemConfigRepository(),
                $this->createTemplateEngine($instanceId),
            ),
            PostItemUse::class                   => new PostItemUse(
            ),
            GetPartyItemUse::class               => new GetPartyItemUse(
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                $this->createNotifyPlayerCommand($instanceId),
                $this->createTemplateEngine($instanceId),
            ),
            PostPartyItemUse::class              => new PostPartyItemUse(
                $this->db,
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                new LevelUpPokemon(
                    $this->repositoryFactory->create(GymBadgeRepository::class, $instanceId),
                    $this->repositoryFactory->create(\ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository::class, $instanceId),
                    $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                    $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                    $this->repositoryFactory->create(EvolutionRepository::class, $instanceId),
                    $this->repositoryFactory->create(FriendshipEventLogRepository::class, $instanceId),
                    new FoodDiaryHabitStreakQuery(
                        $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId)
                    ),
                    new AddNewPokemon(
                        $this->db,
                        $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                        new PokedexConfigRepository(),
                        new LocationConfigRepository(),
                        $instanceId,
                    ),
                    new PokedexConfigRepository(),
                ),
                new FixedEncounterConfigRepository(),
                new ItemConfigRepository(),
                $this->pokedexConfigRepository,
                $this->createNotifyPlayerCommand($instanceId),
            ),
            PostPartyItemGive::class             => new PostPartyItemGive(
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                new ItemConfigRepository(),
                $this->pokedexConfigRepository,
                $this->createNotifyPlayerCommand($instanceId),
            ),
            PostPokemonItemTake::class           => new PostPokemonItemTake(
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                new ItemConfigRepository(),
                $this->pokedexConfigRepository,
                $this->createNotifyPlayerCommand($instanceId),
            ),
            PostChallengeEliteFour::class        => new PostChallengeEliteFour(
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(PlayerRepository::class, $instanceId),
                $this->repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId),
                new StartABattle(
                    $this->repositoryFactory->create(BattleRepository::class, $instanceId),
                    $this->repositoryFactory->create(FriendshipEventLogRepository::class, $instanceId),
                    $this->repositoryFactory->create(PlayerRepository::class, $instanceId),
                    $this->repositoryFactory->create(TrainerRepository::class, $instanceId),
                ),
                $this->createNotifyPlayerCommand($instanceId),
            ),
            GetIndex::class                      => new GetIndex(
                $this->repositoryFactory->create(\ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository::class, $instanceId),
                $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->locationConfigRepository,
                $this->createTemplateEngine($instanceId),
            ),
            PostObtain::class                    => new PostObtain(
                new AddNewEgg(
                    $this->repositoryFactory->create(EggRepository::class, $instanceId),
                    new PokedexConfigRepository(),
                ),
                new AddNewPokemon(
                    $this->db,
                    $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                    new PokedexConfigRepository(),
                    new LocationConfigRepository(),
                    $instanceId,
                ),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(\ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository::class, $instanceId),
                $this->repositoryFactory->create(ObtainedGiftPokemonRepository::class, $instanceId),
                $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                new FoodDiaryHabitStreakQuery(
                    $this->repositoryFactory->create(DailyHabitLogRepository::class, $instanceId)
                ),
                new GiftPokemonConfigRepository(),
                new ItemConfigRepository(),
                new PokedexConfigRepository(),
                $this->createNotifyPlayerCommand($instanceId),
                $this->repositoryFactory->create(FriendshipEventLogRepository::class, $instanceId),
            ),
            GetStatus::class                     => new GetStatus(
                $this->repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId),
                $this->repositoryFactory->create(GymBadgeRepository::class, $instanceId),
                $this->repositoryFactory->create(LeagueChampionRepository::class, $instanceId),
                $this->viewModelFactory,
                $this->createTemplateEngine($instanceId),
            ),
            GetNotifications::class              => new GetNotifications(
                $this->repositoryFactory->create(NotificationRepository::class, $instanceId),
                $this->createTemplateEngine($instanceId),
            ),
            GetMap::class          => new GetMap(
                $this->repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId),
                $this->repositoryFactory->create(\ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository::class, $instanceId),
                $this->eliteFourConfigRepository,
                $this->createViewModelFactory(),
                $this->createFindFeatures($instanceId),
                $this->createFindTrainers($instanceId),
                $this->createFindWildEncounters(),
                $this->createTemplateEngine($instanceId),
            ),
            GetObtainablePokemon::class => new GetObtainablePokemon(
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(BattleRepository::class, $instanceId),
                $this->repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId),
                $this->repositoryFactory->create(GymBadgeRepository::class, $instanceId),
                $this->repositoryFactory->create(\ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository::class, $instanceId),
                $this->repositoryFactory->create(ObtainedGiftPokemonRepository::class, $instanceId),
                $this->repositoryFactory->create(SurveyRepository::class, $instanceId),
                $this->giftPokemonConfigRepository,
                new ItemConfigRepository(),
                $this->locationConfigRepository,
                $this->pokedexConfigRepository,
                $this->createFindFeatures($instanceId),
                $this->createFindWildEncounters(),
                $this->createFindFixedEncounters($instanceId),
                $this->createViewModelFactory(),
                $this->createTemplateEngine($instanceId),
            ),
            GetTrainers::class => new GetTrainers(
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(\ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository::class, $instanceId),
                $this->trainerConfigRepository,
                $this->createFindFeatures($instanceId),
                $this->createFindTrainers($instanceId),
                $this->createViewModelFactory(),
                $this->viewModelFactory,
                $this->createTemplateEngine($instanceId),
            ),
            GetEliteFour::class => new GetEliteFour(
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(GymBadgeRepository::class, $instanceId),
                $this->repositoryFactory->create(\ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository::class, $instanceId),
                $this->eliteFourConfigRepository,
                $this->createFindFeatures($instanceId),
                $this->createFindPokemonLeague($instanceId),
                $this->createViewModelFactory(),
                $this->createNotifyPlayerCommand($instanceId),
                $this->createTemplateEngine($instanceId),
            ),
            GetTrackPokemon::class => new GetTrackPokemon(
                $this->repositoryFactory->create(\ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository::class, $instanceId),
                $this->repositoryFactory->create(PokemonRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->createViewModelFactory(),
                $this->createNotifyPlayerCommand($instanceId),
                $this->createTemplateEngine($instanceId),
            ),
            GetSurveyPokemon::class => new GetSurveyPokemon(
                $this->repositoryFactory->create(\ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository::class, $instanceId),
                new ShowActiveSurvey(
                    $this->repositoryFactory->create(SurveyRepository::class, $instanceId),
                ),
                new ShowSurveyRecord(
                    $this->pokedexConfigRepository,
                    $this->wildEncounterConfigRepository,
                    $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                    $this->repositoryFactory->create(SurveyRepository::class, $instanceId),
                ),
                $this->createViewModelFactory(),
                $this->createTemplateEngine($instanceId),
                new NotifyPlayerCommand(
                    $this->repositoryFactory->create(NotificationRepository::class, $instanceId),
                ),
            ),
            PostSurveyPokemonStart::class => new PostSurveyPokemonStart(
                new StartSurveyingPokemon(
                    $this->repositoryFactory->create(\ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository::class, $instanceId),
                    $this->repositoryFactory->create(SurveyRepository::class, $instanceId),
                    $this->createFindWildEncounters(),
                ),
                new NotifyPlayerCommand(
                    $this->repositoryFactory->create(NotificationRepository::class, $instanceId),
                ),
            ),
            PostSurveyPokemonFinish::class => new PostSurveyPokemonFinish(
                new FinishSurveyingPokemon(
                    $this->wildEncounterConfigRepository,
                    $this->repositoryFactory->create(SurveyRepository::class, $instanceId),
                ),
                new NotifyPlayerCommand(
                    $this->repositoryFactory->create(NotificationRepository::class, $instanceId),
                ),
            ),
            default => throw new LogicException("Failed to find controller '{$className}'"),
        };
    }

    private function createTemplateEngine(InstanceId $instanceId): TemplateEngine
    {
        return new TemplateEngine(
            $this->repositoryFactory->create(NotificationRepository::class, $instanceId),
            $instanceId,
        );
    }

    private function createNotifyPlayerCommand(InstanceId $instanceId): NotifyPlayerCommandInterface
    {
        return new NotifyPlayerCommand(
            $this->repositoryFactory->create(NotificationRepository::class, $instanceId),
        );
    }

    private function createViewModelFactory(): \ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\ViewModels\ViewModelFactory
    {
        return new \ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\ViewModels\ViewModelFactory(
            $this->locationConfigRepository,
        );
    }

    private function createFindWildEncounters(): FindWildEncounters
    {
        return new FindWildEncounters(
            $this->wildEncounterConfigRepository
        );
    }

    private function createFindFixedEncounters(InstanceId $instanceId): FindFixedEncounters
    {
        return new FindFixedEncounters(
            $this->repositoryFactory->create(BagRepository::class, $instanceId),
            $this->repositoryFactory->create(FixedEncounterCaptureEventRepository::class, $instanceId),
            $this->repositoryFactory->create(GymBadgeRepository::class, $instanceId),
            $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
            $this->fixedEncounterConfigRepository,
            $this->pokedexConfigRepository,
            $this->locationConfigRepository,
        );
    }

    private function createFindTrainers(InstanceId $instanceId): FindTrainers
    {
        return new FindTrainers(
            $this->repositoryFactory->create(BagRepository::class, $instanceId),
            $this->repositoryFactory->create(BattleRepository::class, $instanceId),
            $this->repositoryFactory->create(LeagueChampionRepository::class, $instanceId),
            $this->repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId),
            $this->trainerConfigRepository,
        );
    }

    private function createFindPokemonLeague(InstanceId $instanceId): FindPokemonLeague
    {
        return new FindPokemonLeague(
            $this->repositoryFactory->create(LeagueChampionRepository::class, $instanceId),
            $this->eliteFourConfigRepository,
        );
    }

    private function createFindFeatures(InstanceId $instanceId): FindFeatures
    {
        return new FindFeatures(
            $this->wildEncounterConfigRepository,
            $this->giftPokemonConfigRepository,
            $this->createFindFixedEncounters($instanceId),
            $this->createFindPokemonLeague($instanceId),
            $this->createFindTrainers($instanceId),
        );
    }
}
