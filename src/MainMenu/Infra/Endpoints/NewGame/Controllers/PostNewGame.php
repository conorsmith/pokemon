<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\MainMenu\Infra\Endpoints\NewGame\Controllers;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\MainMenu\Domain\Instance;
use ConorSmith\Pokemon\MainMenu\Domain\InstanceRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\LocationId;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostNewGame
{
    public function __construct(
        private readonly InstanceRepository $instanceRepository,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $instance = new Instance(
            new InstanceId(Uuid::uuid4()->toString()),
            CarbonImmutable::now("Europe/Dublin"),
            LocationId::PALLET_TOWN,
        );

        $this->instanceRepository->save($instance);

        return new RedirectResponse("/{$instance->id->value}/");
    }
}
