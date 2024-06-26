<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240409083502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE thread_vote ADD user_id INT NOT NULL, ADD thread_id INT NOT NULL');
        $this->addSql('ALTER TABLE thread_vote ADD CONSTRAINT FK_DEA199EAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE thread_vote ADD CONSTRAINT FK_DEA199EAE2904019 FOREIGN KEY (thread_id) REFERENCES thread (id)');
        $this->addSql('CREATE INDEX IDX_DEA199EAA76ED395 ON thread_vote (user_id)');
        $this->addSql('CREATE INDEX IDX_DEA199EAE2904019 ON thread_vote (thread_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE thread_vote DROP FOREIGN KEY FK_DEA199EAA76ED395');
        $this->addSql('ALTER TABLE thread_vote DROP FOREIGN KEY FK_DEA199EAE2904019');
        $this->addSql('DROP INDEX IDX_DEA199EAA76ED395 ON thread_vote');
        $this->addSql('DROP INDEX IDX_DEA199EAE2904019 ON thread_vote');
        $this->addSql('ALTER TABLE thread_vote DROP user_id, DROP thread_id');
    }
}
