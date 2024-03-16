<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Bag\Controllers;

use ConorSmith\Pokemon\ItemConfigRepository;
use ConorSmith\Pokemon\SharedKernel\ViewModels\BagItemGiveActionVm;
use ConorSmith\Pokemon\SharedKernel\ViewModels\BagItemUseActionVm;
use ConorSmith\Pokemon\SharedKernel\ViewModels\BagItemVm;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemType;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetBag
{
    public function __construct(
        private readonly BagRepository $bagRepository,
        private readonly ItemConfigRepository $itemConfigRepository,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $instanceId = $args['instanceId'];

        $bag = $this->bagRepository->find();

        $itemViewModels = [];
        $evolutionItemViewModels = [];
        $heldItemViewModels = [];
        $statsItemViewModels = [];

        foreach ($bag->items as $item) {
            $configEntry = $this->itemConfigRepository->find($item->id);

            $itemViewModel = new BagItemVm(
                $item->id,
                $configEntry['name'],
                $configEntry['imageUrl'],
                strval($item->quantity),
                array_key_exists('hasUse', $configEntry)
                    && $configEntry['hasUse'],
                new BagItemUseActionVm(
                    "/{$instanceId}/item/{$item->id}/use",
                    [
                        'redirectUrlPath' => "/{$instanceId}/party/use/{$item->id}",
                    ],
                ),
                isset($configEntry['type']) && $configEntry['type'] === ItemType::HELD,
                new BagItemGiveActionVm(
                    "/{$instanceId}/item/{$item->id}/give",
                    [
                        'redirectUrlPath' => "/{$instanceId}/party/give/{$item->id}",
                    ],
                ),
            );

            match ($configEntry['type'] ?? null) {
                ItemType::EVOLUTION => $evolutionItemViewModels[] = $itemViewModel,
                ItemType::HELD      => $heldItemViewModels[] = $itemViewModel,
                ItemType::STATS     => $statsItemViewModels[] = $itemViewModel,
                default             => $itemViewModels[] = $itemViewModel,
            };
        }

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/Bag.php", [
            'items'          => $itemViewModels,
            'evolutionItems' => $evolutionItemViewModels,
            'heldItems'      => $heldItemViewModels,
            'statsItems'     => $statsItemViewModels,
        ]));
    }
}