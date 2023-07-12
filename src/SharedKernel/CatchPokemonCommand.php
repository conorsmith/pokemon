<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel;

use ConorSmith\Pokemon\Sex;

interface CatchPokemonCommand
{
    public function run(
        string $number,
        ?string $form,
        int $level,
        Sex $sex,
        bool $isShiny,
        bool $isLegendary,
        int $ivHp,
        int $ivPhysicalAttack,
        int $ivPhysicalDefence,
        int $ivSpecialAttack,
        int $ivSpecialDefence,
        int $ivSpeed,
        string $caughtLocationId,
    ): CatchPokemonResult;
}
