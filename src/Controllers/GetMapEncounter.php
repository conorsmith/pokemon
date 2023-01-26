<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Direction;
use ConorSmith\Pokemon\Gender;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\TrainerClass;
use ConorSmith\Pokemon\ViewModelFactory;
use Doctrine\DBAL\Connection;
use stdClass;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetMapEncounter
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly BagRepository $bagRepository,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly array $map,
    ) {}

    public function __invoke(): void
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $bag = $this->bagRepository->find();

        $challengeTokens = $bag->count(ItemId::CHALLENGE_TOKEN);

        $currentLocation = $this->createLocationViewModel($this->findLocation($instanceRow['current_location']));

        $successes = $this->session->getFlashBag()->get("successes");
        $errors = $this->session->getFlashBag()->get("errors");

        $trainers = [];

        $trainerConfigFile = require __DIR__ . "/../Config/Trainers.php";

        if (array_key_exists($instanceRow['current_location'], $trainerConfigFile)) {
            foreach ($trainerConfigFile[$instanceRow['current_location']] as $trainer) {
                $trainerBattleRow = $this->db->fetchAssociative("SELECT * FROM trainer_battles WHERE instance_id = :instanceId AND trainer_id = :trainerId", [
                    'instanceId' => INSTANCE_ID,
                    'trainerId'  => $trainer['id'],
                ]);

                if ($trainerBattleRow !== false && !is_null($trainerBattleRow['date_last_beaten'])) {
                    $lastBeaten = CarbonImmutable::createFromFormat("Y-m-d H:i:s", $trainerBattleRow['date_last_beaten'], new CarbonTimeZone("Europe/Dublin"));
                    $isInCooldownWindow = $lastBeaten->addWeek() > CarbonImmutable::today(new CarbonTimeZone("Europe/Dublin"));
                } else {
                    $lastBeaten = null;
                    $isInCooldownWindow = false;
                }

                $imageUrl = TrainerClass::getImageUrl($trainer['class'], $trainer['gender'] ?? Gender::IMMATERIAL);

                if (array_key_exists('leader', $trainer)) {
                    $imageUrl = $trainer['leader']['imageUrl'];
                }

                $trainers[] = (object)[
                    'id'          => $trainer['id'],
                    'name'        => TrainerClass::getLabel($trainer['class']) . (isset($trainer['name']) ? " {$trainer['name']}" : ""),
                    'imageUrl'    => $imageUrl,
                    'team'        => count($trainer['team']),
                    'canBattle'   => !$isInCooldownWindow && $challengeTokens > 0,
                    'lastBeaten'  => $lastBeaten ? $lastBeaten->ago() : "",
                    'isGymLeader' => array_key_exists('leader', $trainer),
                    'leaderBadge' => array_key_exists('leader', $trainer)
                        ? $this->viewModelFactory->createGymBadgeName($trainer['leader']['badge'])
                        : "",
                ];
            }
        }

        echo TemplateEngine::render(__DIR__ . "/../Templates/MapEncounter.php", [
            'canEncounter' => $bag->hasAnyPokeBall() && $currentLocation->hasPokemon,
            'challengeTokens' => $challengeTokens,
            'currentLocation' => $currentLocation,
            'trainers' => $trainers,
            'successes' => $successes,
            'errors' => $errors,
        ]);
    }

    private function findLocation(string $id): array
    {
        /** @var array $location */
        foreach ($this->map as $location) {
            if ($location['id'] === $id) {
                return $location;
            }
        }

        throw new \Exception;
    }
    private function createLocationViewModel(array $location): stdClass
    {
        $viewModel = (object) [
            'id' => $location['id'],
            'name' => $location['name'],
            'hasPokemon' => isset($location['pokemon']) && count($location['pokemon']) > 0,
            'hasCardinalDirections' => false,
            'directions' => [],
        ];

        /** @var string $locationId */
        foreach ($location['directions'] as $key => $locationId) {
            $directionLocation = $this->findLocation($locationId);
            if (Direction::isCardinal($key)) {
                $viewModel->hasCardinalDirections = true;
                $viewModel->{Direction::toSlug($key)} = (object) [
                    'id'   => $directionLocation['id'],
                    'name' => $directionLocation['name'],
                ];
            } else {
                $viewModel->directions[] = (object) [
                    'id'   => $directionLocation['id'],
                    'name' => $directionLocation['name'],
                ];
            }
        }

        return $viewModel;
    }
}
