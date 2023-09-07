<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Queries;

enum CapturedPokemonQueryProperty
{
    case FORM;
    case SEX;
    case LEVEL;
    case IS_SHINY;
    case FRIENDSHIP;
    case BASE_STATS;
    case IV_STATS;
    case EV_STATS;
}
