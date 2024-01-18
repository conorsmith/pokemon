<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\ViewModels;

use ConorSmith\Pokemon\Battle\Domain\Attack;
use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\TypeEffectiveness as DomainModel;
use LogicException;

final class TypeEffectiveness
{
    public static function create(string $typeOrdinal, Pokemon $player, Pokemon $opponent): self
    {
        $typeEffectiveness = DomainModel::calculate(
            new Attack("physical", $typeOrdinal),
            $player,
            $opponent,
        );

        $contextClass = "bg-secondary";

        if ($typeEffectiveness === 0.0) {
            $contextClass = "bg-dark";
        } elseif ($typeEffectiveness < 1.0) {
            $contextClass = "bg-danger";
        } elseif ($typeEffectiveness > 1.0) {
            $contextClass = "bg-primary";
        }

        return new self(
            $typeEffectiveness !== 1.0,
            $contextClass,
            match ($typeEffectiveness) {
                4.0  => "4",
                2.0  => "2",
                0.5  => "½",
                1.0  => "1",
                0.25 => "¼",
                0.0  => "0",
                default => throw new LogicException("Invalid value {$typeEffectiveness}"),
            },
        );
    }

    public function __construct(
        public readonly bool $isDisplayed,
        public readonly string $contextClass,
        public readonly string $value,
    ) {}
}
