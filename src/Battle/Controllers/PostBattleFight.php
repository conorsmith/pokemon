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

        if ($playerPokemon->calculateSpeed() > $opponentPokemon->calculateSpeed()) {
            $playerGoesFirst = true;
        } elseif ($playerPokemon->calculateSpeed() < $opponentPokemon->calculateSpeed()) {
            $playerGoesFirst = false;
        } else {
            $playerGoesFirst = mt_rand(0, 1) === 0;
        }

        if ($playerGoesFirst) {
            $firstPokemon = $playerPokemon;
            $secondPokemon = $opponentPokemon;
        } else {
            $firstPokemon = $opponentPokemon;
            $secondPokemon = $playerPokemon;
        }

        $playerEarnedGymBadge = false;
        $prize = null;
        $firstPokemonSurvivedHit = false;
        $secondPokemonSurvivedHit = false;
        $firstPokemonDamageTaken = 0;
        $secondPokemonDamageTaken = 0;

        $firstAttackSucceeded = mt_rand(1, 100) <= self::calculateAccuracy($firstPokemon, $secondPokemon);

        if ($firstAttackSucceeded) {
            $secondPokemonDamageTaken = min(
                $secondPokemon->remainingHp,
                self::calculateDamage($firstPokemon, $secondPokemon),
            );
            if ($secondPokemonDamageTaken === $secondPokemon->remainingHp) {
                $secondPokemonSurvivedHit = self::calculateHitSurvival($secondPokemon);
                if ($secondPokemonSurvivedHit) {
                    $secondPokemonDamageTaken = $secondPokemon->remainingHp - 1;
                }
            }
            $secondPokemon->hitFor($secondPokemonDamageTaken);
        }

        $secondAttackSucceeded = !$secondPokemon->hasFainted
            && mt_rand(1, 100) <= self::calculateAccuracy($secondPokemon, $firstPokemon);

        if ($secondAttackSucceeded) {
            $firstPokemonDamageTaken = min(
                $firstPokemon->remainingHp,
                self::calculateDamage($secondPokemon, $firstPokemon),
            );
            if ($firstPokemonDamageTaken === $firstPokemon->remainingHp) {
                $firstPokemonSurvivedHit = self::calculateHitSurvival($firstPokemon);
                if ($firstPokemonSurvivedHit) {
                    $firstPokemonDamageTaken = $firstPokemon->remainingHp - 1;
                }
            }
            $firstPokemon->hitFor($firstPokemonDamageTaken);
        }

        if ($playerPokemon->hasFainted) {
            $this->reportTeamPokemonFaintedCommand->run(
                $playerPokemon->id,
                $playerPokemon->level,
                $opponentPokemon->level,
            );
        }

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

        $firstPokemonVm = $this->viewModelFactory->createPokemonInBattle($firstPokemon);
        $secondPokemonVm = $this->viewModelFactory->createPokemonInBattle($secondPokemon);
        $firstPokemonDescriptor = $playerGoesFirst ? "Your" : "Foe";
        $secondPokemonDescriptor = $playerGoesFirst ? "Foe" : "Your";

        if ($firstAttackSucceeded) {
            $this->session->getFlashBag()->add("successes", "{$firstPokemonDescriptor} {$firstPokemonVm->name}'s attack hit!");
            $this->addEffectivenessMessage($firstPokemon, $secondPokemon);
            $this->session->getFlashBag()->add("successes", "{$secondPokemonDescriptor} {$secondPokemonVm->name} took {$secondPokemonDamageTaken} damage");
            if ($secondPokemonSurvivedHit) {
                $this->session->getFlashBag()->add("successes", "{$secondPokemonDescriptor} {$secondPokemonVm->name} endured through the power of friendship!");
            } elseif ($secondPokemon->hasFainted) {
                $this->session->getFlashBag()->add("successes", "{$secondPokemonDescriptor} {$secondPokemonVm->name} fainted");
            }
        } elseif (!$firstPokemon->hasFainted) {
            $this->session->getFlashBag()->add("successes", "{$firstPokemonDescriptor} {$firstPokemonVm->name}'s attack missed!");
        }

        if ($secondAttackSucceeded) {
            $this->session->getFlashBag()->add("successes", "{$secondPokemonDescriptor} {$secondPokemonVm->name}'s attack hit!");
            $this->addEffectivenessMessage($secondPokemon, $firstPokemon);
            $this->session->getFlashBag()->add("successes", "{$firstPokemonDescriptor} {$firstPokemonVm->name} took {$firstPokemonDamageTaken} damage");
            if ($firstPokemonSurvivedHit) {
                $this->session->getFlashBag()->add("successes", "{$firstPokemonDescriptor} {$firstPokemonVm->name} endured through the power of friendship!");
            } elseif ($firstPokemon->hasFainted) {
                $this->session->getFlashBag()->add("successes", "{$firstPokemonDescriptor} {$firstPokemonVm->name} fainted");
            }
        } elseif (!$secondPokemon->hasFainted) {
            $this->session->getFlashBag()->add("successes", "{$secondPokemonDescriptor} {$secondPokemonVm->name}'s attack missed!");
        }

        if ($trainer->hasEntireTeamFainted()) {
            $name = TrainerClass::getLabel($trainer->class) . " " . $trainer->name;
            $this->session->getFlashBag()->add("successes", "You defeated {$name}");

            if ($playerEarnedGymBadge) {
                $this->session->getFlashBag()->add("successes", "You earned the {$this->viewModelFactory->createGymBadgeName($trainer->gymBadge)}");
            }
            $this->session->getFlashBag()->add("successes", "You won a {$prize['name']}");

        } elseif ($player->hasEntireTeamFainted()) {
            $name = TrainerClass::getLabel($trainer->class) . " " . $trainer->name;
            $this->session->getFlashBag()->add("successes", "You were defeated by {$name}");
        }

        header("Location: /battle/{$trainer->id}");
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

    private static function calculateAccuracy(Pokemon $attacker, Pokemon $defender): int
    {
        $baseAccuracy = 95;

        $friendshipFactor = $defender->friendship === 255 ? 4 : 0;

        return $baseAccuracy + $friendshipFactor;
    }

    private function calculateDamage(Pokemon $attacker, Pokemon $defender): int
    {
        $power = 40;

        $levelFactor = (2 * $attacker->level / 5) + 2;
        $statFactor = $attacker->calculateAttack() / $defender->calculateDefence();

        $baseDamage = ($levelFactor * $power * $statFactor / 50) + 2;

        $randomFactor = mt_rand(85, 100) / 100;

        $typeFactor = $this->calculateTypeMultiplier($attacker, $defender);

        return intval(round($baseDamage * $randomFactor * $typeFactor));
    }
}