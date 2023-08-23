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
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\SharedKernel\TotalRegisteredPokemonQuery;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\TrainerClass;
use ConorSmith\Pokemon\TrainerConfigRepository;
use ConorSmith\Pokemon\ViewModelFactory as SharedViewModelFactory;
use ConorSmith\Pokemon\ViewModels\TeamMember;
use Doctrine\DBAL\Connection;
use LogicException;
use stdClass;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        private readonly TotalRegisteredPokemonQuery $totalRegisteredPokemonQuery,
        private readonly array $pokedex,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => $args['instanceId'],
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
                    'instanceId' => $args['instanceId'],
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
                    $hasCompletedPrerequisite = $this->hasBeatenAllGymTrainers($args['instanceId'], $trainer, $trainersInLocation);
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

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/Map.php", [
            'canEncounter' => true,
            'pokeballs' => $bag->countAllPokeBalls(),
            'challengeTokens' => $challengeTokens,
            'currentLocation' => $currentLocationViewModel,
            'wildPokemon' => $this->createWildPokemonViewModel(
                $this->encounterConfigRepository->findEncounters($instanceRow['current_location']),
            ),
            'trainers' => $trainers,
            'legendary' => $this->createLegendaryViewModel(
                $args['instanceId'],
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
            'map' => self::createMapViewModel($instanceRow['current_location']),
        ]));
    }

    private static function createMapViewModel(string $currentLocation): stdClass
    {
        $mapImageUrl = self::findMapImage($currentLocation);

        return (object) [
            'imageUrl' => $mapImageUrl,
            'class'    => match ($mapImageUrl) {
                "https://archives.bulbagarden.net/media/upload/a/a9/Kanto_Victory_Road_Map.png" => "map--kanto-victory-road",
                "https://archives.bulbagarden.net/media/upload/5/5b/Kanto_Route_28_Map.png" => "map--kanto-johto-border",
                "https://archives.bulbagarden.net/media/upload/9/95/Johto_Mt_Silver_Map.png" => "map--kanto-johto-border",
                "https://archives.bulbagarden.net/media/upload/4/46/Kanto_Route_27_Map.png" => "map--kanto-johto-border",
                "https://archives.bulbagarden.net/media/upload/7/77/Kanto_Tohjo_Falls_Map.png" => "map--kanto-johto-border",
                default => "",
            },
        ];
    }

    private function hasBeatenAllGymTrainers(string $instanceId, array $trainer, array $otherTrainersInLocation): bool
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
            'instanceId' => $instanceId,
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

    private function createLegendaryViewModel(string $instanceId, array $currentLocation, ?array $legendaryConfig): ?stdClass
    {
        if (is_null($legendaryConfig)) {
            return null;
        }

        if ($legendaryConfig['unlock'] instanceof RegionId
            && !$this->isPokedexRegionComplete($instanceId, $legendaryConfig['unlock'])
        ) {
            return null;
        }

        if ($this->totalRegisteredPokemonQuery->run() < $legendaryConfig['unlock']) {
            return null;
        }

        $latestCaptureRow = $this->db->fetchAssociative("SELECT * FROM legendary_captures WHERE instance_id = :instanceId AND pokemon_id = :pokemonId ORDER BY date_caught DESC", [
            'instanceId' => $instanceId,
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
            'instanceId' => $instanceId,
        ]);

        $levelLimit = self::findLevelLimit($instanceRow);

        if ($legendaryConfig['level'] > $levelLimit) {
            $canBattle = false;
        }

        $regionalLevelOffset = match ($currentLocation['region']) {
            RegionId::KANTO => 0,
            RegionId::JOHTO => 50,
            RegionId::HOENN => 100,
            default => throw new LogicException(),
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

    private function isPokedexRegionComplete(string $instanceId, RegionId $region): bool
    {
        $pokedexRegionRanges = match ($region) {
            RegionId::KANTO  => [1, 150],
            RegionId::JOHTO  => [152, 250],
            RegionId::HOENN  => [252, 384],
            RegionId::SINNOH => [387, 488],
            RegionId::UNOVA  => [495, 646],
            RegionId::KALOS  => [650, 718],
            RegionId::ALOLA  => [[722, 800], [803, 806]],
            RegionId::GALAR  => [[810, 892], [894, 905]],
            RegionId::PALDEA => [906, 1010],
        };

        if (is_integer($pokedexRegionRanges[0])) {
            $pokedexRegionRanges = [$pokedexRegionRanges];
        }

        $requiredPokedexNumbers = [];

        foreach ($pokedexRegionRanges as $range) {
            $requiredPokedexNumbers = array_merge($requiredPokedexNumbers, range($range[0], $range[1]));
        }

        $rows = $this->db->fetchAllAssociative("SELECT * FROM pokedex_entries WHERE instance_id = :instanceId", [
            'instanceId' => $instanceId,
        ]);

        $registeredPokedexNumbers = array_map(
            fn(array $row) => $row['number'],
            $rows,
        );

        $missingPokedexNumbers = array_diff($requiredPokedexNumbers, $registeredPokedexNumbers);

        return count($missingPokedexNumbers) === 0;
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

    private static function hasAllRegionalGymBadges(array $instanceRow, RegionId $region): bool
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
            if ($config['location'] instanceof RegionId
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

    private static function findMapImage(string $locationId): ?string
    {
        $mapImages = include __DIR__ . "/../Config/Maps/Kanto.php";

        if (array_key_exists($locationId, $mapImages)) {
            return "/assets/maps/" . $mapImages[$locationId];
        }

        $mapImages = include __DIR__ . "/../Config/Maps/Johto.php";

        if (array_key_exists($locationId, $mapImages)) {
            return "/assets/maps/" . $mapImages[$locationId];
        }

        $mapImages = include __DIR__ . "/../Config/Maps/Hoenn.php";

        if (array_key_exists($locationId, $mapImages)) {
            return "/assets/maps/" . $mapImages[$locationId];
        }

        return null;
    }
}
