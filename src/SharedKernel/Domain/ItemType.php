<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Domain;

enum ItemType
{
    case POKE_BALL;
    case EVOLUTION;
    case HELD;
    case STATS;
}
