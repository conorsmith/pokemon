<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Party;

interface FriendshipEventLogRepository
{
    public function calculate(string $pokemonId, string $pokedexNumber): int;

    public function sentToBox(Pokemon $pokemon): void;

    public function sentToParty(Pokemon $pokemon): void;

    public function sentToDayCare(Pokemon $pokemon): void;

    public function levelUp(Pokemon $pokemon): void;

    public function fainted(string $pokemonId): void;

    public function faintedToPowerfulOpponent(string $pokemonId): void;

    public function battleWithGymLeader(string $pokemonId): void;
}
