<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Domain;

enum EntryType: string
{
    case SHORT_WALK = "short-walk";
    case LONG_WALK = "long-walk";
    case RUN = "run";
}
