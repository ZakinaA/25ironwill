<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251126093051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription ADD montant_du DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE type_instrument DROP FOREIGN KEY FK_21BCBFF8F7D7F589');
        $this->addSql('DROP INDEX IDX_21BCBFF8F7D7F589 ON type_instrument');
        $this->addSql('ALTER TABLE type_instrument DROP classeinstrument_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP montant_du');
        $this->addSql('ALTER TABLE type_instrument ADD classeinstrument_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_instrument ADD CONSTRAINT FK_21BCBFF8F7D7F589 FOREIGN KEY (classeinstrument_id) REFERENCES classe_instrument (id)');
        $this->addSql('CREATE INDEX IDX_21BCBFF8F7D7F589 ON type_instrument (classeinstrument_id)');
    }
}
