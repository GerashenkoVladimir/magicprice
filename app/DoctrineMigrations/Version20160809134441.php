<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160809134441 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ready_price_list (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, vendor_code VARCHAR(128) NOT NULL, brand VARCHAR(128) NOT NULL, name VARCHAR(128) NOT NULL, description LONGTEXT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, quantity SMALLINT UNSIGNED NOT NULL, originalPriceList_id INT DEFAULT NULL, priceList_id INT NOT NULL, UNIQUE INDEX UNIQ_92E90883F73AE9E8 (originalPriceList_id), INDEX IDX_92E90883A76ED395 (user_id), INDEX IDX_92E9088346B960C4 (priceList_id), UNIQUE INDEX unique_vendoreCode_brand_priceList_user (vendor_code, brand, priceList_id, user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ready_price_list ADD CONSTRAINT FK_92E90883F73AE9E8 FOREIGN KEY (originalPriceList_id) REFERENCES original_price_list (id)');
        $this->addSql('ALTER TABLE ready_price_list ADD CONSTRAINT FK_92E90883A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ready_price_list ADD CONSTRAINT FK_92E9088346B960C4 FOREIGN KEY (priceList_id) REFERENCES price_list (id)');
        $this->addSql('ALTER TABLE original_price_list CHANGE price price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE supplier CHANGE exchange_rate exchange_rate DOUBLE PRECISION DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE ready_price_list');
        $this->addSql('ALTER TABLE original_price_list CHANGE price price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE supplier CHANGE exchange_rate exchange_rate DOUBLE PRECISION DEFAULT NULL');
    }
}
