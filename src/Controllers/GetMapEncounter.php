<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;
use Doctrine\DBAL\Connection;
use stdClass;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetMapEncounter
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly array $map,
    ) {}

    public function __invoke(): void
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $pokeballs = $instanceRow['unused_encounters'];
        $challengeTokens = $instanceRow['unused_moves'];

        $currentLocation = $this->createLocationViewModel($this->findLocation($instanceRow['current_location']));

        $successes = $this->session->getFlashBag()->get("successes");
        $errors = $this->session->getFlashBag()->get("errors");

        $trainers = [];

        if (array_key_exists('trainers', $this->findLocation($instanceRow['current_location']))) {
            foreach ($this->findLocation($instanceRow['current_location'])['trainers'] as $trainer) {
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

                $trainers[] = (object)[
                    'id'          => $trainer['id'],
                    'name'        => $trainer['name'],
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
            'pokeballs' => $pokeballs,
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
        $directions = [];

        /** @var string $locationId */
        foreach ($location['directions'] as $locationId) {
            $directionLocation = $this->findLocation($locationId);
            $directions[] = (object) [
                'id' => $directionLocation['id'],
                'name' => $directionLocation['name'],
            ];
        }

        return (object) [
            'id' => $location['id'],
            'name' => $location['name'],
            'directions' => $directions,
        ];
    }
}
