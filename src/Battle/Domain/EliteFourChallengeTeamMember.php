<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

final class EliteFourChallengeTeamMember
{
    public function __construct(
        public readonly string $id,
        public readonly string $pokedexNumber,
        public readonly ?string $form,
        public readonly int $level,
    ) {}
}
