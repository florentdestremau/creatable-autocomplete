<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231024070735 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attribute_user (attribute_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(attribute_id, user_id), CONSTRAINT FK_D67B72C1B6E62EFA FOREIGN KEY (attribute_id) REFERENCES attribute (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D67B72C1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_D67B72C1B6E62EFA ON attribute_user (attribute_id)');
        $this->addSql('CREATE INDEX IDX_D67B72C1A76ED395 ON attribute_user (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__attribute AS SELECT id, name FROM attribute');
        $this->addSql('DROP TABLE attribute');
        $this->addSql('CREATE TABLE attribute (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO attribute (id, name) SELECT id, name FROM __temp__attribute');
        $this->addSql('DROP TABLE __temp__attribute');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE attribute_user');
        $this->addSql('CREATE TEMPORARY TABLE __temp__attribute AS SELECT id, name FROM attribute');
        $this->addSql('DROP TABLE attribute');
        $this->addSql('CREATE TABLE attribute (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, CONSTRAINT FK_FA7AEFFBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO attribute (id, name) SELECT id, name FROM __temp__attribute');
        $this->addSql('DROP TABLE __temp__attribute');
        $this->addSql('CREATE INDEX IDX_FA7AEFFBA76ED395 ON attribute (user_id)');
    }
}
