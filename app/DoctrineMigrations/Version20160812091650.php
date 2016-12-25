<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160812091650 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE original_price_list CHANGE price price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE ready_price_list CHANGE price price DOUBLE PRECISION NOT NULL, CHANGE originalPriceList_id originalPriceList_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ready_price_list ADD CONSTRAINT FK_92E90883F73AE9E8 FOREIGN KEY (originalPriceList_id) REFERENCES original_price_list (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE supplier CHANGE exchange_rate exchange_rate DOUBLE PRECISION DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE original_price_list CHANGE price price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE ready_price_list DROP FOREIGN KEY FK_92E90883F73AE9E8');
        $this->addSql('ALTER TABLE ready_price_list CHANGE price price DOUBLE PRECISION NOT NULL, CHANGE originalPriceList_id originalPriceList_id INT NOT NULL');
        $this->addSql('ALTER TABLE supplier CHANGE exchange_rate exchange_rate DOUBLE PRECISION DEFAULT NULL');
    }
}
