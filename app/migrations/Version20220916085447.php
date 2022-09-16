<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220916085447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredients (ing_id INT AUTO_INCREMENT NOT NULL, foreign_id INT DEFAULT NULL, ingr VARCHAR(255) NOT NULL, INDEX IDX_4B60114FCD42CE46 (foreign_id), PRIMARY KEY(ing_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipes (rec_id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, preparation VARCHAR(5000) NOT NULL, PRIMARY KEY(rec_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ingredients ADD CONSTRAINT FK_4B60114FCD42CE46 FOREIGN KEY (foreign_id) REFERENCES recipes (rec_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredients DROP FOREIGN KEY FK_4B60114FCD42CE46');
        $this->addSql('DROP TABLE ingredients');
        $this->addSql('DROP TABLE recipes');
    }
}
