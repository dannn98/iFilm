<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210413150405 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create WatchList Table';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE watch_list_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE watch_list (id INT NOT NULL, id_user_id INT NOT NULL, id_movie INT NOT NULL, watched VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_152B584B79F37AE5 ON watch_list (id_user_id)');
        $this->addSql('ALTER TABLE watch_list ADD CONSTRAINT FK_152B584B79F37AE5 FOREIGN KEY (id_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE watch_list_id_seq CASCADE');
        $this->addSql('DROP TABLE watch_list');
    }
}
