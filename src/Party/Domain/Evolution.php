<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Domain;

use ConorSmith\Pokemon\ItemConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Clock;
use ConorSmith\Pokemon\SharedKernel\Domain\PokemonType;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use LogicException;

final class Evolution
{
    public function __construct(
        public readonly string $evolvedPokedexNumber,
        private readonly ?int $minimumLevel,
        private readonly bool $minimumFriendship,
        private readonly ?string $specificTime,
        private readonly ?string $stats,
        private readonly bool $randomly,
        private readonly string|int|null $move,
    ) {}

    public function isTriggered(Pokemon $pokemon, int $level): bool
    {
        $requirements = [];

        if (!is_null($this->minimumLevel)) {
            $regionalLevelOffset = match ($pokemon->caughtLocation->region) {
                RegionId::KANTO => 0,
                RegionId::JOHTO => 50,
                RegionId::HOENN => 100,
                default         => throw new LogicException(),
            };

            $requirements[] = $this->minimumLevel + $regionalLevelOffset <= $level;
        }

        if ($this->minimumFriendship) {
            $requirements[] = $pokemon->friendship >= 220;
        }

        if (!is_null($this->specificTime)) {

            $clock = new Clock();

            $requirements[] = match ($this->specificTime) {
                "day"   => $clock->isDay(),
                "night" => $clock->isNight(),
                default => throw new LogicException(),
            };
        }

        if (!is_null($this->stats)) {
            $requirements[] = match ($this->stats) {
                "Physical Attack > Physical Defence" => $pokemon->physicalAttack->calculate($pokemon->level) > $pokemon->physicalDefence->calculate($pokemon->level),
                "Physical Attack < Physical Defence" => $pokemon->physicalAttack->calculate($pokemon->level) < $pokemon->physicalDefence->calculate($pokemon->level),
                "Physical Attack = Physical Defence" => $pokemon->physicalAttack->calculate($pokemon->level) === $pokemon->physicalDefence->calculate($pokemon->level),
                default                              => throw new LogicException(),
            };
        }

        if (!is_null($this->move)) {
            $requirements[] = self::pokemonIsHoldingItemWithSameTypeAsMove($pokemon, $this->move);
        }

        if (count($requirements) === 0) {
            return false;
        }

        return array_reduce(
            $requirements,
            fn(bool $requirement, bool $carry) => $requirement && $carry,
            true
        );
    }

    public function isRandom(): bool
    {
        return $this->randomly;
    }

    private static function pokemonIsHoldingItemWithSameTypeAsMove(Pokemon $pokemon, string|int $move): bool
    {
        if (!$pokemon->isHoldingAnItem()) {
            return false;
        }

        $itemConfigRepository = new ItemConfigRepository();

        $moveType = match ($move) {
            "Rage Fist"        => PokemonType::FIGHTING,
            "Rollout"          => PokemonType::ROCK,
            "Ancient Power"    => PokemonType::ROCK,
            "Double Hit"       => PokemonType::NORMAL,
            "Twin Beam"        => PokemonType::PSYCHIC,
            "Hyper Drill"      => PokemonType::NORMAL,
            "Psyshield Bash"   => PokemonType::PSYCHIC,
            PokemonType::FAIRY => PokemonType::FAIRY,
        };

        $itemConfig = $itemConfigRepository->find($pokemon->heldItemId);

        return $itemConfig['effect']['typeEnhance'] === $moveType;
    }
}