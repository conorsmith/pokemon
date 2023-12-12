<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\ViewModels;

final class CalendarSquare
{
    public static function empty(): self
    {
        return new self(
            null,
            true,
            false,
            false,
        );
    }

    public function __construct(
        public readonly ?CalendarSquareContents $contents,
        public readonly bool $isEmpty,
        public readonly bool $isHighlighted,
        public readonly bool $isFuture,
    ) {}
}
