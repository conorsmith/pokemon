<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetBattle
{
    public function __construct(
        private readonly Session $session,
        private readonly TrainerRepository $trainerRepository,
        private readonly PlayerRepository $playerRepository,
        private readonly ViewModelFactory $viewModelFactory,
    ) {}

    public function __invoke(array $args): void
    {
        $trainerBattleId = $args['id'];

        $trainer = $this->trainerRepository->findTrainer($trainerBattleId);
        $trainerLeadPokemon = $trainer->hasEntireTeamFainted()
            ? $trainer->getLastFaintedPokemon()
            : $trainer->getLeadPokemon();

        $player = $this->playerRepository->findPlayer();
        $playerLeadPokemon = $player->hasEntireTeamFainted()
            ? $player->getLastFaintedPokemon()
            : $player->getLeadPokemon();

        $successes = $this->session->getFlashBag()->get("successes");
        $errors = $this->session->getFlashBag()->get("errors");

        echo TemplateEngine::render(__DIR__ . "/../Templates/Battle.php", [
            'id' => $trainer->id,
            'opponentPokemon' => $this->viewModelFactory->createPokemonInBattle($trainerLeadPokemon),
            'playerPokemon' => $this->viewModelFactory->createPokemonInBattle($playerLeadPokemon),
            'trainer' => $this->viewModelFactory->createTrainerInBattle($trainer),
            'isBattleOver' => $trainer->hasEntireTeamFainted() || $player->hasEntireTeamFainted(),
            'successes' => $successes,
            'errors' => $errors,
        ]);
    }
}
