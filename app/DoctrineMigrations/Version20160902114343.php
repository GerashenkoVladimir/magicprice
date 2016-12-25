<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160902114343 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE original_price_list CHANGE price price DOUBLE PRECISION NOT NULL');
        $this->addSql('DROP INDEX UNIQ_399A0AA25E237E06 ON price_list');
        $this->addSql('DROP INDEX UNIQ_399A0AA277153098 ON price_list');
        $this->addSql('ALTER TABLE ready_price_list CHANGE price price DOUBLE PRECISION NOT NULL');
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
        $this->addSql('CREATE UNIQUE INDEX UNIQ_399A0AA25E237E06 ON price_list (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_399A0AA277153098 ON price_list (code)');
        $this->addSql('ALTER TABLE ready_price_list CHANGE price price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE supplier CHANGE exchange_rate exchange_rate DOUBLE PRECISION DEFAULT NULL');
    }
}
