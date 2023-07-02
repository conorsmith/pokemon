<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Domain;

enum Habit
{
    case FOOD_DIARY_COMPLETED;
    case CALORIE_GOAL_ATTAINED;
    case EXERCISE;
    case CALORIE_EXCESS;
    case STRETCHES_COMPLETED;
}
