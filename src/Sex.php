<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon;

use JsonSerializable;

enum Sex implements JsonSerializable
{
    case FEMALE;
    case MALE;
    case UNKNOWN;

    public function jsonSerialize(): mixed
    {
        return match($this) {
            self::FEMALE  => "F",
            self::MALE    => "M",
            self::UNKNOWN => "U",
        };
    }
}
