<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon;

use ConorSmith\Pokemon\SharedKernel\InstanceId;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use function FastRoute\simpleDispatcher;

final class HttpKernel
{
    public function __construct(
        private readonly ControllerFactory $controllerFactory,
        private readonly GameModeMiddleware $gameModeMiddleware,
    ) {}

    public function __invoke(Request $request): Response
    {
        $dispatcher = simpleDispatcher(function(RouteCollector $r) {
            ControllerFactory::routes($r);
        });

        if ($request->getPathInfo() === "/") {
            return new RedirectResponse("/8a04a1fc-f9e9-4feb-98fc-470f90c8fdb1/");
        }

        $instanceId = substr($request->getPathInfo(), 1, 36);
        $effectivePath = substr($request->getPathInfo(), 37);

        $routeInfo = $dispatcher->dispatch(
            $request->getMethod(),
            $effectivePath
        );

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
            case Dispatcher::METHOD_NOT_ALLOWED:
                return new Response("Page Not Found", 404);

            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                $vars['instanceId'] = $instanceId;

                $activated = $this->gameModeMiddleware->__invoke($handler, new InstanceId($instanceId));

                if ($activated) {
                    return $activated;
                }

                $controller = $this->controllerFactory->create($handler, new InstanceId($instanceId));

                return $controller($request, $vars);
        }

        return new Response("Server Error", 500);
    }
}