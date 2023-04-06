<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;

final class GetBag
{
    public function __construct(
        private readonly BagRepository $bagRepository,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(array $args): void
    {
        $bag = $this->bagRepository->find();

        $itemConfig = require __DIR__ . "/../Config/Items.php";

        $itemViewModels = [];

        foreach ($bag->items as $item) {
            $itemViewModels[] = (object) [
                'id' => $item->id,
                'name' => $itemConfig[$item->id]['name'],
                'imageUrl' => $itemConfig[$item->id]['imageUrl'],
                'amount' => $item->quantity,
                'hasUse' => array_key_exists('hasUse', $itemConfig[$item->id])
                    && $itemConfig[$item->id]['hasUse'],
            ];
        }

        echo $this->templateEngine->render(__DIR__ . "/../Templates/Bag.php", [
            'items' => $itemViewModels,
        ]);
    }
}