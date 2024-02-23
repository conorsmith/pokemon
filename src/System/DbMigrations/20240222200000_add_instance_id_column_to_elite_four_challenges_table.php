<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddInstanceIdColumnToEliteFourChallengesTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            ALTER TABLE `elite_four_challenges` 
                ADD COLUMN `instance_id` VARCHAR(36) NOT NULL AFTER `id`
        ");
    }
}
