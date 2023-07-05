<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\ViewModels;

use ConorSmith\Pokemon\Team\Domain\Egg as DomainModel;
use stdClass;

final class Egg
{
    public static function create(DomainModel $egg): self
    {
        $config = require __DIR__ . "/../../Config/Pokedex.php";

        $firstParentConfig = $config[$egg->firstParentPokedexNumber];
        $secondParentConfig = $config[$egg->secondParentPokedexNumber];

        return new self(
            (object) [
                'name' => $firstParentConfig['name'],
                'sex' => $egg->firstParentSex,
            ],
            (object) [
                'name' => $secondParentConfig['name'],
                'sex' => $egg->secondParentSex,
            ],
            $egg->remainingCycles,
        );
    }

    public function __construct(
        public readonly stdClass $firstParent,
        public readonly stdClass $secondParent,
        public readonly int $cycles,
    ) {}
}
