<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon;

final class TemplateEngine
{
    public static function render(string $templatePath, array $variables): string
    {
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
