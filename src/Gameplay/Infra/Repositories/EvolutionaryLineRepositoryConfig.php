<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Repositories;

use ConorSmith\Pokemon\Gameplay\Domain\Evolution\EvolutionaryLine;
use ConorSmith\Pokemon\Gameplay\Domain\Evolution\EvolutionaryLineRepository;
use ConorSmith\Pokemon\PokedexConfigRepository;

final class EvolutionaryLineRepositoryConfig implements EvolutionaryLineRepository
{
    public function __construct(
        private readonly PokedexConfigRepository $pokedexConfigRepository,
    ) {}

    public function find(string $pokedexNumber): EvolutionaryLine
    {
        return $this->mergeAncestorsAndDescendants(
            $this->findAncestors($pokedexNumber),
            $this->findDescendants($pokedexNumber),
        );
    }

    private function mergeAncestorsAndDescendants(array $ancestors, array $descendants): EvolutionaryLine
    {
        $ancestors = array_reverse($ancestors);

        foreach ($ancestors as $ancestorPokedexNumber) {
            $descendants = [
                'pokedexNumber' => $ancestorPokedexNumber,
                'descendants'   => [$descendants],
            ];
        }

        return new EvolutionaryLine($descendants);
    }

    private function findAncestors(string $pokedexNumber): array
    {
        $candidates = [];

        while (!is_null($pokedexNumber)) {
            $pokedexNumber = $this->findPreviousStageOfEvolutionaryLine($pokedexNumber);
            if (!is_null($pokedexNumber)) {
                $candidates[] = $pokedexNumber;
            }
        }

        return array_reverse($candidates);
    }

    private function findPreviousStageOfEvolutionaryLine(string $pokedexNumber): ?string
    {
        foreach ($this->pokedexConfigRepository->all() as $previousStagePokedexNumber => $entry) {
            if (!isset($entry['evolutions'])) {
                continue;
            }

            foreach ($entry['evolutions'] as $evolutionPokedexNumber => $evolutionConfig) {
                if (strval($evolutionPokedexNumber) === $pokedexNumber) {
                    return strval($previousStagePokedexNumber);
                }
            }
        }

        return null;
    }

    private function findDescendants(string $pokedexNumber): array
    {
        $entry = $this->pokedexConfigRepository->find($pokedexNumber);

        if (!isset($entry['evolutions'])) {
            return [
                'pokedexNumber' => $pokedexNumber,
                'descendants'   => [],
            ];
        }

        $descendants = [];

        foreach ($entry['evolutions'] as $descendantPokedexNumber => $evolutionConfig) {
            $descendants[] = $this->findDescendants(strval($descendantPokedexNumber));
        }

        return [
            'pokedexNumber' => $pokedexNumber,
            'descendants'   => $descendants,
        ];
    }
}
