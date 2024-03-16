<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Battle;

final class EliteFourChallengePartyMember
{
    public function __construct(
        public readonly string $id,
        public readonly string $pokedexNumber,
        public readonly ?string $form,
        public readonly int $level,
    ) {}
}
