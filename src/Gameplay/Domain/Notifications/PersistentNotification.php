<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Notifications;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use LogicException;
use Ramsey\Uuid\Uuid;

final class PersistentNotification
{
    public static function fromNotification(Notification $notification): self
    {
        if (!$notification->isPersistent()) {
            throw new LogicException();
        }

        return new self(
            Uuid::uuid4()->toString(),
            CarbonImmutable::now("Europe/Dublin"),
            $notification->message,
            false,
        );
    }

    public function __construct(
        public readonly string $id,
        public readonly CarbonImmutable $notifiedAt,
        public readonly string $message,
        public readonly bool $isRead,
    ) {}
}
