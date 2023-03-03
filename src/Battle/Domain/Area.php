<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

final class Area
{
    public function __construct(
        public readonly string $id,
        public readonly array $trainers,
    ) {}

    public function isOnlyUnbeatenTrainer(Trainer $unbeatenTrainer): bool
    {
        /** @var Trainer $areaTrainer */
        foreach ($this->trainers as $areaTrainer) {
            if ($areaTrainer->id !== $unbeatenTrainer->id
                && $areaTrainer->dateLastBeaten === null
            ) {
                return false;
            }
        }

        return true;
    }

    public function getClearancePrizes(): array
    {
        $areaConfigEntries = require __DIR__ . "/../../Config/Areas.php";

        $areaConfig = $areaConfigEntries[$this->id];

        return $areaConfig['prizes'];
    }
}
