<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\EncounterConfigRepository;
use ConorSmith\Pokemon\EncounterType;
use ConorSmith\Pokemon\Gender;
use ConorSmith\Pokemon\GymBadge;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\Location\Repositories\LocationRepository;
use ConorSmith\Pokemon\Location\ViewModels\ViewModelFactory;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\Domain\Region;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\TrainerClass;
use ConorSmith\Pokemon\TrainerConfigRepository;
use ConorSmith\Pokemon\ViewModelFactory as SharedViewModelFactory;
use ConorSmith\Pokemon\ViewModels\TeamMember;
use Doctrine\DBAL\Connection;
use stdClass;

final class GetMap
{
    public function __construct(
        private readonly Connection $db,
        private readonly LocationRepository $locationRepository,
        private readonly BagRepository $bagRepository,
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly EncounterConfigRepository $encounterConfigRepository,
        private readonly TrainerConfigRepository $trainerConfigRepository,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly SharedViewModelFactory $sharedViewModelFactory,
        private readonly array $pokedex,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(): void
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $bag = $this->bagRepository->find();

        $challengeTokens = $bag->count(ItemId::CHALLENGE_TOKEN);

        $currentLocationViewModel = $this->viewModelFactory->createLocation(
            $this->locationRepository->findCurrentLocation(),
        );

        $trainers = [];

        $trainersInLocation = $this->trainerConfigRepository->findTrainersInLocation($instanceRow['current_location']);

        if (!is_null($trainersInLocation)) {
            foreach ($trainersInLocation as $trainer) {
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

                if (array_key_exists('imageUrl', $trainer)) {
                    $imageUrl = $trainer['imageUrl'];
                } else {
                    $imageUrl = TrainerClass::getImageUrl($trainer['class'], $trainer['gender'] ?? Gender::IMMATERIAL);
                }

                $hasCompletedPrerequisite = true;

                if (array_key_exists('leader', $trainer)) {
                    $imageUrl = $trainer['leader']['imageUrl'];
                    $hasCompletedPrerequisite = $this->hasBeatenAllGymTrainers($trainer, $trainersInLocation);
                }

                if (array_key_exists('prerequisite', $trainer)
                    && array_key_exists('champion', $trainer['prerequisite'])
                ) {
                    $eliteFourChallenge = $this->eliteFourChallengeRepository->findVictoryInRegion($trainer['prerequisite']['champion']);
                    if (is_null($eliteFourChallenge)) {
                        continue;
                    }
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
                        ? $this->sharedViewModelFactory->createGymBadgeName($trainer['leader']['badge'])
                        : "",
                ];
            }
        }

        $legendaryConfig = $this->findLegendaryConfig($instanceRow['current_location']);

        echo $this->templateEngine->render(__DIR__ . "/../Templates/Map.php", [
            'canEncounter' => true,
            'pokeballs' => $bag->countAllPokeBalls(),
            'challengeTokens' => $challengeTokens,
            'currentLocation' => $currentLocationViewModel,
            'wildPokemon' => $this->createWildPokemonViewModel(
                $this->encounterConfigRepository->findEncounters($instanceRow['current_location']),
            ),
            'trainers' => $trainers,
            'legendary' => $this->createLegendaryViewModel(
                $this->locationConfigRepository->findLocation($instanceRow['current_location']),
                $legendaryConfig,
            ),
            'eliteFour' => $this->createEliteFourViewModel(
                self::findEliteFourConfig($instanceRow['current_location']),
                $instanceRow,
            ),
            'hallOfFame' => $this->createHallOfFameViewModel(
                self::findEliteFourConfig($instanceRow['current_location']),
            ),
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

        sort($gymTrainerIds);
        sort($beatenGymTrainerIds);

        return $gymTrainerIds === $beatenGymTrainerIds;
    }

    private function createLegendaryViewModel(array $currentLocation, ?array $legendaryConfig): ?stdClass
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

        $regionalLevelOffset = match ($currentLocation['region']) {
            Region::KANTO => 0,
            Region::JOHTO => 50,
            Region::HOENN => 100,
        };

        return (object) [
            'number'          => $legendaryConfig['pokemon'],
            'name'            => $this->pokedex[$legendaryConfig['pokemon']]['name'],
            'imageUrl'        => TeamMember::createImageUrl($legendaryConfig['pokemon']),
            'level'           => $legendaryConfig['level'] + $regionalLevelOffset,
            'canBattle'       => $canBattle,
            'lastEncountered' => $lastCaught ? $lastCaught->ago() : "",
        ];
    }

    private function createEliteFourViewModel(?array $eliteFourConfig, array $instanceRow): ?stdClass
    {
        if (is_null($eliteFourConfig)) {
            return null;
        }

        $eliteFourChallenge = $this->eliteFourChallengeRepository->findVictoryInRegion($eliteFourConfig['region']);

        if (!is_null($eliteFourChallenge)) {
            return null;
        }

        $bag = $this->bagRepository->find();

        $canChallenge = $bag->count(ItemId::CHALLENGE_TOKEN) >= 5
            && self::hasAllRegionalGymBadges($instanceRow, $eliteFourConfig['region']);

        return (object) [
            'memberImageUrls' => array_map(
                fn (array $config) => $config['imageUrl'],
                array_slice($eliteFourConfig['members'], 0, 4),
            ),
            'region' => $eliteFourConfig['region']->value,
            'canChallenge' => $canChallenge,
        ];
    }

    private function createHallOfFameViewModel(?array $eliteFourConfig): ?stdClass
    {
        if (is_null($eliteFourConfig)) {
            return null;
        }

        $eliteFourChallenge = $this->eliteFourChallengeRepository->findVictoryInRegion($eliteFourConfig['region']);

        if (is_null($eliteFourChallenge)) {
            return null;
        }

        return (object) [
            'region' => strtolower($eliteFourConfig['region']->value),
        ];
    }

    private static function hasAllRegionalGymBadges(array $instanceRow, Region $region): bool
    {
        $gymBadges = array_map(
            fn(int $value) => GymBadge::from($value),
            json_decode($instanceRow['badges']),
        );

        foreach (GymBadge::allFromRegion($region) as $gymBadge) {
            if (!in_array($gymBadge, $gymBadges)) {
                return false;
            }
        }

        return true;
    }

    private static function findLevelLimit(array $instanceRow): int
    {
        $gymBadges = array_map(
            fn(int $value) => GymBadge::from($value),
            json_decode($instanceRow['badges']),
        );

        if (count($gymBadges) === 0) {
            return GymBadge::BOULDER->levelLimit();
        }

        $highestRankedBadge = GymBadge::findHighestRanked($gymBadges);

        return $highestRankedBadge->levelLimit();
    }

    private function findLegendaryConfig(string $locationId): ?array
    {
        $legendariesConfig = require __DIR__ . "/../Config/Legendaries.php";

        foreach ($legendariesConfig as $config) {
            if ($config['location'] instanceof Region
                && $this->encounterRoamingLegendary($locationId, $config)
            ) {
                return $config;
            }
            if ($config['location'] === $locationId) {
                return $config;
            }
        }

        return null;
    }

    private function encounterRoamingLegendary(string $currentLocationId, array $legendaryConfig): bool
    {
        RandomNumberGenerator::setSeed(crc32($legendaryConfig['pokemon'] . date("Y-m-d")));

        $locations = $this->locationConfigRepository->findAllLocationsInRegion($legendaryConfig['location']);

        $roamingLocation = $locations[RandomNumberGenerator::generateInRange(0, count($locations) - 1)];

        RandomNumberGenerator::unsetSeed();

        return $currentLocationId === $roamingLocation['id'];
    }

    private static function findEliteFourConfig(string $locationId): ?array
    {
        $eliteFourConfig = require __DIR__ . "/../Config/EliteFour.php";

        foreach ($eliteFourConfig as $config) {
            if ($config['location'] === $locationId) {
                return $config;
            }
        }

        return null;
    }

    private function createWildPokemonViewModel(?array $encounterTables): stdClass
    {
        return (object) [
            'hasEncounters' => !is_null($encounterTables),
            'encounters' => (object) [
                'walking' => isset($encounterTables[EncounterType::WALKING]),
                'surfing' => isset($encounterTables[EncounterType::SURFING]),
                'fishing' => isset($encounterTables[EncounterType::FISHING]),
                'rockSmash' => isset($encounterTables[EncounterType::ROCK_SMASH]),
            ],
        ];
    }
}
