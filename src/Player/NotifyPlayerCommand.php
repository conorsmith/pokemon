<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Player;

use ConorSmith\Pokemon\Player\Domain\PersistentNotification;
use ConorSmith\Pokemon\Player\Domain\TransientNotification;
use ConorSmith\Pokemon\Player\Repositories\NotificationRepository;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand as NotifyPlayerCommandInterface;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;

final class NotifyPlayerCommand implements NotifyPlayerCommandInterface
{
    public function __construct(
        private readonly NotificationRepository $notificationRepository,
    ) {}

    public function run(Notification $notification): void
    {

        if ($notification->isPersistent()) {
            $this->notificationRepository->savePersistent(
                PersistentNotification::fromNotification($notification)
            );
        } else {
            $this->notificationRepository->saveTransient(
                TransientNotification::fromNotification($notification)
            );
        }
    }
}
