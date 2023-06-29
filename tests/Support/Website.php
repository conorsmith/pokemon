<?php
declare(strict_types=1);

namespace ConorSmith\PokemonTest\Support;

use ConorSmith\Pokemon\ApplicationFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class Website
{
    public static function get(string $urlPath): Response
    {
        $httpKernel = ApplicationFactory::createHttpKernel();

        return $httpKernel(
            Request::create("/" . Instance::DEFAULT_ID . $urlPath, "GET")
        );
    }

    public static function post(string $urlPath, array $body = []): Response
    {
        $httpKernel = ApplicationFactory::createHttpKernel();

        return $httpKernel(
            Request::create("/" . Instance::DEFAULT_ID . $urlPath, "POST", $body)
        );
    }

    public static function url(string $urlPath): string
    {
        return "/" . Instance::DEFAULT_ID . $urlPath;
    }
}
