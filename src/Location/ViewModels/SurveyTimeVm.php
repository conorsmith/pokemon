<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\ViewModels;

final class SurveyTimeVm
{
    public static function fromDomain(int $seconds): self
    {
        $minutes = intval(floor($seconds / 60));
        $seconds = $seconds % 60;

        $hours = intval(floor($minutes / 60));
        $minutes = $minutes % 60;

        $days = intval(floor($hours / 24));
        $hours = $hours % 24;

        return new self(
            $days > 0,
            strval($days),
            $hours > 0,
            strval($hours),
            $minutes > 0,
            str_pad(strval($minutes), 2, "0", STR_PAD_LEFT),
            $seconds > 0,
            str_pad(strval($seconds), 2, "0", STR_PAD_LEFT),
        );
    }

    public function __construct(
        public readonly bool $hasDays,
        public readonly string $days,
        public readonly bool $hasHours,
        public readonly string $hours,
        public readonly bool $hasMinutes,
        public readonly string $minutes,
        public readonly bool $hasSeconds,
        public readonly string $seconds,
    ) {}
}
