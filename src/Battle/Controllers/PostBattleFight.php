<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\Domain\GameInstance;
use ConorSmith\Pokemon\PokemonType;
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
        private readonly ViewModelFactory $viewModelFactory,
    ) {}

    public function __invoke(array $args): void
    {
        $trainerBattleId = $args['id'];

        $gameInstance = $this->findGameInstance();
        $player = $this->playerRepository->findPlayer();
        $trainer = $this->trainerRepository->findTrainer($trainerBattleId);

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

        if ($playerPokemonWins) {

            $trainerPokemon->faint();

            if ($trainer->hasEntireTeamFainted()) {
                $gameInstance = $gameInstance->winPrizeMoney($trainer);
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
        $this->saveGameInstance($gameInstance);
        $this->playerRepository->savePlayer($player);

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
                $this->session->getFlashBag()->add("successes", "You defeated {$trainer->name}");

                if ($playerEarnedGymBadge) {
                    $this->session->getFlashBag()->add("successes", "You earned the {$this->viewModelFactory->createGymBadgeName($trainer->gymBadge)}");
                }

                $this->session->getFlashBag()->add("successes", "You won \${$trainer->prizeMoney}");

                header("Location: /map/encounter");
            }
        } else {
            $playerPokemonVm = $this->viewModelFactory->createPokemonInBattle($playerPokemon);
            $this->session->getFlashBag()->add("successes", "Your {$playerPokemonVm->name} fainted");

            if ($trainer->isBattling) {
                header("Location: /battle/{$trainer->id}");
            } else {

                $this->session->getFlashBag()->add("successes", "You were defeated by {$trainer->name}");

                header("Location: /map/encounter");
            }
        }

    }

    private function calculateTypeMultiplier(Pokemon $enemyPokemon, Pokemon $playerPokemon): float
    {
        $multiplier = 1.0;

        $multiplier *= PokemonType::getMultiplier($playerPokemon->primaryType, $enemyPokemon->primaryType);

        if (!is_null($playerPokemon->secondaryType)) {
            $multiplier *= PokemonType::getMultiplier($playerPokemon->secondaryType, $enemyPokemon->primaryType);
        }
        if (!is_null($enemyPokemon->secondaryType)) {
            $multiplier *= PokemonType::getMultiplier($playerPokemon->primaryType, $enemyPokemon->secondaryType);
        }
        if (!is_null($playerPokemon->secondaryType) && !is_null($enemyPokemon->secondaryType)) {
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

    private function findGameInstance(): GameInstance
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        return new GameInstance(
            INSTANCE_ID,
            $instanceRow['money'],
            $instanceRow['unused_moves'],
        );
    }

    private function saveGameInstance(GameInstance $gameInstance): void
    {
        $this->db->update("instances", [
            'money' => $gameInstance->money,
            'unused_moves' => $gameInstance->unusedChallengeTokens,
        ], [
            'id' => $gameInstance->id,
        ]);
    }
}