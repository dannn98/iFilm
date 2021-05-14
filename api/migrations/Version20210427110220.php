<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210427110220 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT fk_9474526c79f37ae5');
        $this->addSql('DROP INDEX idx_9474526c79f37ae5');
        $this->addSql('ALTER TABLE comment RENAME COLUMN id_user TO user_id');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9474526CA76ED395 ON comment (user_id)');
        $this->addSql('ALTER TABLE score DROP CONSTRAINT fk_3299375179f37ae5');
        $this->addSql('DROP INDEX idx_3299375179f37ae5');
        $this->addSql('ALTER TABLE score RENAME COLUMN id_user TO user_id');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_32993751A76ED395 ON score (user_id)');
        $this->addSql('ALTER TABLE watch_list DROP CONSTRAINT fk_152b584b79f37ae5');
        $this->addSql('DROP INDEX idx_152b584b79f37ae5');
        $this->addSql('ALTER TABLE watch_list RENAME COLUMN id_user TO user_id');
        $this->addSql('ALTER TABLE watch_list ADD CONSTRAINT FK_152B584BA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_152B584BA76ED395 ON watch_list (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CA76ED395');
        $this->addSql('DROP INDEX IDX_9474526CA76ED395');
        $this->addSql('ALTER TABLE comment RENAME COLUMN user_id TO id_user');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT fk_9474526c79f37ae5 FOREIGN KEY (id_user) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_9474526c79f37ae5 ON comment (id_user)');
        $this->addSql('ALTER TABLE score DROP CONSTRAINT FK_32993751A76ED395');
        $this->addSql('DROP INDEX IDX_32993751A76ED395');
        $this->addSql('ALTER TABLE score RENAME COLUMN user_id TO id_user');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT fk_3299375179f37ae5 FOREIGN KEY (id_user) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_3299375179f37ae5 ON score (id_user)');
        $this->addSql('ALTER TABLE watch_list DROP CONSTRAINT FK_152B584BA76ED395');
        $this->addSql('DROP INDEX IDX_152B584BA76ED395');
        $this->addSql('ALTER TABLE watch_list RENAME COLUMN user_id TO id_user');
        $this->addSql('ALTER TABLE watch_list ADD CONSTRAINT fk_152b584b79f37ae5 FOREIGN KEY (id_user) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_152b584b79f37ae5 ON watch_list (id_user)');
    }
}
