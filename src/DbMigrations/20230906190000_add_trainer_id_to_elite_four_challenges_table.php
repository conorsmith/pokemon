<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddTrainerIdToEliteFourChallengesTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            ALTER TABLE `elite_four_challenges` 
                ADD COLUMN `trainer_id` VARCHAR(36) NULL AFTER `region`
        ");
    }
}
