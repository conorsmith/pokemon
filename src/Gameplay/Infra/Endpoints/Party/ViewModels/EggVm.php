<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\ViewModels;

use ConorSmith\Pokemon\Gameplay\Domain\Party\Egg;
use ConorSmith\Pokemon\Gameplay\Domain\Party\Pokemon;
use stdClass;

final class EggVm
{
    public static function create(Egg $egg, ?Pokemon $firstParent, ?Pokemon $secondParent): self
    {
        $config = require __DIR__ . "/../../../../../Config/Pokedex.php";

        if (!$egg->hasKnownParents()) {
            $offspringConfig = $config[$egg->pokedexNumber];

            return new self(
                false,
                null,
                null,
                $offspringConfig['name'],
                $egg->remainingCycles,
            );
        }

        $firstParentConfig = $config[$firstParent->number];
        $secondParentConfig = $config[$secondParent->number];

        return new self(
            true,
            (object) [
                'name' => $firstParentConfig['name'],
                'sex'  => $firstParent->sex,
            ],
            (object) [
                'name' => $secondParentConfig['name'],
                'sex'  => $secondParent->sex,
            ],
            null,
            $egg->remainingCycles,
        );
    }

    public function __construct(
        public readonly bool $hasParents,
        public readonly ?stdClass $firstParent,
        public readonly ?stdClass $secondParent,
        public readonly ?string $name,
        public readonly int $cycles,
    ) {}
}
