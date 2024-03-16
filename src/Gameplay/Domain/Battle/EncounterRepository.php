<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Battle;

interface EncounterRepository
{
    public function generateWildEncounter(Location $location, string $encounterType): Encounter;

    public function generateFixedEncounter(Location $location, string $number): Encounter;

    public function find(string $id): ?Encounter;

    public function save(Encounter $encounter): void;

    public function delete(Encounter $encounter): void;

    public function deleteOldestEncountersOutsideLimit(): void;
}
