<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Repositories;

use ConorSmith\Pokemon\SharedKernel\Domain\Bag;
use ConorSmith\Pokemon\SharedKernel\Domain\Item;
use ConorSmith\Pokemon\ItemId;
use Doctrine\DBAL\Connection;

final class BagRepository
{
    public function __construct(
        private readonly Connection $db,
    ) {}

    public function find(): Bag
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $itemRows = $this->db->fetchAllAssociative("SELECT * FROM items WHERE instance_id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $items = [
            ItemId::POKE_BALL => new Item(
                ItemId::POKE_BALL,
                0,
            ),
            ItemId::RARE_CANDY => new Item(
                ItemId::RARE_CANDY,
                $instanceRow['unused_level_ups'],
            ),
            ItemId::CHALLENGE_TOKEN => new Item(
                ItemId::CHALLENGE_TOKEN,
                $instanceRow['unused_moves'],
            ),
        ];

        foreach ($itemRows as $itemRow) {
            $items[$itemRow['item_id']] = new Item(
                $itemRow['item_id'],
                $itemRow['quantity'],
            );
        }

        return new Bag($items);
    }

    public function save(Bag $bag): void
    {
        $existingItemRows = $this->db->fetchAllAssociative("SELECT * FROM items WHERE instance_id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $idsOfExistingItems = array_map(
            function (array $row) {
                return $row['item_id'];
            },
            $existingItemRows
        );

        $instanceTableUpdate = [];

        /** @var Item $item */
        foreach ($bag->items as $item) {
            if ($item->id === ItemId::RARE_CANDY) {
                $instanceTableUpdate['unused_level_ups'] = $item->quantity;

            } else if ($item->id === ItemId::CHALLENGE_TOKEN) {
                $instanceTableUpdate['unused_moves'] = $item->quantity;

            } else {
                if (in_array($item->id, $idsOfExistingItems)) {
                    $this->db->update("items", [
                        'quantity' => $item->quantity,
                    ], [
                        'item_id'     => $item->id,
                        'instance_id' => INSTANCE_ID,
                    ]);
                } else {
                    $this->db->insert("items", [
                        'instance_id' => INSTANCE_ID,
                        'item_id'     => $item->id,
                        'quantity'    => $item->quantity,
                    ]);
                }
            }
        }

        $this->db->update("instances", $instanceTableUpdate, [
            'id' => INSTANCE_ID,
        ]);
    }
}
