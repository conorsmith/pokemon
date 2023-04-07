<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Domain\Trainer;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\TrainerClass;
use ConorSmith\Pokemon\ViewModelFactory;
use Doctrine\DBAL\Connection;
use Exception;

final class GetBattle
{
    public function __construct(
        private readonly Connection $db,
        private readonly TrainerRepository $trainerRepository,
        private readonly PlayerRepository $playerRepository,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly TemplateEngine $templateEngine,
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

        echo $this->templateEngine->render(__DIR__ . "/../Templates/Battle.php", [
            'id' => $trainer->id,
            'opponentPokemon' => $this->viewModelFactory->createPokemonInBattle($trainerLeadPokemon),
            'playerPokemon' => $this->viewModelFactory->createPokemonInBattle($playerLeadPokemon),
            'trainer' => $this->viewModelFactory->createTrainerInBattle($trainer, $this->createImageUrl($trainer)),
            'isBattleOver' => $trainer->hasEntireTeamFainted() || $player->hasEntireTeamFainted(),
        ]);
    }

    private function createImageUrl(Trainer $trainer): string
    {
        $imageUrl = TrainerClass::getImageUrl($trainer->class, $trainer->gender);

        if (is_null($imageUrl)) {
            $trainerBattleRow = $this->db->fetchAssociative("SELECT * FROM trainer_battles WHERE instance_id = :instanceId AND id = :id", [
                'instanceId' => INSTANCE_ID,
                'id' => $trainer->id,
            ]);

            if ($trainerBattleRow !== false) {
                $trainerConfig = self::findTrainerConfig($trainerBattleRow['trainer_id']);
                if (array_key_exists('imageUrl', $trainerConfig)) {
                    $imageUrl = $trainerConfig['imageUrl'];
                }
            }
        }

        return $imageUrl;
    }

    private static function findTrainerConfig(string $trainerId): array
    {
        $config = require __DIR__ . "/../../Config/Trainers.php";

        foreach ($config as $locationEntries) {
            foreach ($locationEntries as $entry) {
                if ($entry['id'] === $trainerId) {
                    return $entry;
                }
            }
        }

        throw new Exception;
    }
}
