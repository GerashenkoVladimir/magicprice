<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160805104548 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('
            CREATE TABLE price_setting 
                (
                    id INT AUTO_INCREMENT NOT NULL, 
                    setting_key VARCHAR(64) NOT NULL, 
                    setting_value VARCHAR(64) NOT NULL, 
                    priceList_id INT NOT NULL, 
                    INDEX IDX_F45270C446B960C4 (priceList_id), 
                    PRIMARY KEY(id)
                ) 
            DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB'
        );
        $this->addSql('ALTER TABLE price_setting ADD CONSTRAINT FK_F45270C446B960C4 FOREIGN KEY (priceList_id) REFERENCES price_list (id)');
        $this->addSql('ALTER TABLE price_list ADD code VARCHAR(24) NOT NULL, DROP file_path, DROP currency, DROP exchange_rate, DROP margin_rate');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_399A0AA277153098 ON price_list (code)');
        $this->addSql('ALTER TABLE supplier CHANGE exchange_rate exchange_rate DOUBLE PRECISION DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE price_setting');
        $this->addSql('DROP INDEX UNIQ_399A0AA277153098 ON price_list');
        $this->addSql('ALTER TABLE price_list ADD file_path VARCHAR(128) NOT NULL COLLATE utf8mb4_general_ci, ADD currency VARCHAR(3) DEFAULT NULL COLLATE utf8mb4_general_ci, ADD exchange_rate DOUBLE PRECISION DEFAULT NULL, ADD margin_rate SMALLINT DEFAULT NULL, DROP code');
        $this->addSql('ALTER TABLE supplier CHANGE exchange_rate exchange_rate DOUBLE PRECISION DEFAULT NULL');
    }
}
