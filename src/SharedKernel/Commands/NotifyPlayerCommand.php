<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Commands;

use ConorSmith\Pokemon\SharedKernel\Domain\Notification;

interface NotifyPlayerCommand
{
    public function run(Notification $notification): void;
}
