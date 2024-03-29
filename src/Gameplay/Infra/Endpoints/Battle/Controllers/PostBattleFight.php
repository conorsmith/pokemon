<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers;

use ConorSmith\Pokemon\Gameplay\Domain\Battle\AreaRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\Attack;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\BattleRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\PlayerRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\Pokemon;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\Round;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\Trainer;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\TrainerRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\FriendshipEventLogRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\ViewModels\EventFactory;
use ConorSmith\Pokemon\ItemConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemType;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\SharedKernel\TrainerClass;
use ConorSmith\Pokemon\ViewModelFactory;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostBattleFight
{
    public function __construct(
        private readonly Connection $db,
        private readonly FriendshipEventLogRepository $friendshipEventLogRepository,
        private readonly ItemConfigRepository $itemConfigRepository,
        private readonly PokemonRepository $pokemonRepository,
        private readonly TrainerRepository $trainerRepository,
        private readonly PlayerRepository $playerRepository,
        private readonly AreaRepository $areaRepository,
        private readonly BagRepository $bagRepository,
        private readonly BattleRepository $battleRepository,
        private readonly EventFactory $eventFactory,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $trainerBattleId = $args['id'];
        $playerAttackInput = $request->request->get('attack');

        $player = $this->playerRepository->findPlayer();
        $battle = $this->battleRepository->find($trainerBattleId);
        $trainer = $this->trainerRepository->findTrainer($trainerBattleId);
        $bag = $this->bagRepository->find();

        if ($player->hasEntirePartyFainted()) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Your party has fainted.")
            );
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
            if ($opponentPokemon->level - $playerPokemon->level >= 30) {
                $this->friendshipEventLogRepository->faintedToPowerfulOpponent($playerPokemon->id);
            } else {
                $this->friendshipEventLogRepository->fainted($playerPokemon->id);
            }
        }

        if ($opponentPokemon->hasFainted) {
            $this->boostPokemonEvs($playerPokemon, $opponentPokemon);
        }

        $playerEarnedGymBadge = false;
        $prize = null;

        $areaJustCleared = false;
        $areaClearedPrizes = [];

        if ($trainer->hasEntirePartyFainted()) {
            $trainerWasPreviouslyBeaten = $battle->dateLastBeaten !== null;

            if ($battle->isPlayerChallenger) {
                $prizeItemId = self::generatePrize($this->getPrizePool($trainer));
                $prize = self::findItem($prizeItemId);
                $bag = $bag->add($prizeItemId);
            }

            $battle = $battle->defeat();

            if ($trainer->isGymLeader() && !$player->hasGymBadge($trainer->gymBadge)) {
                $player = $player->earn($trainer->gymBadge);
                $playerEarnedGymBadge = true;
            }

            if (!$trainerWasPreviouslyBeaten
                && !$trainer->isGymLeader()
                && $battle->isPlayerChallenger
            ) {

                $area = $this->areaRepository->find($trainer->locationId);

                $areaJustCleared = $area->isOnlyUnbeatenTrainer($battle->trainerId);

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
            ? ($player->hasEntirePartyFainted() ? null : $player->getLeadPokemon())
            : ($trainer->hasEntirePartyFainted() ? null : $trainer->getLeadPokemon());
        $nextSecondPokemon = $round->playerFirst
            ? ($trainer->hasEntirePartyFainted() ? null : $trainer->getLeadPokemon())
            : ($player->hasEntirePartyFainted() ? null : $player->getLeadPokemon());

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

        if ($trainer->hasEntirePartyFainted()) {
            $name = TrainerClass::getLabel($trainer->class) . " " . $trainer->name;
            $events[] = $this->eventFactory->createMessageEvent("You defeated {$name}");

            if ($playerEarnedGymBadge) {
                $events[] = $this->eventFactory->createMessageEvent("You earned the {$this->viewModelFactory->createGymBadgeName($trainer->gymBadge)}");
            }
            if (!is_null($prize)) {
                $events[] = $this->eventFactory->createMessageEvent("You won a {$prize['name']}");
            }

            if ($areaJustCleared) {
                $events[] = $this->eventFactory->createMessageEvent("You cleared the area!");
                foreach ($areaClearedPrizes as $areaClearedPrize) {
                    $events[] = $this->eventFactory->createMessageEvent("You won a {$areaClearedPrize['name']}");
                }
            }

        } elseif ($player->hasEntirePartyFainted()) {
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
                ItemId::ULTRA_BALL      => 1,
                ItemId::CHALLENGE_TOKEN => 1,
                ItemId::FIRE_STONE      => 1,
                ItemId::WATER_STONE     => 1,
                ItemId::THUNDER_STONE   => 1,
                ItemId::LEAF_STONE      => 1,
                ItemId::MOON_STONE      => 1,
                ItemId::SUN_STONE       => 1,
                ItemId::ICE_STONE       => 1,
                ItemId::DUSK_STONE      => 1,
                ItemId::SHINY_STONE     => 1,
                ItemId::DAWN_STONE      => 1,
            ];
        }

        if (TrainerClass::hasUltraBallInPrizePool($trainer->class)) {
            $pool = [
                ItemId::POKE_BALL       => 1,
                ItemId::GREAT_BALL      => 2,
                ItemId::ULTRA_BALL      => 1,
                ItemId::RARE_CANDY      => 2,
                ItemId::CHALLENGE_TOKEN => 2,
            ];
        } else {
            $pool = [
                ItemId::POKE_BALL       => 3,
                ItemId::GREAT_BALL      => 1,
                ItemId::RARE_CANDY      => 2,
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
        $itemConfig = require __DIR__ . "/../../../../../Config/Items.php";

        return $itemConfig[$id];
    }

    private function boostPokemonEvs(Pokemon $playerPokemon, Pokemon $opponentPokemon): void
    {
        $evYieldsConfig = self::findEvYield($opponentPokemon->number, $opponentPokemon->form);

        $pokemon = $this->pokemonRepository->find($playerPokemon->id);

        $pokemon = $pokemon->boostHpEv($evYieldsConfig['hp']);
        $pokemon = $pokemon->boostPhysicalAttackEv($evYieldsConfig['physicalAttack']);
        $pokemon = $pokemon->boostPhysicalDefenceEv($evYieldsConfig['physicalDefence']);
        $pokemon = $pokemon->boostSpecialAttackEv($evYieldsConfig['specialAttack']);
        $pokemon = $pokemon->boostSpecialDefenceEv($evYieldsConfig['specialDefence']);
        $pokemon = $pokemon->boostSpeedEv($evYieldsConfig['speed']);

        $this->pokemonRepository->save($pokemon);
    }

    private static function findEvYield(string $pokedexNumber, ?string $form): array
    {
        $evYieldsConfig = require __DIR__ . "/../../../../../Config/EvYields.php";

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

        $config = [
            'pokedexNumber'   => $pokedexNumber,
            'hp'              => 0,
            'physicalAttack'  => 0,
            'physicalDefence' => 0,
            'specialAttack'   => 0,
            'specialDefence'  => 0,
            'speed'           => 0,
        ];

        if (!is_null($form)) {
            $config['form'] = $form;
        }

        return $config;
    }
}
