<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Repositories;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Habit\Domain\FoodDiary;
use Doctrine\DBAL\Connection;

final class FoodDiaryRepository
{
    public function __construct(
        private readonly Connection $db,
    ) {}

    public function find(): FoodDiary
    {
        $rows = $this->db->fetchAllAssociative("SELECT * FROM log_food_diary WHERE instance_id = :instanceId ORDER BY date_logged DESC", [
            'instanceId' => INSTANCE_ID,
        ]);

        return new FoodDiary(array_map(
            fn(array $row) => CarbonImmutable::createFromFormat("Y-m-d H:i:s", $row['date_logged']),
            $rows
        ));
    }
}
