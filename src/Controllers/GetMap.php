<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Direction;
use ConorSmith\Pokemon\Gender;
use ConorSmith\Pokemon\GymBadge;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\LocationType;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\TrainerClass;
use ConorSmith\Pokemon\ViewModelFactory;
use ConorSmith\Pokemon\ViewModels\TeamMember;
use Doctrine\DBAL\Connection;
use stdClass;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetMap
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly BagRepository $bagRepository,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly array $map,
        private readonly array $pokedex,
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

                $hasCompletedPrerequisite = true;

                if (array_key_exists('leader', $trainer)) {
                    $imageUrl = $trainer['leader']['imageUrl'];
                    $hasCompletedPrerequisite = $this->hasBeatenAllGymTrainers($trainer, $trainerConfigFile[$instanceRow['current_location']]);
                }

                $trainers[] = (object)[
                    'id'          => $trainer['id'],
                    'name'        => TrainerClass::getLabel($trainer['class']) . (isset($trainer['name']) ? " {$trainer['name']}" : ""),
                    'imageUrl'    => $imageUrl,
                    'team'        => count($trainer['team']),
                    'canBattle'   => !$isInCooldownWindow && $challengeTokens > 0 && $hasCompletedPrerequisite,
                    'lastBeaten'  => $lastBeaten ? $lastBeaten->ago() : "",
                    'isGymLeader' => array_key_exists('leader', $trainer),
                    'leaderBadge' => array_key_exists('leader', $trainer)
                        ? $this->viewModelFactory->createGymBadgeName($trainer['leader']['badge'])
                        : "",
                ];
            }
        }

        $legendaryConfig = self::findLegendaryConfig($instanceRow['current_location']);

        echo TemplateEngine::render(__DIR__ . "/../Templates/Map.php", [
            'canEncounter' => $bag->hasAnyPokeBall() && $currentLocation->hasPokemon,
            'challengeTokens' => $challengeTokens,
            'currentLocation' => $currentLocation,
            'trainers' => $trainers,
            'legendary' => $this->createLegendaryViewModel($legendaryConfig),
            'successes' => $successes,
            'errors' => $errors,
        ]);
    }

    private function hasBeatenAllGymTrainers(array $trainer, array $otherTrainersInLocation): bool
    {
        $gymTrainerIds = array_filter(
            array_map(
                fn(array $trainer) => $trainer['id'],
                $otherTrainersInLocation,
            ),
            fn(string $trainerId) => $trainerId !== $trainer['id'],
        );

        $beatenGymTrainerIds = [];

        $rows = $this->db->fetchAllAssociative("SELECT * FROM trainer_battles WHERE instance_id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        foreach ($rows as $row) {
            if (in_array($row['trainer_id'], $gymTrainerIds)
                && $row['date_last_beaten'] !== null
            ) {
                $beatenGymTrainerIds[] = $row['trainer_id'];
            }
        }

        return $gymTrainerIds === $beatenGymTrainerIds;
    }

    private function createLegendaryViewModel(?array $legendaryConfig): ?stdClass
    {
        if (is_null($legendaryConfig)) {
            return null;
        }

        $pokedexRows = $this->db->fetchAllAssociative("SELECT * FROM pokedex_entries WHERE instance_id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        if (count($pokedexRows) < $legendaryConfig['unlock']) {
            return null;
        }

        $latestCaptureRow = $this->db->fetchAssociative("SELECT * FROM legendary_captures WHERE instance_id = :instanceId AND pokemon_id = :pokemonId ORDER BY date_caught DESC", [
            'instanceId' => INSTANCE_ID,
            'pokemonId' => $legendaryConfig['pokemon'],
        ]);

        $canBattle = true;

        $lastCaught = $latestCaptureRow
            ? CarbonImmutable::createFromFormat("Y-m-d H:i:s", $latestCaptureRow['date_caught'], "Europe/Dublin")
            : null;

        if ($lastCaught && $lastCaught->addMonth() > CarbonImmutable::today(new CarbonTimeZone("Europe/Dublin"))) {
            $canBattle = false;
        }

        $bag = $this->bagRepository->find();

        if (!$bag->hasAnyPokeBall()) {
            $canBattle = false;
        }

        if (!$bag->has(ItemId::CHALLENGE_TOKEN)) {
            $canBattle = false;
        }

        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $levelLimit = self::findLevelLimit($instanceRow);

        if ($legendaryConfig['level'] > $levelLimit) {
            $canBattle = false;
        }

        return (object) [
            'number'          => $legendaryConfig['pokemon'],
            'name'            => $this->pokedex[$legendaryConfig['pokemon']]['name'],
            'imageUrl'        => TeamMember::createImageUrl($legendaryConfig['pokemon']),
            'level'           => $legendaryConfig['level'],
            'canBattle'       => $canBattle,
            'lastEncountered' => $lastCaught ? $lastCaught->ago() : "",
        ];
    }

    private static function findLevelLimit(array $instanceRow): int
    {
        $gymBadges = array_map(
            fn(int $value) => GymBadge::from($value),
            json_decode($instanceRow['badges'])
        );

        if (count($gymBadges) === 0) {
            return GymBadge::BOULDER->levelLimit();
        }

        $highestRankedBadge = GymBadge::findHighestRanked($gymBadges);

        return $highestRankedBadge->levelLimit();
    }

    private static function findLegendaryConfig(string $locationId): ?array
    {
        $legendariesConfig = require __DIR__ . "/../Config/Legendaries.php";

        foreach ($legendariesConfig as $config) {
            if ($config['location'] === $locationId) {
                return $config;
            }
        }

        return null;
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
            'section' => $location['section'] ?? null,
            'hasPokemon' => isset($location['pokemon']) && count($location['pokemon']) > 0,
            'hasCardinalDirections' => false,
            'hasVerticalDirections' => false,
            'directions' => [],
        ];

        /** @var string $locationId */
        foreach ($location['directions'] as $key => $locationId) {
            $directionLocation = $this->findLocation($locationId);

            $section = $directionLocation['section'] ?? null;

            if (!isset($location['type']) && isset($directionLocation['type'])
                || !isset($directionLocation['type']) && isset($location['type'])
                || isset($location['type']) && isset($directionLocation['type']) && $location['type'] !== $directionLocation['type']
            ) {
                $section = null;
            }

            $directionViewModel = (object) [
                'id'   => $directionLocation['id'],
                'name' => $directionLocation['name'],
                'section' => $section,
                'icon' => match ($directionLocation['type'] ?? null) {
                    LocationType::CITY => "fas fa-city",
                    LocationType::CAVE => "fas fa-mountain",
                    LocationType::TOWER => "far fa-building",
                    LocationType::GYM => "fas fa-dumbbell",
                    default => null,
                }
            ];
            if (Direction::isCardinal($key)) {
                $viewModel->hasCardinalDirections = true;
                $viewModel->{Direction::toSlug($key)} = $directionViewModel;
            } elseif (Direction::isVertical($key)) {
                $viewModel->hasVerticalDirections = true;
                $directionViewModel->icon = null;
                $viewModel->{Direction::toSlug($key)} = $directionViewModel;
            } else {
                $viewModel->directions[] = $directionViewModel;
            }
        }

        return $viewModel;
    }
}
