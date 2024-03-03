<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Commands;

use ConorSmith\Pokemon\SharedKernel\Domain\Sex;

interface CatchPokemonCommand
{
    public function run(
        string $number,
        ?string $form,
        int $level,
        Sex $sex,
        bool $isShiny,
        ?string $fixedEncounterId,
        int $ivHp,
        int $ivPhysicalAttack,
        int $ivPhysicalDefence,
        int $ivSpecialAttack,
        int $ivSpecialDefence,
        int $ivSpeed,
        string $caughtLocationId,
    ): CatchPokemonResult;
}
