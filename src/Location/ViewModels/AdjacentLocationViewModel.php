<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\ViewModels;

final class AdjacentLocationViewModel
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly ?string $section,
        public readonly bool $isLocked,
        public readonly ?string $icon,
    ) {}
}
