<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateParentalRelationshipsTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            CREATE TABLE `parental_relationships` (
              `subject_id` VARCHAR(36) NOT NULL,
              `instance_id` VARCHAR(36) NOT NULL,
              `first_parent_id` VARCHAR(36) NOT NULL,
              `second_parent_id` VARCHAR(36) NOT NULL,
              `date_born` DATETIME NOT NULL,
              PRIMARY KEY (`subject_id`));
        ");
    }
}
