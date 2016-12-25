<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160804135330 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE original_price_list (id INT AUTO_INCREMENT NOT NULL, vendor_code VARCHAR(128) NOT NULL, brand VARCHAR(128) NOT NULL, name VARCHAR(128) NOT NULL, description LONGTEXT DEFAULT NULL, quantity SMALLINT UNSIGNED NOT NULL, priceList_id INT NOT NULL, INDEX IDX_542D7D3646B960C4 (priceList_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE price_list (id INT AUTO_INCREMENT NOT NULL, supplier_id INT NOT NULL, name VARCHAR(128) NOT NULL, file_path VARCHAR(128) NOT NULL, currency VARCHAR(3) DEFAULT NULL, exchange_rate DOUBLE PRECISION DEFAULT NULL, margin_rate SMALLINT DEFAULT NULL, UNIQUE INDEX UNIQ_399A0AA25E237E06 (name), INDEX IDX_399A0AA22ADD6D8C (supplier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supplier (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(128) NOT NULL, code VARCHAR(128) NOT NULL, price_currency VARCHAR(3) DEFAULT NULL, exchange_rate DOUBLE PRECISION DEFAULT NULL, margin_rate SMALLINT NOT NULL, UNIQUE INDEX UNIQ_9B2A6C7E77153098 (code), INDEX IDX_9B2A6C7EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(25) NOT NULL, password VARCHAR(64) NOT NULL, email VARCHAR(60) NOT NULL, is_active TINYINT(1) NOT NULL, tariff_plane VARCHAR(15) NOT NULL, first_name VARCHAR(60) NOT NULL, second_name VARCHAR(60) NOT NULL, birth_date DATE NOT NULL, phone VARCHAR(15) NOT NULL, website VARCHAR(128) DEFAULT NULL, facebook VARCHAR(128) DEFAULT NULL, skype VARCHAR(60) DEFAULT NULL, viber VARCHAR(60) DEFAULT NULL, another_messenger VARCHAR(128) DEFAULT NULL, country VARCHAR(60) DEFAULT NULL, region VARCHAR(60) DEFAULT NULL, city VARCHAR(60) DEFAULT NULL, street VARCHAR(60) DEFAULT NULL, house VARCHAR(5) DEFAULT NULL, flat VARCHAR(5) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE original_price_list ADD CONSTRAINT FK_542D7D3646B960C4 FOREIGN KEY (priceList_id) REFERENCES price_list (id)');
        $this->addSql('ALTER TABLE price_list ADD CONSTRAINT FK_399A0AA22ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
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
        $this->addSql('ALTER TABLE price_list DROP FOREIGN KEY FK_399A0AA22ADD6D8C');
        $this->addSql('ALTER TABLE supplier DROP FOREIGN KEY FK_9B2A6C7EA76ED395');
        $this->addSql('DROP TABLE original_price_list');
        $this->addSql('DROP TABLE price_list');
        $this->addSql('DROP TABLE supplier');
        $this->addSql('DROP TABLE user');
    }
}
