<?php declare(strict_types=1);

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211016041045 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $createTableUsage = <<<SQL

        CREATE TABLE usage (
        uuid NVARCHAR(36) NOT NULL,
        user_profile_uuid NVARCHAR(36) NOT NULL,
        customer_uuid NVARCHAR(36) NOT NULL,
        usage_id NVARCHAR(36) NULL,
        path NVARCHAR(255) NULL,
        month INT NULL,
        year INT NULL,
        last_stand_meter INT NULL,
        current_meter INT NULL,
        usage INT NULL,
        created_at DATETIME2 NOT NULL,
        updated_at DATETIME2 NULL,
        deleted_at DATETIME2 NULL,
        PRIMARY KEY (uuid),
        INDEX usage_user_profile_idx (user_profile_uuid ASC),
        INDEX usage_customer_idx (customer_uuid ASC),
        CONSTRAINT fk_usage_user_profile
            FOREIGN KEY (user_profile_uuid)
            REFERENCES user_profile (uuid)
            ON DELETE CASCADE
            ON UPDATE CASCADE,
        CONSTRAINT fk_usage_customer
            FOREIGN KEY (customer_uuid)
            REFERENCES customer (uuid)
            ON DELETE CASCADE
            ON UPDATE CASCADE);

SQL;    
        $this->addsql($createTableUsage);
    }

    public function down(Schema $schema) : void
    {
        $dropTableUsage =<<<SQL
        DROP TABLE usage;
SQL;
        $this->addsql($dropTableUsage);
    }
}
