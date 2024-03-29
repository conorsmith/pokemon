<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Party;

use stdClass;

interface PokemonRepository
{
    public function find(string $id): ?Pokemon;
    public function getParty(): Party;
    public function getDayCare(): DayCare;
    public function getBox(): array;
    public function getAll(stdClass $query): array;
    public function findAllInEggGroups(EggGroups $eggGroups): array;
    public function saveParty(Party $party): void;
    public function saveDayCare(DayCare $dayCare): void;
    public function savePokemon(Pokemon $pokemon): void;
    public function save(Pokemon $pokemon): void;
}
