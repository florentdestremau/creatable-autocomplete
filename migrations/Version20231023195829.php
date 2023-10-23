<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231023195829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__attribute AS SELECT id, user_id, name FROM attribute');
        $this->addSql('DROP TABLE attribute');
        $this->addSql('CREATE TABLE attribute (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, CONSTRAINT FK_FA7AEFFBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO attribute (id, user_id, name) SELECT id, user_id, name FROM __temp__attribute');
        $this->addSql('DROP TABLE __temp__attribute');
        $this->addSql('CREATE INDEX IDX_FA7AEFFBA76ED395 ON attribute (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__attribute AS SELECT id, user_id, name FROM attribute');
        $this->addSql('DROP TABLE attribute');
        $this->addSql('CREATE TABLE attribute (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, CONSTRAINT FK_FA7AEFFBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO attribute (id, user_id, name) SELECT id, user_id, name FROM __temp__attribute');
        $this->addSql('DROP TABLE __temp__attribute');
        $this->addSql('CREATE INDEX IDX_FA7AEFFBA76ED395 ON attribute (user_id)');
    }
}
