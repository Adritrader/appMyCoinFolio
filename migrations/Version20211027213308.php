<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211027213308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cryptocurrency');
        $this->addSql('DROP TABLE portfolio');
        $this->addSql('ALTER TABLE analysis ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE analysis ADD CONSTRAINT FK_33C73012469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_33C73012469DE2 ON analysis (category_id)');
        $this->addSql('ALTER TABLE user CHANGE modified_at modified_at DATETIME NOT NULL, CHANGE username username VARCHAR(255) NOT NULL, CHANGE newsletter newsletter TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cryptocurrency (id INT AUTO_INCREMENT NOT NULL, ticker VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, quantity DOUBLE PRECISION NOT NULL, buy_price DOUBLE PRECISION NOT NULL, buy_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE portfolio (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE analysis DROP FOREIGN KEY FK_33C73012469DE2');
        $this->addSql('DROP INDEX IDX_33C73012469DE2 ON analysis');
        $this->addSql('ALTER TABLE analysis DROP category_id');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE modified_at modified_at DATETIME DEFAULT NULL, CHANGE newsletter newsletter TINYINT(1) DEFAULT NULL');
    }
}
