<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Domain\Attack;
use ConorSmith\Pokemon\Battle\Domain\Round;
use ConorSmith\Pokemon\Battle\Domain\Trainer;
use ConorSmith\Pokemon\Battle\EventFactory;
use ConorSmith\Pokemon\Battle\Repositories\AreaRepository;
use ConorSmith\Pokemon\ItemConfigRepository;
use ConorSmith\Pokemon\ItemType;
use ConorSmith\Pokemon\SharedKernel\ReportTeamPokemonFaintedCommand;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\TrainerClass;
use ConorSmith\Pokemon\ViewModelFactory;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostBattleFight
{
    public function __construct(
        private readonly Connection                      $db,
        private readonly Session                         $session,
        private readonly ItemConfigRepository            $itemConfigRepository,
        private readonly TrainerRepository               $trainerRepository,
        private readonly PlayerRepository                $playerRepository,
        private readonly AreaRepository                  $areaRepository,
        private readonly BagRepository                   $bagRepository,
        private readonly ReportTeamPokemonFaintedCommand $reportTeamPokemonFaintedCommand,
        private readonly EventFactory                    $eventFactory,
        private readonly ViewModelFactory                $viewModelFactory,
    ) {}

    public function __invoke(array $args): void
    {
        $trainerBattleId = $args['id'];
        $playerAttackInput = $_POST['attack'];

        $player = $this->playerRepository->findPlayer();
        $trainer = $this->trainerRepository->findTrainer($trainerBattleId);
        $bag = $this->bagRepository->find();

        if ($player->hasEntireTeamFainted()) {
            $this->session->getFlashBag()->add("errors", "Your team has fainted.");
            header("Location: /battle/{$trainer->id}");
        }

        $playerPokemon = $player->getLeadPokemon();
        $opponentPokemon = $trainer->getLeadPokemon();

        $playerAttack = new Attack(
            explode("-", $playerAttackInput)[0],
            explode("-", $playerAttackInput)[1],
        );

        $round = Round::execute($playerPokemon, $opponentPokemon, $playerAttack);

        if ($playerPokemon->hasFainted) {
            $this->reportTeamPokemonFaintedCommand->run(
                $playerPokemon->id,
                $playerPokemon->level,
                $opponentPokemon->level,
            );
        }

        $playerEarnedGymBadge = false;
        $prize = null;

        if ($trainer->hasEntireTeamFainted()) {
            $trainerWasPreviouslyBeaten = $trainer->dateLastBeaten !== null;

            $prizeItemId = self::generatePrize($this->getPrizePool($trainer));
            $prize = self::findItem($prizeItemId);
            $bag = $bag->add($prizeItemId);
            $trainer = $trainer->defeat();

            if ($trainer->isGymLeader() && !$player->hasGymBadge($trainer->gymBadge)) {
                $player = $player->earn($trainer->gymBadge);
                $playerEarnedGymBadge = true;
            }

            $areaJustCleared = false;

            if (!$trainerWasPreviouslyBeaten && !$trainer->isGymLeader()) {

                $area = $this->areaRepository->find($trainer->locationId);

                $areaJustCleared = $area->isOnlyUnbeatenTrainer($trainer);

                $areaClearedPrizes = [];

                if ($areaJustCleared) {
                    foreach ($area->trainers as $areaTrainer) {
                        $prizeItemId = self::generatePrize($this->getPrizePool($areaTrainer));
                        $areaClearedPrizes[] = self::findItem($prizeItemId);
                        $bag = $bag->add($prizeItemId);
                    }

                    foreach ($area->getClearancePrizes() as $prizeItemId) {
                        $areaClearedPrizes[] = self::findItem($prizeItemId);
                        $bag = $bag->add($prizeItemId);
                    }
                }
            }
        }

        $this->db->beginTransaction();

        $this->trainerRepository->saveTrainer($trainer);
        $this->playerRepository->savePlayer($player);
        $this->bagRepository->save($bag);

        $this->db->commit();

        $nextFirstPokemon = $round->playerFirst
            ? ($player->hasEntireTeamFainted() ? null : $player->getLeadPokemon())
            : ($trainer->hasEntireTeamFainted() ? null : $trainer->getLeadPokemon());
        $nextSecondPokemon = $round->playerFirst
            ? ($trainer->hasEntireTeamFainted() ? null : $trainer->getLeadPokemon())
            : ($player->hasEntireTeamFainted() ? null : $player->getLeadPokemon());

        $events = array_merge(
            $this->eventFactory->createBattleRoundEvents(
                $round->firstAttack,
                $round->firstPokemon,
                $round->secondPokemon,
                !$round->playerFirst,
                $nextSecondPokemon,
                TrainerClass::getLabel($trainer->class) . " " . $trainer->name,
            ),
            $this->eventFactory->createBattleRoundEvents(
                $round->secondAttack,
                $round->secondPokemon,
                $round->firstPokemon,
                $round->playerFirst,
                $nextFirstPokemon,
                TrainerClass::getLabel($trainer->class) . " " . $trainer->name,
            ),
        );

        if ($trainer->hasEntireTeamFainted()) {
            $name = TrainerClass::getLabel($trainer->class) . " " . $trainer->name;
            $events[] = $this->eventFactory->createMessageEvent("You defeated {$name}");

            if ($playerEarnedGymBadge) {
                $events[] = $this->eventFactory->createMessageEvent("You earned the {$this->viewModelFactory->createGymBadgeName($trainer->gymBadge)}");
            }
            $events[] = $this->eventFactory->createMessageEvent("You won a {$prize['name']}");

            if ($areaJustCleared) {
                $events[] = $this->eventFactory->createMessageEvent("You cleared the area!");
                foreach ($areaClearedPrizes as $areaClearedPrize) {
                    $events[] = $this->eventFactory->createMessageEvent("You won a {$areaClearedPrize['name']}");
                }
            }

        } elseif ($player->hasEntireTeamFainted()) {
            $name = TrainerClass::getLabel($trainer->class) . " " . $trainer->name;
            $events[] = $this->eventFactory->createMessageEvent("You were defeated by {$name}");
        }

        echo json_encode($events);
    }

    private function getPrizePool(Trainer $trainer): array
    {
        if ($trainer->class === TrainerClass::ELITE_FOUR
            || $trainer->class === TrainerClass::CHAMPION
        ) {
            return [
                ItemId::ULTRA_BALL => 1,
                ItemId::CHALLENGE_TOKEN => 1,
                ItemId::FIRE_STONE => 1,
                ItemId::WATER_STONE => 1,
                ItemId::THUNDER_STONE => 1,
                ItemId::LEAF_STONE => 1,
                ItemId::MOON_STONE => 1,
                ItemId::SUN_STONE => 1,
                ItemId::ICE_STONE => 1,
                ItemId::DUSK_STONE => 1,
                ItemId::SHINY_STONE => 1,
                ItemId::DAWN_STONE => 1,
            ];
        }

        if (TrainerClass::hasUltraBallInPrizePool($trainer->class)) {
            $pool = [
                ItemId::POKE_BALL => 1,
                ItemId::GREAT_BALL => 2,
                ItemId::ULTRA_BALL => 1,
                ItemId::RARE_CANDY => 2,
                ItemId::CHALLENGE_TOKEN => 2,
            ];
        } else {
            $pool = [
                ItemId::POKE_BALL => 3,
                ItemId::GREAT_BALL => 1,
                ItemId::RARE_CANDY => 2,
                ItemId::CHALLENGE_TOKEN => 2,
            ];
        }

        $additionalPrizes = TrainerClass::getAdditionalPrizePoolItems($trainer->class);

        if (count($additionalPrizes) === 1) {
            $pool[$additionalPrizes[0]] = 2;
        } else {
            foreach ($additionalPrizes as $prize) {
                $pool[$prize] = 1;
            }
        }

        $pool = array_map(
            fn(int $weight) => $weight * 20,
            $pool,
        );

        $evolutionItems = $this->itemConfigRepository->findByType(ItemType::EVOLUTION);

        foreach ($evolutionItems as $itemId => $itemConfig) {
            if (!array_key_exists($itemId, $pool)) {
                $pool[$itemId] = 1;
            }
        }

        return $pool;
    }

    private static function generatePrize(array $pool): string
    {
        $selectedValue = mt_rand(1, array_reduce($pool, function ($carry, int $weight) {
            return $carry + $weight;
        }, 0));

        foreach ($pool as $itemId => $weight) {
            $selectedValue -= $weight;
            if ($selectedValue <= 0) {
                return strval($itemId);
            }
        }

        throw new \Exception;
    }

    private static function findItem(string $id): array
    {
        $itemConfig = require __DIR__ . "/../../Config/Items.php";

        return $itemConfig[$id];
    }
}
