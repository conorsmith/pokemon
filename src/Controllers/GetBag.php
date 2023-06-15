<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\ItemConfigRepository;
use ConorSmith\Pokemon\ItemType;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;

final class GetBag
{
    public function __construct(
        private readonly BagRepository $bagRepository,
        private readonly ItemConfigRepository $itemConfigRepository,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(array $args): void
    {
        $bag = $this->bagRepository->find();

        $itemViewModels = [];
        $evolutionItemViewModels = [];
        $heldItemViewModels = [];
        $statsItemViewModels = [];

        foreach ($bag->items as $item) {
            $configEntry = $this->itemConfigRepository->find($item->id);
            $itemViewModel = (object) [
                'id' => $item->id,
                'name' => $configEntry['name'],
                'imageUrl' => $configEntry['imageUrl'],
                'amount' => $item->quantity,
                'hasUse' => array_key_exists('hasUse', $configEntry)
                    && $configEntry['hasUse'],
            ];
            match ($configEntry['type'] ?? null) {
                ItemType::EVOLUTION => $evolutionItemViewModels[] = $itemViewModel,
                ItemType::HELD => $heldItemViewModels[] = $itemViewModel,
                ItemType::STATS => $statsItemViewModels[] = $itemViewModel,
                default => $itemViewModels[] = $itemViewModel,
            };
        }

        echo $this->templateEngine->render(__DIR__ . "/../Templates/Bag.php", [
            'items' => $itemViewModels,
            'evolutionItems' => $evolutionItemViewModels,
            'heldItems' => $heldItemViewModels,
            'statsItems' => $statsItemViewModels,
        ]);
    }
}