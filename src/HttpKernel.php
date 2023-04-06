<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

final class HttpKernel
{
    public function __construct(
        private readonly ControllerFactory $controllerFactory,
        private readonly GameModeMiddleware $gameModeMiddleware,
    ) {}

    public function __invoke(): void
    {
        $dispatcher = simpleDispatcher(function(RouteCollector $r) {
            ControllerFactory::routes($r);
        });

        parse_str(parse_url($_SERVER['REQUEST_URI'])['query'] ?? "", $_GET);

        $routeInfo = $dispatcher->dispatch(
            $_SERVER['REQUEST_METHOD'],
            parse_url($_SERVER['REQUEST_URI'])['path']
        );

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
            case Dispatcher::METHOD_NOT_ALLOWED:
                echo "Page Not Found";
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                $activated = $this->gameModeMiddleware->__invoke($handler);

                if (!$activated) {
                    $this->controllerFactory->create($handler)($vars);
                }

                break;
        }

    }
}