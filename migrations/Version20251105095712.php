<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251105095712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE responsable CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE responsable ADD CONSTRAINT FK_52520D07A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_52520D07A76ED395 ON responsable (user_id)');
        $this->addSql('ALTER TABLE user ADD nom VARCHAR(50) NOT NULL, ADD prenom VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE responsable DROP FOREIGN KEY FK_52520D07A76ED395');
        $this->addSql('DROP INDEX UNIQ_52520D07A76ED395 ON responsable');
        $this->addSql('ALTER TABLE responsable CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user DROP nom, DROP prenom');
    }
}
