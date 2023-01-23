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

        return new Bag([
            ItemId::POKE_BALL => new Item(
                ItemId::POKE_BALL,
                $instanceRow['unused_encounters'],
            ),
            ItemId::RARE_CANDY => new Item(
                ItemId::RARE_CANDY,
                $instanceRow['unused_level_ups'],
            ),
            ItemId::CHALLENGE_TOKEN => new Item(
                ItemId::CHALLENGE_TOKEN,
                $instanceRow['unused_moves'],
            ),
        ]);
    }

    public function save(Bag $bag): void
    {
        $update = [];

        /** @var Item $item */
        foreach ($bag->items as $item) {
            if ($item->id === ItemId::POKE_BALL) {
                $update['unused_encounters'] = $item->quantity;

            } elseif ($item->id === ItemId::RARE_CANDY) {
                $update['unused_level_ups'] = $item->quantity;

            } else if ($item->id === ItemId::CHALLENGE_TOKEN) {
                $update['unused_moves'] = $item->quantity;
            }
        }

        $this->db->update("instances", $update, [
            'id' => INSTANCE_ID,
        ]);
    }
}
