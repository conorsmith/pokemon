<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Domain\Trainer;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepositoryDb;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\TrainerClass;
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
        private readonly PlayerRepositoryDb $playerRepository,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
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

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/Battle.php", [
            'id' => $trainerBattleId,
            'opponentPokemon' => $this->viewModelFactory->createPokemonInBattle($trainerLeadPokemon),
            'playerPokemon' => $this->viewModelFactory->createPokemonInBattle($playerLeadPokemon),
            'trainer' => $this->viewModelFactory->createTrainerInBattle($trainer, $this->createImageUrl($args['instanceId'], $trainer)),
            'isBattleOver' => $trainer->hasEntireTeamFainted() || $player->hasEntireTeamFainted(),
        ]));
    }

    private function createImageUrl(string $instanceId, Trainer $trainer): string
    {
        $imageUrl = TrainerClass::getImageUrl($trainer->class, $trainer->gender);

        if (is_null($imageUrl)) {
            $trainerBattleRow = $this->db->fetchAssociative("SELECT * FROM trainer_battles WHERE instance_id = :instanceId AND trainer_id = :id", [
                'instanceId' => $instanceId,
                'id' => $trainer->id,
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
