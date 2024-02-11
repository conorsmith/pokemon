<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Player\Repositories;

use ConorSmith\Pokemon\Player\Domain\PersistentNotification;
use ConorSmith\Pokemon\Player\Domain\TransientNotification;

interface NotificationRepository
{
    public function findLatest(): array;
    public function findAllPersistent(): array;
    public function savePersistent(PersistentNotification $notification): void;
    public function saveTransient(TransientNotification $notification): void;
}
