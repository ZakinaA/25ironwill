<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251126103602 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact_cours (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(128) NOT NULL, email VARCHAR(255) NOT NULL, message VARCHAR(4096) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE type_instrument DROP FOREIGN KEY FK_21BCBFF8F7D7F589');
        $this->addSql('DROP INDEX IDX_21BCBFF8F7D7F589 ON type_instrument');
        $this->addSql('ALTER TABLE type_instrument DROP classeinstrument_id');
        $this->addSql('ALTER TABLE user CHANGE num_rue num_rue INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE contact_cours');
        $this->addSql('ALTER TABLE type_instrument ADD classeinstrument_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_instrument ADD CONSTRAINT FK_21BCBFF8F7D7F589 FOREIGN KEY (classeinstrument_id) REFERENCES classe_instrument (id)');
        $this->addSql('CREATE INDEX IDX_21BCBFF8F7D7F589 ON type_instrument (classeinstrument_id)');
        $this->addSql('ALTER TABLE user CHANGE num_rue num_rue INT NOT NULL');
    }
}
