<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\TemplateEngine;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;

final class GetBag
{
    public function __construct(
        private readonly Connection $db,
    ) {}

    public function __invoke(array $args): void
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $rows = [
            [
                'id' => Uuid::uuid4(),
                'item_id' => ItemId::POKE_BALL,
                'amount' => $instanceRow['unused_encounters'],
            ],
            [
                'id' => Uuid::uuid4(),
                'item_id' => ItemId::RARE_CANDY,
                'amount' => $instanceRow['unused_level_ups'],
            ],
            [
                'id' => Uuid::uuid4(),
                'item_id' => ItemId::CHALLENGE_TOKEN,
                'amount' => $instanceRow['unused_moves'],
            ],
        ];

        $itemConfig = require __DIR__ . "/../Config/Items.php";

        $itemViewModels = [];

        foreach ($rows as $row) {
            $itemViewModels[] = (object) [
                'id' => $row['id'],
                'name' => $itemConfig[$row['item_id']]['name'],
                'imageUrl' => $itemConfig[$row['item_id']]['imageUrl'],
                'amount' => $row['amount'],
            ];
        }

        echo TemplateEngine::render(__DIR__ . "/../Templates/Bag.php", [
            'items' => $itemViewModels,
        ]);
    }
}