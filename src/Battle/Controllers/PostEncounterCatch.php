<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Domain\Encounter;
use ConorSmith\Pokemon\Battle\EventFactory;
use ConorSmith\Pokemon\Battle\Repositories\EncounterRepository;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\SharedKernel\CatchPokemonCommand;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\GymBadge;
use Doctrine\DBAL\Connection;

final class PostEncounterCatch
{
    public function __construct(
        private readonly Connection $db,
        private readonly EncounterRepository $encounterRepository,
        private readonly BagRepository $bagRepository,
        private readonly CatchPokemonCommand $catchPokemonCommand,
        private readonly EventFactory $eventFactory,
        private readonly array $map,
    ) {}

    public function __invoke(array $args): void
    {
        $encounterId = $args['id'];
        $pokeballItemId = $_POST['pokeball'];

        $encounter = $this->encounterRepository->find($encounterId);

        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $bag = $this->bagRepository->find();

        if (!$bag->has($pokeballItemId)) {
            $itemConfig = require __DIR__ . "/../../Config/Items.php";
            echo json_encode([
                $this->eventFactory->createMessageEvent("No {$itemConfig[$pokeballItemId]['name']} remaining."),
            ]);
            return;
        }

        $levelLimit = self::findLevelLimit($instanceRow);

        if ($encounter->pokemon->level > $levelLimit) {
            echo json_encode([
                $this->eventFactory->createMessageEvent("You can't catch Pokémon above level {$levelLimit}"),
            ]);
            return;
        }

        $events = [];

        $catchRate = self::calculateCatchRate($encounter, $pokeballItemId);

        if ($catchRate >= 255 * 4096) {
            $caught = true;
        } else {
            $caught = false;

            for ($i = 0; $i < 3 && !$caught; $i++) {
                $shakeRoll = mt_rand(0, 65535);
                $shakeProbability = self::calculateShakeProbability($catchRate);
                $events[] = $this->eventFactory->createShakeEvent($catchRate, $shakeProbability, $shakeRoll);
                if ($shakeRoll < $shakeProbability) {
                    $caught = true;
                }
            }
        }

        if ($caught) {

            $events[] = $this->eventFactory->createCatchSuccessEvent($encounter, $catchRate);

            $currentLocation = $this->findLocation($instanceRow['current_location']);

            $result = $this->catchPokemonCommand->run(
                $encounter->pokemon->number,
                $encounter->pokemon->isShiny,
                $encounter->pokemon->level,
                $encounter->isLegendary,
                $currentLocation['id'],
            );

            if ($result->wasSentToBox()) {
                $events[] = $this->eventFactory->createCaughtPokemonSentToBoxEvent($encounter);
            }

            $bag = $bag->use($pokeballItemId);

            $this->bagRepository->save($bag);

        } else {
            $bag = $bag->use($pokeballItemId);

            $this->bagRepository->save($bag);

            $events[] = $this->eventFactory->createCatchFailureEvent($encounter);
        }

        echo json_encode($events);
    }

    private static function calculateCatchRate(Encounter $encounter, string $pokeBallItemId): float
    {
        $pokemon = $encounter->pokemon;

        $hpFactor = floor((((3 * $pokemon->calculateHp()) - (2 * $pokemon->remainingHp)) * 4096) + 0.5);

        if ($pokemon->level < 13) {
            $levelBonus = max((36 - (2 * $pokemon->level)) / 10, 1);
        } else {
            $levelBonus = 1;
        }

        $ballBonus = match ($pokeBallItemId) {
            ItemId::POKE_BALL  => 1,
            ItemId::GREAT_BALL => 1.5,
            ItemId::ULTRA_BALL => 2,
        };

        $catchRatesConfig = require __DIR__ . "/../../Config/CatchRates.php";

        $speciesRate = 1;

        /** @var array $configEntry */
        foreach ($catchRatesConfig as $configEntry) {
            if ($configEntry['number'] === $pokemon->number) {
                $speciesRate = $configEntry['rate'];
                break;
            }
        }

        $darkGrass = 1;
        $badgePenalty = 1;
        $statusBonus = 1;
        $miscBonus = 1;

        $initialFactor = $hpFactor * $darkGrass * $speciesRate * $ballBonus * $badgePenalty;

        return floor($initialFactor / (3 * $encounter->pokemon->calculateHp())) * $levelBonus * $statusBonus * $miscBonus;
    }

    private static function calculateShakeProbability(float $catchRate): float
    {
        return floor(65536 * ($catchRate / (255 * 4096)));
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
}