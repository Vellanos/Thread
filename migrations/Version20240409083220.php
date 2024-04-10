<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240409083220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE response_vote ADD user_id INT NOT NULL, ADD response_id INT NOT NULL');
        $this->addSql('ALTER TABLE response_vote ADD CONSTRAINT FK_F6B18FFEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE response_vote ADD CONSTRAINT FK_F6B18FFEFBF32840 FOREIGN KEY (response_id) REFERENCES response (id)');
        $this->addSql('CREATE INDEX IDX_F6B18FFEA76ED395 ON response_vote (user_id)');
        $this->addSql('CREATE INDEX IDX_F6B18FFEFBF32840 ON response_vote (response_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE response_vote DROP FOREIGN KEY FK_F6B18FFEA76ED395');
        $this->addSql('ALTER TABLE response_vote DROP FOREIGN KEY FK_F6B18FFEFBF32840');
        $this->addSql('DROP INDEX IDX_F6B18FFEA76ED395 ON response_vote');
        $this->addSql('DROP INDEX IDX_F6B18FFEFBF32840 ON response_vote');
        $this->addSql('ALTER TABLE response_vote DROP user_id, DROP response_id');
    }
}
