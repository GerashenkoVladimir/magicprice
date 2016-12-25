<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160806133415 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE original_price_list CHANGE price price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE price_list ADD file_path VARCHAR(128) NOT NULL');
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
        $this->addSql('ALTER TABLE price_list DROP file_path');
        $this->addSql('ALTER TABLE supplier CHANGE exchange_rate exchange_rate DOUBLE PRECISION DEFAULT NULL');
    }
}
