<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160810112647 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE original_price_list CHANGE price price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE ready_price_list CHANGE price price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE supplier CHANGE exchange_rate exchange_rate DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE vendor_code_ruler ADD supplier_id INT NOT NULL');
        $this->addSql('ALTER TABLE vendor_code_ruler ADD CONSTRAINT FK_88BD64812ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('CREATE INDEX IDX_88BD64812ADD6D8C ON vendor_code_ruler (supplier_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE original_price_list CHANGE price price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE ready_price_list CHANGE price price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE supplier CHANGE exchange_rate exchange_rate DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE vendor_code_ruler DROP FOREIGN KEY FK_88BD64812ADD6D8C');
        $this->addSql('DROP INDEX IDX_88BD64812ADD6D8C ON vendor_code_ruler');
        $this->addSql('ALTER TABLE vendor_code_ruler DROP supplier_id');
    }
}