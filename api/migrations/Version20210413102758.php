<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210413102758 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create Score Table';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE score_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE score (id INT NOT NULL, id_user INT NOT NULL, id_movie INT NOT NULL, score INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3299375179F37AE5 ON score (id_user)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_3299375179F37AE5 FOREIGN KEY (id_user) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE score_id_seq CASCADE');
        $this->addSql('DROP TABLE score');
    }
}
