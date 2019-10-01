<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191001024752 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(300) NOT NULL, link VARCHAR(300) NOT NULL, src_image VARCHAR(300) NOT NULL, validity_text VARCHAR(100) NOT NULL, validity_length INT NOT NULL, end_sale_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nahodka (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(300) NOT NULL, link VARCHAR(300) NOT NULL, src_image VARCHAR(300) NOT NULL, validity_text VARCHAR(100) NOT NULL, validity_length INT NOT NULL, end_sale_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vladivostok (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(300) NOT NULL, link VARCHAR(300) NOT NULL, src_image VARCHAR(300) NOT NULL, validity_text VARCHAR(100) NOT NULL, validity_length INT NOT NULL, end_sale_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE habarovsk (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(300) NOT NULL, link VARCHAR(300) NOT NULL, src_image VARCHAR(300) NOT NULL, validity_text VARCHAR(100) NOT NULL, validity_length INT NOT NULL, end_sale_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ussuriysk (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(300) NOT NULL, link VARCHAR(300) NOT NULL, src_image VARCHAR(300) NOT NULL, validity_text VARCHAR(100) NOT NULL, validity_length INT NOT NULL, end_sale_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artem (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(300) NOT NULL, link VARCHAR(300) NOT NULL, src_image VARCHAR(300) NOT NULL, validity_text VARCHAR(100) NOT NULL, validity_length INT NOT NULL, end_sale_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE nahodka');
        $this->addSql('DROP TABLE vladivostok');
        $this->addSql('DROP TABLE habarovsk');
        $this->addSql('DROP TABLE ussuriysk');
        $this->addSql('DROP TABLE artem');
    }
}
