<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160809090345 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE original_price_list CHANGE price price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE original_price_list ADD CONSTRAINT FK_542D7D3646B960C4 FOREIGN KEY (priceList_id) REFERENCES price_list (id)');
        $this->addSql('ALTER TABLE original_price_list ADD CONSTRAINT FK_542D7D36A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE price_list ADD CONSTRAINT FK_399A0AA22ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('ALTER TABLE price_list ADD CONSTRAINT FK_399A0AA2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE price_setting ADD CONSTRAINT FK_F45270C446B960C4 FOREIGN KEY (priceList_id) REFERENCES price_list (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE supplier CHANGE exchange_rate exchange_rate DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE supplier ADD CONSTRAINT FK_9B2A6C7EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE original_price_list DROP FOREIGN KEY FK_542D7D3646B960C4');
        $this->addSql('ALTER TABLE original_price_list DROP FOREIGN KEY FK_542D7D36A76ED395');
        $this->addSql('ALTER TABLE original_price_list CHANGE price price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE price_list DROP FOREIGN KEY FK_399A0AA22ADD6D8C');
        $this->addSql('ALTER TABLE price_list DROP FOREIGN KEY FK_399A0AA2A76ED395');
        $this->addSql('ALTER TABLE price_setting DROP FOREIGN KEY FK_F45270C446B960C4');
        $this->addSql('ALTER TABLE supplier DROP FOREIGN KEY FK_9B2A6C7EA76ED395');
        $this->addSql('ALTER TABLE supplier CHANGE exchange_rate exchange_rate DOUBLE PRECISION DEFAULT NULL');
    }
}
