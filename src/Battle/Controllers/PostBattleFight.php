<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Domain\Attack;
use ConorSmith\Pokemon\Battle\Domain\BattleRepository;
use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Round;
use ConorSmith\Pokemon\Battle\Domain\Trainer;
use ConorSmith\Pokemon\Battle\EventFactory;
use ConorSmith\Pokemon\Battle\Repositories\AreaRepository;
use ConorSmith\Pokemon\ItemConfigRepository;
use ConorSmith\Pokemon\ItemType;
use ConorSmith\Pokemon\SharedKernel\BoostPokemonEvsCommand;
use ConorSmith\Pokemon\SharedKernel\ReportTeamPokemonFaintedCommand;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepositoryDb;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\TrainerClass;
use ConorSmith\Pokemon\ViewModelFactory;
use Doctrine\DBAL\Connection;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostBattleFight
{
    public function __construct(
        private readonly Connection                      $db,
        private readonly Session                         $session,
        private readonly ItemConfigRepository            $itemConfigRepository,
        private readonly TrainerRepository               $trainerRepository,
        private readonly PlayerRepositoryDb                $playerRepository,
        private readonly AreaRepository                  $areaRepository,
        private readonly BagRepository                   $bagRepository,
        private readonly BattleRepository                $battleRepository,
        private readonly ReportTeamPokemonFaintedCommand $reportTeamPokemonFaintedCommand,
        private readonly BoostPokemonEvsCommand          $boostPokemonEvsCommand,
        private readonly EventFactory                    $eventFactory,
        private readonly ViewModelFactory                $viewModelFactory,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $trainerBattleId = $args['id'];
        $playerAttackInput = $request->request->get('attack');

        $player = $this->playerRepository->findPlayer();
        $battle = $this->battleRepository->find($trainerBattleId);
        $trainer = $this->trainerRepository->findTrainer($trainerBattleId);
        $bag = $this->bagRepository->find();

        if ($player->hasEntireTeamFainted()) {
            $this->session->getFlashBag()->add("errors", "Your team has fainted.");
            return new RedirectResponse("/{$args['instanceId']}/battle/{$battle->id}");
        }

        $playerPokemon = $player->getLeadPokemon();
        $opponentPokemon = $trainer->getLeadPokemon();

        $playerAttack = new Attack(
            explode("-", $playerAttackInput)[0],
            explode("-", $playerAttackInput)[1],
        );

        $round = Round::execute(
            $playerPokemon,
            $opponentPokemon,
            $playerAttack,
            Attack::strongest($opponentPokemon),
        );

        if ($playerPokemon->hasFainted) {
            $this->reportTeamPokemonFaintedCommand->run(
                $playerPokemon->id,
                $playerPokemon->level,
                $opponentPokemon->level,
            );
        }

        if ($opponentPokemon->hasFainted) {
            $this->boostPokemonEvs($playerPokemon, $opponentPokemon);
        }

        $playerEarnedGymBadge = false;
        $prize = null;

        if ($trainer->hasEntireTeamFainted()) {
            $trainerWasPreviouslyBeaten = $battle->dateLastBeaten !== null;

            $prizeItemId = self::generatePrize($this->getPrizePool($trainer));
            $prize = self::findItem($prizeItemId);
            $bag = $bag->add($prizeItemId);
            $battle = $battle->defeat();

            if ($trainer->isGymLeader() && !$player->hasGymBadge($trainer->gymBadge)) {
                $player = $player->earn($trainer->gymBadge);
                $playerEarnedGymBadge = true;
            }

            $areaJustCleared = false;

            if (!$trainerWasPreviouslyBeaten && !$trainer->isGymLeader()) {

                $area = $this->areaRepository->find($trainer->locationId);

                $areaJustCleared = $area->isOnlyUnbeatenTrainer($battle->trainerId);

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
        $this->battleRepository->save($battle);
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
                !$round->playerFirst ? "Foe" : "Your",
                !$round->playerFirst ? "Your" : "Foe",
                !$round->playerFirst ? "You" : TrainerClass::getLabel($trainer->class) . " " . $trainer->name,
            ),
            $this->eventFactory->createBattleRoundEvents(
                $round->secondAttack,
                $round->secondPokemon,
                $round->firstPokemon,
                $round->playerFirst,
                $nextFirstPokemon,
                $round->playerFirst ? "Foe" : "Your",
                $round->playerFirst ? "Your" : "Foe",
                $round->playerFirst ? "You" : TrainerClass::getLabel($trainer->class) . " " . $trainer->name,
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

        return new JsonResponse($events);
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
            fn(int $weight) => $weight * 30,
            $pool,
        );

        $evolutionItems = $this->itemConfigRepository->findByType(ItemType::EVOLUTION);

        foreach ($evolutionItems as $itemId => $itemConfig) {
            if (!array_key_exists($itemId, $pool)) {
                $pool[$itemId] = $itemConfig['targets'] ?? 1;
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

    private function boostPokemonEvs(Pokemon $playerPokemon, Pokemon $opponentPokemon): void
    {
        $evYieldsConfig = self::findEvYield($opponentPokemon->number, $opponentPokemon->form);

        $this->boostPokemonEvsCommand->run(
            $playerPokemon->id,
            $evYieldsConfig['hp'],
            $evYieldsConfig['physicalAttack'],
            $evYieldsConfig['physicalDefence'],
            $evYieldsConfig['specialAttack'],
            $evYieldsConfig['specialDefence'],
            $evYieldsConfig['speed'],
        );
    }

    private static function findEvYield(string $pokedexNumber, ?string $form): array
    {
        $evYieldsConfig = require __DIR__ . "/../../Config/EvYields.php";

        foreach ($evYieldsConfig as $config) {
            if ($config['pokedexNumber'] !== $pokedexNumber) {
                continue;
            }

            if (is_null($form)) {
                if (!array_key_exists('form', $config)) {
                    return $config;
                }
            } else {
                if (array_key_exists('form', $config)
                    && $form === $config['form']
                ) {
                    return $config;
                }
            }
        }

        throw new Exception("Could not find EV yield for given Pokemon");
    }
}
