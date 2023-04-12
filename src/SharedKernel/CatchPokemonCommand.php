<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel;

interface CatchPokemonCommand
{
    public function run(
        string $number,
        ?string $form,
        bool $isShiny,
        int $level,
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
