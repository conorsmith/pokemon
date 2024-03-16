<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon;

use ConorSmith\Pokemon\Gameplay\Domain\Notifications\NotificationRepository;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Exception;

final class TemplateEngine
{
    public function __construct(
        private readonly NotificationRepository $notificationRepository,
        private readonly InstanceId $instanceId,
    ) {}

    public function render(string $templatePath, array $variables): string
    {
        if (array_key_exists('notifications', $variables)
            || array_key_exists('instanceId', $variables)
        ) {
            throw new Exception("Reserved template variable given");
        }

        $variables['instanceId'] = $this->instanceId->value;

        extract($variables);

        $notifications = $this->notificationRepository->findLatest();

        $content = self::renderContent($templatePath, $variables);

        ob_start();

        require __DIR__ . "/Templates/Layout.php";

        return ob_get_clean();
    }

    private static function renderContent(string $templatePath, array $variables): string
    {
        extract($variables);

        ob_start();

        require $templatePath;

        return ob_get_clean();
    }
}
