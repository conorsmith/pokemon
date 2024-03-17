<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Repositories;

use ConorSmith\Pokemon\ItemConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\Bag;
use ConorSmith\Pokemon\SharedKernel\Domain\Item;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemType;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;

final class BagRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly InstanceId $instanceId,
        private readonly ItemConfigRepository $itemConfigRepository,
    ) {}

    public function find(): Bag
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => $this->instanceId->value,
        ]);

        $itemRows = $this->db->fetchAllAssociative("SELECT * FROM items WHERE instance_id = :instanceId", [
            'instanceId' => $this->instanceId->value,
        ]);

        $items = [
            ItemId::POKE_BALL       => new Item(
                ItemId::POKE_BALL,
                0,
                ItemType::POKE_BALL,
            ),
            ItemId::GREAT_BALL      => new Item(
                ItemId::GREAT_BALL,
                0,
                ItemType::POKE_BALL,
            ),
            ItemId::ULTRA_BALL      => new Item(
                ItemId::ULTRA_BALL,
                0,
                ItemType::POKE_BALL,
            ),
            ItemId::RARE_CANDY      => new Item(
                ItemId::RARE_CANDY,
                $instanceRow['unused_level_ups'],
                null,
            ),
            ItemId::CHALLENGE_TOKEN => new Item(
                ItemId::CHALLENGE_TOKEN,
                $instanceRow['unused_moves'],
                null,
            ),
        ];

        foreach ($itemRows as $itemRow) {
            $itemConfig = $this->itemConfigRepository->find($itemRow['item_id']);

            $items[$itemRow['item_id']] = new Item(
                $itemRow['item_id'],
                $itemRow['quantity'],
                $itemConfig['type'] ?? null,
            );
        }

        foreach ($items as $id => $item) {
            if ($item->quantity === 0
                && !in_array($item->id, [ItemId::POKE_BALL, ItemId::RARE_CANDY, ItemId::CHALLENGE_TOKEN])
            ) {
                unset($items[$id]);
            }
        }

        return new Bag($items);
    }

    public function save(Bag $bag): void
    {
        $existingItemRows = $this->db->fetchAllAssociative("SELECT * FROM items WHERE instance_id = :instanceId", [
            'instanceId' => $this->instanceId->value,
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
                        'instance_id' => $this->instanceId->value,
                    ]);
                } else {
                    $this->db->insert("items", [
                        'instance_id' => $this->instanceId->value,
                        'item_id'     => $item->id,
                        'quantity'    => $item->quantity,
                    ]);
                }
            }
        }

        $this->db->update("instances", $instanceTableUpdate, [
            'id' => $this->instanceId->value,
        ]);
    }
}
