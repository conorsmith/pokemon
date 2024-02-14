<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Config;

use DomainException;

final class WildEncounterTableEntry
{
    public static function fromConfig(string $pokedexNumber, array $config): self
    {
        return new self(
            $pokedexNumber,
            $config['form'] ?? null,
            $config['weight'],
            is_array($config['levels'])
                ? $config['levels'][0]
                : $config['levels'],
            is_array($config['levels'])
                ? $config['levels'][1]
                : $config['levels'],
        );
    }

    public function __construct(
        public readonly string $pokedexNumber,
        public readonly ?string $form,
        public readonly int $weight,
        public readonly int $levelsLowerBound,
        public readonly int $levelsUpperBound,
    ) {
        if ($this->weight < 1) {
            throw new DomainException();
        }

        if ($this->levelsLowerBound < 1) {
            throw new DomainException();
        }

        if ($this->levelsUpperBound < 1) {
            throw new DomainException();
        }

        if ($this->levelsUpperBound < $this->levelsLowerBound) {
            throw new DomainException();
        }
    }
}
