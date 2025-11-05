<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251105094618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paiment ADD eleve_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE paiment ADD CONSTRAINT FK_DC8138FA6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('CREATE INDEX IDX_DC8138FA6CC7B2 ON paiment (eleve_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paiment DROP FOREIGN KEY FK_DC8138FA6CC7B2');
        $this->addSql('DROP INDEX IDX_DC8138FA6CC7B2 ON paiment');
        $this->addSql('ALTER TABLE paiment DROP eleve_id');
    }
}
