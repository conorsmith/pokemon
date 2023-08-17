<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest;

use Prophecy\Prophet;

final class TestDouble
{
    public static function dummy(string $classname): mixed
    {
        return (new Prophet())->prophesize($classname);
    }

    public static function stub(string $classname): mixed
    {
        return (new Prophet())->prophesize($classname);
    }
    public static function mock(string $classname): mixed
    {
        return (new Prophet())->prophesize($classname);
    }
    public static function spy(string $classname): mixed
    {
        return (new Prophet())->prophesize($classname);
    }
}
