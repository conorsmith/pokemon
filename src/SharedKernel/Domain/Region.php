<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Domain;

enum Region: string
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
}
