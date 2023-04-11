<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon;

use ConorSmith\Pokemon\SharedKernel\Domain\Region;
use WeakMap;

final class TrainerConfigRepository
{
    private WeakMap $trainerConfigRepository;

    public function __construct()
    {
        $this->trainerConfigRepository = new WeakMap();
        $this->trainerConfigRepository[Region::KANTO] = require __DIR__ . "/Config/Trainers/Kanto.php";
        $this->trainerConfigRepository[Region::JOHTO] = require __DIR__ . "/Config/Trainers/Johto.php";
    }

    public function findTrainersInLocation(string $locationId): ?array
    {
        foreach ($this->trainerConfigRepository as $region => $config) {
            if (array_key_exists($locationId, $config)) {
                return $config[$locationId];
            }
        }

        $eliteFourConfig = require __DIR__ . "/Config/EliteFour.php";

        foreach ($eliteFourConfig as $config) {
            if ($config['location'] === $locationId) {

                return $config['members'];
            }
        }

        return null;
    }

    public function findTrainer(string $trainerId): ?array
    {
        foreach ($this->trainerConfigRepository as $region => $config) {
            foreach ($config as $locationId => $entries) {
                foreach ($entries as $entry) {
                    if ($entry['id'] === $trainerId) {
                        $entry['locationId'] = $locationId;
                        return $entry;
                    }
                }
            }
        }

        $eliteFourConfig = require __DIR__ . "/Config/EliteFour.php";

        foreach ($eliteFourConfig as $config) {
            foreach ($config['members'] as $member) {
                if ($member['id'] === $trainerId) {
                    $member['locationId'] = $config['location'];
                    return $member;
                }
            }
        }

        return null;
    }
}