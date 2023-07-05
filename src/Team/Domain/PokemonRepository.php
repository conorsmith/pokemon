<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Domain;

use stdClass;

interface PokemonRepository
{
    public function find(string $id): ?Pokemon;
    public function getTeam(): Team;
    public function getDayCare(): DayCare;
    public function getBox(): array;
    public function getAll(stdClass $query): array;
    public function saveTeam(Team $team): void;
    public function saveDayCare(DayCare $dayCare): void;
    public function savePokemon(Pokemon $pokemon): void;
    public function save(Pokemon $pokemon): void;
}
