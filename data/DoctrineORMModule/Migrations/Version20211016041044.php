<?php declare(strict_types=1);

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211016041044 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $createTableCustomer = <<<SQL

        CREATE TABLE customer (
        uuid NVARCHAR(36) NOT NULL,
        first_name NVARCHAR(36) NOT NULL,
        last_name NVARCHAR(36) NULL DEFAULT NULL,
        email NVARCHAR(128) NULL DEFAULT NULL,
        address NVARCHAR(128) NULL DEFAULT NULL,
        postal_code NVARCHAR(5) NULL DEFAULT NULL,
        is_active TINYINT NULL DEFAULT 1,
        customer_id NVARCHAR(20) NULL,
        water_meter_id NVARCHAR(20) NULL,
        last_stand_meter INT NULL,
        last_stand_meter_update DATETIME2 NULL,
        created_at DATETIME2 NOT NULL,
        updated_at DATETIME2 NULL,
        deleted_at DATETIME2 NULL,
        PRIMARY KEY (uuid));

SQL;    
        $this->addsql($createTableCustomer);
    }

    public function down(Schema $schema) : void
    {
        $dropTableCustomer =<<<SQL
        DROP TABLE customer;
SQL;
        $this->addsql($dropTableCustomer);
    }
}
