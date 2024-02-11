<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Player\Controllers;

use ConorSmith\Pokemon\Player\Domain\PersistentNotification;
use ConorSmith\Pokemon\Player\Repositories\NotificationRepository;
use ConorSmith\Pokemon\TemplateEngine;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetNotifications
{
    public function __construct(
        private readonly NotificationRepository $notificationRepository,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $notifications = $this->notificationRepository->findAllPersistent();

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/Notifications.php", [
            'archivedNotifications' => array_map(
                fn (PersistentNotification $notification) => (object) [
                    'date'    => $notification->notifiedAt->format("Y-m-d"),
                    'time'    => $notification->notifiedAt->format("H:i"),
                    'message' => $notification->message,
                ],
                $notifications,
            )
        ]));
    }
}
