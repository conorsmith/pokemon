<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Player\Repositories;

use ConorSmith\Pokemon\Player\Domain\PersistentNotification;
use ConorSmith\Pokemon\Player\Domain\TransientNotification;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\FlashBagAwareSessionInterface;

final class NotificationRepositoryDbAndSession implements NotificationRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly FlashBagAwareSessionInterface $session,
        private readonly InstanceId $instanceId,
    ) {}

    public function findLatest(): array
    {
        $rows = $this->db->fetchAllAssociative("SELECT * FROM notifications WHERE is_read = 0 AND instance_id = :instanceId ORDER BY notified_at DESC", [
            'instanceId' => $this->instanceId->value,
        ]);

        $messages = array_map(
            function (array $row) {
                return $row['message'];
            },
            $rows,
        );

        foreach ($rows as $row) {
            $this->db->update("notifications", [
                'is_read' => 1,
            ], [
                'id' => $row['id'],
            ]);
        }

        return array_merge(
            $messages,
            $this->session->getFlashBag()->get("errors"),
        );
    }

    public function savePersistent(PersistentNotification $notification): void
    {
        $this->db->insert("notifications", [
            'id'          => $notification->id,
            'instance_id' => $this->instanceId->value,
            'notified_at' => $notification->notifiedAt->format("Y-m-d H:i:s"),
            'message'     => $notification->message,
            'is_read'     => $notification->isRead ? 1 : 0,
        ]);
    }

    public function saveTransient(TransientNotification $notification): void
    {
        $this->session->getFlashBag()->add(
            "errors",
            $notification->message
        );
    }
}
