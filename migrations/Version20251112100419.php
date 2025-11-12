<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251112100419 extends AbstractMigration
{
    public function getDescription(): string
    {
        // On donne une description claire
        return 'Ajoute la relation quotient_id à la table responsable';
    }

    public function up(Schema $schema): void
    {
        // On ajoute SEULEMENT la colonne, l'index, et la clé étrangère qui manquent
        $this->addSql('ALTER TABLE responsable ADD quotient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE responsable ADD CONSTRAINT FK_52520D07F2C3D606 FOREIGN KEY (quotient_id) REFERENCES tranche_quotient (id)');
        $this->addSql('CREATE INDEX IDX_52520D07F2C3D606 ON responsable (quotient_id)');
    }

    public function down(Schema $schema): void
    {
        // L'inverse : on supprime la clé et la colonne
        $this->addSql('ALTER TABLE responsable DROP FOREIGN KEY FK_52520D07F2C3D606');
        $this->addSql('DROP INDEX IDX_52520D07F2C3D606 ON responsable');
        $this->addSql('ALTER TABLE responsable DROP quotient_id');
    }
}