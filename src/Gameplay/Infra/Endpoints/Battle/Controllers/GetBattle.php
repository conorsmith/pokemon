<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers;

use ConorSmith\Pokemon\Gameplay\Domain\Battle\PlayerRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\Trainer;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\TrainerRepository;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\ViewModels\TypeEffectiveness;
use ConorSmith\Pokemon\SharedKernel\TrainerClass;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\TrainerConfigRepository;
use ConorSmith\Pokemon\ViewModelFactory;
use Doctrine\DBAL\Connection;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetBattle
{
    public function __construct(
        private readonly Connection $db,
        private readonly TrainerConfigRepository $trainerConfigRepository,
        private readonly TrainerRepository $trainerRepository,
        private readonly PlayerRepository $playerRepository,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $trainerBattleId = $args['id'];

        $trainer = $this->trainerRepository->findTrainer($trainerBattleId);
        $trainerLeadPokemon = $trainer->hasEntirePartyFainted()
            ? $trainer->getLastFaintedPokemon()
            : $trainer->getLeadPokemon();

        $player = $this->playerRepository->findPlayer();
        $playerLeadPokemon = $player->hasEntirePartyFainted()
            ? $player->getLastFaintedPokemon()
            : $player->getLeadPokemon();

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/Battle.php", [
            'id'                         => $trainerBattleId,
            'opponentPokemon'            => $this->viewModelFactory->createPokemonInBattle($trainerLeadPokemon),
            'playerPokemon'              => $this->viewModelFactory->createPokemonInBattle($playerLeadPokemon),
            'primaryTypeEffectiveness'   => TypeEffectiveness::create("primary", $playerLeadPokemon, $trainerLeadPokemon),
            'secondaryTypeEffectiveness' => TypeEffectiveness::create("secondary", $playerLeadPokemon, $trainerLeadPokemon),
            'trainer'                    => $this->viewModelFactory->createTrainerInBattle($trainer, $this->createImageUrl($args['instanceId'], $trainer)),
            'isBattleOver'               => $trainer->hasEntirePartyFainted() || $player->hasEntirePartyFainted(),
        ]));
    }

    private function createImageUrl(string $instanceId, Trainer $trainer): string
    {
        $imageUrl = TrainerClass::getImageUrl($trainer->class, $trainer->gender);

        if (is_null($imageUrl)) {
            $trainerBattleRow = $this->db->fetchAssociative("SELECT * FROM trainer_battles WHERE instance_id = :instanceId AND trainer_id = :id", [
                'instanceId' => $instanceId,
                'id'         => $trainer->id,
            ]);

            if ($trainerBattleRow !== false) {
                $trainerConfig = $this->findTrainerConfig($trainerBattleRow['trainer_id']);
                if (array_key_exists('imageUrl', $trainerConfig)) {
                    $imageUrl = $trainerConfig['imageUrl'];
                } elseif (array_key_exists('leader', $trainerConfig)) {
                    $imageUrl = $trainerConfig['leader']['imageUrl'];
                }
            }
        }

        return $imageUrl;
    }

    private function findTrainerConfig(string $trainerId): array
    {
        $trainer = $this->trainerConfigRepository->findTrainer($trainerId);

        if (!is_null($trainer)) {
            return $trainer;
        }

        throw new Exception;
    }
}
