<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon;

use Exception;
use Symfony\Component\HttpFoundation\Session\Session;

final class TemplateEngine
{
    public function __construct(
        private readonly Session $session,
    ) {}

    public function render(string $templatePath, array $variables): string
    {
        if (array_key_exists('successes', $variables)
            || array_key_exists('failures', $variables)
            || array_key_exists('instanceId', $variables)
        ) {
            throw new Exception("Reserved template variable given");
        }

        $variables['instanceId'] = "8a04a1fc-f9e9-4feb-98fc-470f90c8fdb1";

        extract($variables);

        $successes = $this->session->getFlashBag()->get("successes");
        $failures = $this->session->getFlashBag()->get("errors");

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
