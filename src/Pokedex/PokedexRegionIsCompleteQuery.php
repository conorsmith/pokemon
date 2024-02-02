<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Pokedex;

use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\SharedKernel\PokedexRegionIsCompleteQuery as QueryInterface;
use Doctrine\DBAL\Connection;

final class PokedexRegionIsCompleteQuery implements QueryInterface
{
    public function __construct(
        private readonly Connection $db,
        private readonly InstanceId $instanceId,
    ) {}

    public function run(RegionId $regionId): bool
    {
        $pokedexRegionRanges = match ($regionId) {
            RegionId::KANTO  => [1, 150],
            RegionId::JOHTO  => [152, 250],
            RegionId::HOENN  => [252, 384],
            RegionId::SINNOH => [387, 488],
            RegionId::UNOVA  => [495, 646],
            RegionId::KALOS  => [650, 718],
            RegionId::ALOLA  => [[722, 800], [803, 806]],
            RegionId::GALAR  => [[810, 892], [894, 905]],
            RegionId::PALDEA => [906, 1010],
        };

        if (is_integer($pokedexRegionRanges[0])) {
            $pokedexRegionRanges = [$pokedexRegionRanges];
        }

        $requiredPokedexNumbers = [];

        foreach ($pokedexRegionRanges as $range) {
            $requiredPokedexNumbers = array_merge($requiredPokedexNumbers, range($range[0], $range[1]));
        }

        $rows = $this->db->fetchAllAssociative("SELECT * FROM pokedex_entries WHERE instance_id = :instanceId", [
            'instanceId' => $this->instanceId->value,
        ]);

        $registeredPokedexNumbers = array_map(
            fn(array $row) => $row['number'],
            $rows,
        );

        $missingPokedexNumbers = array_diff($requiredPokedexNumbers, $registeredPokedexNumbers);

        return count($missingPokedexNumbers) === 0;
    }
}
