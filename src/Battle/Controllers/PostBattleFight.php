<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Trainer;
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
        private readonly Connection $db,
        private readonly Session $session,
        private readonly TrainerRepository $trainerRepository,
        private readonly PlayerRepository $playerRepository,
        private readonly BagRepository $bagRepository,
        private readonly ViewModelFactory $viewModelFactory,
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
        $trainerPokemon = $trainer->getLeadPokemon();

        $playerPokemonWins = $this->calculateWinner(
            $trainerPokemon,
            $playerPokemon
        );

        $playerEarnedGymBadge = false;
        $prize = null;

        if ($playerPokemonWins) {

            $trainerPokemon->faint();

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
            }
        } else {

            $playerPokemon->faint();

            if ($player->hasEntireTeamFainted()) {
                $trainer = $trainer->endBattle();
                $player = $player->reviveTeam();
            }
        }

        $this->db->beginTransaction();

        $this->trainerRepository->saveTrainer($trainer);
        $this->playerRepository->savePlayer($player);
        $this->bagRepository->save($bag);

        $this->db->commit();

        $typeMultiplier = $this->calculateTypeMultiplier($trainerPokemon, $playerPokemon);

        if ($typeMultiplier > 1.0) {
            $this->session->getFlashBag()->add("successes", "It's super effective!");
        } elseif ($typeMultiplier < 1.0) {
            $this->session->getFlashBag()->add("successes", "It's not very effective");
        }

        if ($playerPokemonWins) {

            $trainerPokemonVm = $this->viewModelFactory->createPokemonInBattle($trainerPokemon);
            $this->session->getFlashBag()->add("successes", "Enemy {$trainerPokemonVm->name} fainted");

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
        } else {
            $playerPokemonVm = $this->viewModelFactory->createPokemonInBattle($playerPokemon);
            $this->session->getFlashBag()->add("successes", "Your {$playerPokemonVm->name} fainted");

            if ($trainer->isBattling) {
                header("Location: /battle/{$trainer->id}");
            } else {

                $name = TrainerClass::getLabel($trainer->class) . " " . $trainer->name;
                $this->session->getFlashBag()->add("successes", "You were defeated by {$name}");

                header("Location: /map");
            }
        }

    }

    private function calculateTypeMultiplier(Pokemon $enemyPokemon, Pokemon $playerPokemon): float
    {
        $primaryTypeMultiplier = $this->calculatePrimaryTypeMultiplier($enemyPokemon, $playerPokemon);
        $secondaryTypeMultiplier = 0.0;

        if (!is_null($playerPokemon->secondaryType)) {
            $secondaryTypeMultiplier = $this->calculateSecondaryTypeMultiplier($enemyPokemon, $playerPokemon);
        }

        return max($primaryTypeMultiplier, $secondaryTypeMultiplier);
    }

    private function calculatePrimaryTypeMultiplier(Pokemon $enemyPokemon, Pokemon $playerPokemon): float
    {
        $multiplier = 1.0;

        $multiplier *= PokemonType::getMultiplier($playerPokemon->primaryType, $enemyPokemon->primaryType);

        if (!is_null($enemyPokemon->secondaryType)) {
            $multiplier *= PokemonType::getMultiplier($playerPokemon->primaryType, $enemyPokemon->secondaryType);
        }

        return $multiplier;
    }

    private function calculateSecondaryTypeMultiplier(Pokemon $enemyPokemon, Pokemon $playerPokemon): float
    {
        $multiplier = 1.0;

        $multiplier *= PokemonType::getMultiplier($playerPokemon->secondaryType, $enemyPokemon->primaryType);

        if (!is_null($enemyPokemon->secondaryType)) {
            $multiplier *= PokemonType::getMultiplier($playerPokemon->secondaryType, $enemyPokemon->secondaryType);
        }

        return $multiplier;
    }

    private function calculateWinner(Pokemon $enemyPokemon, Pokemon $playerPokemon): bool
    {
        $multiplier = $this->calculateTypeMultiplier($enemyPokemon, $playerPokemon);

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

        $levelDifference = $playerPokemon->level - $enemyPokemon->level + $typeLevelModifier;

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