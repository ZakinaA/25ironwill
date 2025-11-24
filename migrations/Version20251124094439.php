<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251124094439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE instrument CHANGE num_serie num_serie VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE responsable CHANGE mail mail VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE num_rue num_rue INT NOT NULL, CHANGE rue rue VARCHAR(255) DEFAULT NULL, CHANGE ville ville VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE instrument CHANGE num_serie num_serie INT NOT NULL');
        $this->addSql('ALTER TABLE responsable CHANGE mail mail VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE num_rue num_rue INT DEFAULT NULL, CHANGE rue rue VARCHAR(100) DEFAULT NULL, CHANGE ville ville VARCHAR(100) DEFAULT NULL');
    }
}
