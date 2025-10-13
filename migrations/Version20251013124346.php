<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251013124346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE instrument ADD instrument_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE instrument ADD CONSTRAINT FK_3CBF69DDCF11D9C FOREIGN KEY (instrument_id) REFERENCES marque (id)');
        $this->addSql('CREATE INDEX IDX_3CBF69DDCF11D9C ON instrument (instrument_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE instrument DROP FOREIGN KEY FK_3CBF69DDCF11D9C');
        $this->addSql('DROP INDEX IDX_3CBF69DDCF11D9C ON instrument');
        $this->addSql('ALTER TABLE instrument DROP instrument_id');
    }
}
