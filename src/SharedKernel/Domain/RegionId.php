<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Domain;

enum RegionId: string
{
    case KANTO = "KANTO";
    case JOHTO = "JOHTO";
    case HOENN = "HOENN";
    case SINNOH = "SINNOH";
    case UNOVA = "UNOVA";
    case KALOS = "KALOS";
    case ALOLA = "ALOLA";
    case GALAR = "GALAR";
    case PALDEA = "PALDEA";

    public static function all(): array
    {
        return [
            self::KANTO,
            self::JOHTO,
            self::HOENN,
            self::SINNOH,
            self::UNOVA,
            self::KALOS,
            self::ALOLA,
            self::GALAR,
            self::PALDEA,
        ];
    }
}
