<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Domain;

final class SurveyResult
{
    public function __construct(
        public readonly string $pokedexNumber,
        public readonly ?string $form,
        public readonly int $sightings,
    ) {}

    public function addSighting(): self
    {
        return new self(
            $this->pokedexNumber,
            $this->form,
            $this->sightings + 1,
        );
    }
}
