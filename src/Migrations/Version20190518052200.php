<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190518052200 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE group_roles DROP FOREIGN KEY group_roles_ibfk_1');
        $this->addSql('DROP INDEX role_id ON group_roles');
        $this->addSql('DROP INDEX UNIQ_8D93D649AA08CB10 ON user');
        $this->addSql('ALTER TABLE user CHANGE login username VARCHAR(150) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('ALTER TABLE user_group DROP FOREIGN KEY user_group_ibfk_1');
        $this->addSql('DROP INDEX group_id ON user_group');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE group_roles ADD CONSTRAINT group_roles_ibfk_1 FOREIGN KEY (role_id) REFERENCES roles (id)');
        $this->addSql('CREATE INDEX role_id ON group_roles (role_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user');
        $this->addSql('ALTER TABLE user CHANGE username login VARCHAR(150) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AA08CB10 ON user (login)');
        $this->addSql('ALTER TABLE user_group ADD CONSTRAINT user_group_ibfk_1 FOREIGN KEY (group_id) REFERENCES app_group (id)');
        $this->addSql('CREATE INDEX group_id ON user_group (group_id)');
    }
}
