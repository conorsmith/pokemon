<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Trainer;
use ConorSmith\Pokemon\SharedKernel\ReportTeamPokemonFaintedCommand;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\PokemonType;
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

        $player = $this->playerRepository->findPlayer();
        $trainer = $this->trainerRepository->findTrainer($trainerBattleId);
        $bag = $this->bagRepository->find();

        if ($player->hasEntireTeamFainted()) {
            $this->session->getFlashBag()->add("errors", "Your team has fainted.");
            header("Location: /battle/{$trainer->id}");
        }

        $playerPokemon = $player->getLeadPokemon();
        $opponentPokemon = $trainer->getLeadPokemon();

        $playerAttackSucceeded = $this->calculateAttackOutcome(
            $playerPokemon,
            $opponentPokemon,
        );

        $playerEarnedGymBadge = false;
        $prize = null;
        $playerPokemonSurvivedHit = false;

        if ($playerAttackSucceeded) {
            $opponentPokemon->faint();
        } else {

            $opponentAttackSucceeded = $this->calculateAttackOutcome(
                $opponentPokemon,
                $playerPokemon,
            );

            if ($opponentAttackSucceeded) {
                $playerPokemonSurvivedHit = self::calculateHitSurvival($playerPokemon);
                if (!$playerPokemonSurvivedHit) {
                    $playerPokemon->faint();
                    $this->reportTeamPokemonFaintedCommand->run(
                        $playerPokemon->id,
                        $playerPokemon->level,
                        $opponentPokemon->level,
                    );
                }
            }
        }

        if ($trainer->hasEntireTeamFainted()) {
            $prizeItemId = self::generatePrize(self::getPrizePool($trainer));
            $prize = self::findItem($prizeItemId);
            $bag = $bag->add($prizeItemId);
            $trainer = $trainer->defeat();
            $trainer = $trainer->endBattle();
            $player = $player->reviveTeam();

            if ($trainer->isGymLeader() && !$player->hasGymBadge($trainer->gymBadge)) {
                $player = $player->earn($trainer->gymBadge);
                $playerEarnedGymBadge = true;
            }
        } elseif ($player->hasEntireTeamFainted()) {
            $trainer = $trainer->endBattle();
            $player = $player->reviveTeam();
        }

        $this->db->beginTransaction();

        $this->trainerRepository->saveTrainer($trainer);
        $this->playerRepository->savePlayer($player);
        $this->bagRepository->save($bag);

        $this->db->commit();

        $playerPokemonVm = $this->viewModelFactory->createPokemonInBattle($playerPokemon);
        $trainerPokemonVm = $this->viewModelFactory->createPokemonInBattle($opponentPokemon);

        if ($playerAttackSucceeded) {
            $this->session->getFlashBag()->add("successes", "Your {$playerPokemonVm->name}'s attack hit!");
            $this->addEffectivenessMessage($playerPokemon, $opponentPokemon);
            $this->session->getFlashBag()->add("successes", "Foe {$trainerPokemonVm->name} fainted");

            if ($trainer->isBattling) {
                header("Location: /battle/{$trainer->id}");
            } else {
                $name = TrainerClass::getLabel($trainer->class) . " " . $trainer->name;
                $this->session->getFlashBag()->add("successes", "You defeated {$name}");

                if ($playerEarnedGymBadge) {
                    $this->session->getFlashBag()->add("successes", "You earned the {$this->viewModelFactory->createGymBadgeName($trainer->gymBadge)}");
                }

                $this->session->getFlashBag()->add("successes", "You won a {$prize['name']}");

                header("Location: /map");
            }
        } elseif ($opponentAttackSucceeded) {
            $this->session->getFlashBag()->add("successes", "Your {$playerPokemonVm->name}'s attack missed!");
            $this->session->getFlashBag()->add("successes", "Foe {$trainerPokemonVm->name}'s attack hit!");
            $this->addEffectivenessMessage($opponentPokemon, $playerPokemon);
            if ($playerPokemonSurvivedHit) {
                $this->session->getFlashBag()->add("successes", "Your {$playerPokemonVm->name} endured through the power of friendship!");
            } else {
                $this->session->getFlashBag()->add("successes", "Your {$playerPokemonVm->name} fainted");
            }

            if ($trainer->isBattling) {
                header("Location: /battle/{$trainer->id}");
            } else {

                $name = TrainerClass::getLabel($trainer->class) . " " . $trainer->name;
                $this->session->getFlashBag()->add("successes", "You were defeated by {$name}");

                header("Location: /map");
            }
        } else {
            $this->session->getFlashBag()->add("successes", "Your {$playerPokemonVm->name}'s attack missed!");
            $this->session->getFlashBag()->add("successes", "Foe {$trainerPokemonVm->name}'s attack missed!");

            header("Location: /battle/{$trainer->id}");
        }

    }

    private function addEffectivenessMessage(Pokemon $attacker, Pokemon $defender): void
    {
        $typeMultiplier = $this->calculateTypeMultiplier($attacker, $defender);

        if ($typeMultiplier > 1.0) {
            $this->session->getFlashBag()->add("successes", "It's super effective!");
        } elseif ($typeMultiplier < 1.0) {
            $this->session->getFlashBag()->add("successes", "It's not very effective");
        }
    }

    private function calculateTypeMultiplier(Pokemon $attacker, Pokemon $defender): float
    {
        $primaryTypeMultiplier = $this->calculatePrimaryTypeMultiplier($attacker, $defender);
        $secondaryTypeMultiplier = 0.0;

        if (!is_null($attacker->secondaryType)) {
            $secondaryTypeMultiplier = $this->calculateSecondaryTypeMultiplier($attacker, $defender);
        }

        return max($primaryTypeMultiplier, $secondaryTypeMultiplier);
    }

    private function calculatePrimaryTypeMultiplier(Pokemon $attacker, Pokemon $defender): float
    {
        $multiplier = 1.0;

        $multiplier *= PokemonType::getMultiplier($attacker->primaryType, $defender->primaryType);

        if (!is_null($defender->secondaryType)) {
            $multiplier *= PokemonType::getMultiplier($attacker->primaryType, $defender->secondaryType);
        }

        return $multiplier;
    }

    private function calculateSecondaryTypeMultiplier(Pokemon $attacker, Pokemon $defender): float
    {
        $multiplier = 1.0;

        $multiplier *= PokemonType::getMultiplier($attacker->secondaryType, $defender->primaryType);

        if (!is_null($defender->secondaryType)) {
            $multiplier *= PokemonType::getMultiplier($attacker->secondaryType, $defender->secondaryType);
        }

        return $multiplier;
    }

    private function calculateAttackOutcome(Pokemon $attacker, Pokemon $defender): bool
    {
        $multiplier = $this->calculateTypeMultiplier($attacker, $defender);

        if ($multiplier === 0.0) {
            return false;
        }

        $typeLevelModifier = match ($multiplier) {
            0.25 => -4,
            0.5 => -2,
            1.0 => 0,
            2.0 => 2,
            4.0 => 4,
        };

        $levelDifference = $attacker->level - $defender->level + $typeLevelModifier;

        $percentageChance = match (true) {
            $levelDifference > 4 => 100,
            $levelDifference < -4 => 0,
            default => match ($levelDifference) {
                4 => 95,
                3 => 90,
                2 => 75,
                1 => 60,
                0 => 50,
                -1 => 40,
                -2 => 25,
                -3 => 10,
                -4 => 5,
            }
        };

        return mt_rand(1, 100) <= $percentageChance;
    }

    private static function calculateHitSurvival(Pokemon $defender): bool
    {
        return match (true) {
            $defender->friendship < 180   => false,
            $defender->friendship < 220   => mt_rand(1, 100) <= 10,
            $defender->friendship < 255   => mt_rand(1, 100) <= 15,
            $defender->friendship === 255 => mt_rand(1, 100) <= 20,
        };
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