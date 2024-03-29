<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Battle;

use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;

final class Area
{
    private const DEFAULT_PRIZES = [
        ItemId::BLACK_BELT,
        ItemId::BLACK_GLASSES,
        ItemId::CHARCOAL,
        ItemId::DRAGON_FANG,
        ItemId::HARD_STONE,
        ItemId::MAGNET,
        ItemId::METAL_COAT,
        ItemId::MIRACLE_SEED,
        ItemId::MYSTIC_WATER,
        ItemId::NEVER_MELT_ICE,
        ItemId::POISON_BARB,
        ItemId::SHARP_BEAK,
        ItemId::SILK_SCARF,
        ItemId::SILVER_POWDER,
        ItemId::SOFT_SAND,
        ItemId::SPELL_TAG,
        ItemId::TWISTED_SPOON,
        ItemId::FAIRY_FEATHER,
    ];

    public function __construct(
        public readonly string $id,
        public readonly array $trainers,
        public readonly array $battles,
    ) {}

    public function isOnlyUnbeatenTrainer(string $trainerId): bool
    {
        if (count($this->battles) === 0) {
            return false;
        }

        /** @var ?Battle $areaBattle */
        foreach ($this->battles as $areaBattle) {
            if (is_null($areaBattle)) {
                return false;
            }
            if ($areaBattle->trainerId !== $trainerId
                && $areaBattle->dateLastBeaten === null
            ) {
                return false;
            }
        }

        return true;
    }

    public function getClearancePrizes(): array
    {
        $areaConfigEntries = require __DIR__ . "/../../../Config/Areas.php";

        if (!array_key_exists($this->id, $areaConfigEntries)) {
            $hash = crc32($this->id);
            $index = $hash % count(self::DEFAULT_PRIZES);
            return [self::DEFAULT_PRIZES[$index]];
        }

        $areaConfig = $areaConfigEntries[$this->id];

        return $areaConfig['prizes'];
    }
}
