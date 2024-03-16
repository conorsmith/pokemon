<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Notifications;

use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use LogicException;

final class TransientNotification
{
    public static function fromNotification(Notification $notification): self
    {
        if ($notification->isPersistent()) {
            throw new LogicException();
        }

        return new self(
            $notification->message,
        );
    }

    public function __construct(
        public readonly string $message,
    ) {}
}
