<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\Repositories\Battle\PlayerRepository;
use ConorSmith\Pokemon\Repositories\Battle\TrainerRepository;
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

        $battleTrainer = $this->trainerRepository->findTrainer($trainerBattleId);

        $player = $this->playerRepository->findPlayer();
        $playerLeadPokemon = $player->getLeadPokemon();

        $successes = $this->session->getFlashBag()->get("successes");
        $errors = $this->session->getFlashBag()->get("errors");

        echo TemplateEngine::render(__DIR__ . "/../Templates/Battle.php", [
            'id' => $battleTrainer->id,
            'activePokemon' => $this->viewModelFactory->createPokemonInBattle($battleTrainer->getLeadPokemon()),
            'leadPokemon' => $this->viewModelFactory->createPokemonInBattle($playerLeadPokemon),
            'trainer' => $this->viewModelFactory->createTrainerInBattle($battleTrainer),
            'successes' => $successes,
            'errors' => $errors,
        ]);
    }
}
