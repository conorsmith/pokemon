<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Domain\AttackOutcome;
use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Round;
use ConorSmith\Pokemon\Battle\Domain\Trainer;
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
        private readonly Connection        $db,
        private readonly Session           $session,
        private readonly TrainerRepository $trainerRepository,
        private readonly PlayerRepository  $playerRepository,
        private readonly BagRepository     $bagRepository,
        private readonly ReportTeamPokemonFaintedCommand $reportTeamPokemonFaintedCommand,
        private readonly ViewModelFactory  $viewModelFactory,
    ) {}

    public function __invoke(array $args): void
    {
        $trainerBattleId = $args['id'];
        $playerAttackType = $_POST['attack'];

        $player = $this->playerRepository->findPlayer();
        $trainer = $this->trainerRepository->findTrainer($trainerBattleId);
        $bag = $this->bagRepository->find();

        if ($player->hasEntireTeamFainted()) {
            $this->session->getFlashBag()->add("errors", "Your team has fainted.");
            header("Location: /battle/{$trainer->id}");
        }

        $playerPokemon = $player->getLeadPokemon();
        $opponentPokemon = $trainer->getLeadPokemon();

        $round = Round::execute($playerPokemon, $opponentPokemon, $playerAttackType);

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
            $prizeItemId = self::generatePrize(self::getPrizePool($trainer));
            $prize = self::findItem($prizeItemId);
            $bag = $bag->add($prizeItemId);
            $trainer = $trainer->defeat();

            if ($trainer->isGymLeader() && !$player->hasGymBadge($trainer->gymBadge)) {
                $player = $player->earn($trainer->gymBadge);
                $playerEarnedGymBadge = true;
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

        $this->sendEvents(
            $round->firstAttack,
            $round->firstPokemon,
            $round->secondPokemon,
            !$round->playerFirst,
            $nextSecondPokemon,
            TrainerClass::getLabel($trainer->class) . " " . $trainer->name,
        );

        $this->sendEvents(
            $round->secondAttack,
            $round->secondPokemon,
            $round->firstPokemon,
            $round->playerFirst,
            $nextFirstPokemon,
            TrainerClass::getLabel($trainer->class) . " " . $trainer->name,
        );

        if ($trainer->hasEntireTeamFainted()) {
            $name = TrainerClass::getLabel($trainer->class) . " " . $trainer->name;
            $this->setMessage("You defeated {$name}");

            if ($playerEarnedGymBadge) {
                $this->setMessage("You earned the {$this->viewModelFactory->createGymBadgeName($trainer->gymBadge)}");
            }
            $this->setMessage("You won a {$prize['name']}");

        } elseif ($player->hasEntireTeamFainted()) {
            $name = TrainerClass::getLabel($trainer->class) . " " . $trainer->name;
            $this->setMessage("You were defeated by {$name}");
        }

        echo json_encode($this->events);
    }

    private function sendEvents(
        AttackOutcome $attack,
        Pokemon $attacker,
        Pokemon $defender,
        bool $isPlayerDefending,
        ?Pokemon $nextDefender,
        string $opponentName
    ) {
        $attackerVm = $this->viewModelFactory->createPokemonInBattle($attacker);
        $attackerDescriptor = $isPlayerDefending ? "Foe" : "Your";

        $defenderVm = $this->viewModelFactory->createPokemonInBattle($defender);
        $defenderDescriptor = $isPlayerDefending ? "Your" : "Foe";

        if ($attack->hit) {

            $this->setMessage("{$attackerDescriptor} {$attackerVm->name}'s attack hit!");

            if ($attack->superEffective) {
                $this->setMessage("It's super effective!");
            } elseif ($attack->notVeryEffective) {
                $this->setMessage("It's not very effective");
            }
            if ($attack->criticalHit) {
                $this->setMessage("It's a critical hit!");
            }

            $this->publishDamageEvent(
                $defender->id,
                $attack->damageDealt,
                $defender->remainingHp,
                $defender->calculateHp()
            );

            $this->setMessage("{$defenderDescriptor} {$defenderVm->name} took {$attack->damageDealt} damage");

            if ($attack->enduredHit) {
                $this->setMessage("{$defenderDescriptor} {$defenderVm->name} endured through the power of friendship!");

            } elseif ($defender->hasFainted) {
                $this->setMessage("{$defenderDescriptor} {$defenderVm->name} fainted");

                $this->publishFaintingEvent($defender->id, $isPlayerDefending, $nextDefender);

                if ($nextDefender) {
                    $nextDefenderVm = $this->viewModelFactory->createPokemonInBattle($nextDefender);
                    if ($isPlayerDefending) {
                        $this->setMessage("Go {$nextDefenderVm->name}!");
                    } else {
                        $this->setMessage("{$opponentName} sent out {$nextDefenderVm->name}");
                    }
                }
            }
        } elseif (!$attacker->hasFainted) {
            $this->setMessage("{$attackerDescriptor} {$attackerVm->name}'s attack missed!");
        }
    }

    private array $events;

    private function setMessage(string $message): void
    {
        $this->events[] = [
            'type' => "message",
            'value' => $message,
        ];
    }

    private function publishDamageEvent(string $id, int $damage, int $remaining, int $total): void
    {
        $this->events[] = [
            'type' => "damage",
            'target' => $id,
            'value' => [
                'damage' => $damage,
                'remaining' => $remaining,
                'total' => $total,
            ],
        ];
    }

    private function publishFaintingEvent(string $id, bool $isPlayerPokemon, ?Pokemon $nextPokemon): void
    {
        $this->events[] = [
            'type' => "fainting",
            'target' => $id,
            'isPlayerPokemon' => $isPlayerPokemon,
            'next' => $nextPokemon ? $this->viewModelFactory->createPokemonInBattle($nextPokemon) : null,
        ];
    }

    private static function getPrizePool(Trainer $trainer): array
    {
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
