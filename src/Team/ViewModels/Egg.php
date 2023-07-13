<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\ViewModels;

use ConorSmith\Pokemon\Team\Domain\Egg as EggModel;
use ConorSmith\Pokemon\Team\Domain\Pokemon as PokemonModel;
use stdClass;

final class Egg
{
    public static function create(EggModel $egg, PokemonModel $firstParent, PokemonModel $secondParent): self
    {
        $config = require __DIR__ . "/../../Config/Pokedex.php";

        $firstParentConfig = $config[$firstParent->number];
        $secondParentConfig = $config[$secondParent->number];

        return new self(
            (object) [
                'name' => $firstParentConfig['name'],
                'sex' => $firstParent->sex,
            ],
            (object) [
                'name' => $secondParentConfig['name'],
                'sex' => $secondParent->sex,
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
