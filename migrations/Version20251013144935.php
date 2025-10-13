<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251013144935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE responsable_eleve (responsable_id INT NOT NULL, eleve_id INT NOT NULL, INDEX IDX_8D30209553C59D72 (responsable_id), INDEX IDX_8D302095A6CC7B2 (eleve_id), PRIMARY KEY(responsable_id, eleve_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarif (id INT AUTO_INCREMENT NOT NULL, tranche_id INT DEFAULT NULL, type_id INT DEFAULT NULL, montant DOUBLE PRECISION NOT NULL, INDEX IDX_E7189C9B76F6B31 (tranche_id), INDEX IDX_E7189C9C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tranche (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, quotient_mini INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE responsable_eleve ADD CONSTRAINT FK_8D30209553C59D72 FOREIGN KEY (responsable_id) REFERENCES responsable (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE responsable_eleve ADD CONSTRAINT FK_8D302095A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tarif ADD CONSTRAINT FK_E7189C9B76F6B31 FOREIGN KEY (tranche_id) REFERENCES tranche (id)');
        $this->addSql('ALTER TABLE tarif ADD CONSTRAINT FK_E7189C9C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE eleve ADD tranche_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7B76F6B31 FOREIGN KEY (tranche_id) REFERENCES tranche (id)');
        $this->addSql('CREATE INDEX IDX_ECA105F7B76F6B31 ON eleve (tranche_id)');
        $this->addSql('ALTER TABLE responsable ADD tranche_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE responsable ADD CONSTRAINT FK_52520D07B76F6B31 FOREIGN KEY (tranche_id) REFERENCES tranche (id)');
        $this->addSql('CREATE INDEX IDX_52520D07B76F6B31 ON responsable (tranche_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7B76F6B31');
        $this->addSql('ALTER TABLE responsable DROP FOREIGN KEY FK_52520D07B76F6B31');
        $this->addSql('ALTER TABLE responsable_eleve DROP FOREIGN KEY FK_8D30209553C59D72');
        $this->addSql('ALTER TABLE responsable_eleve DROP FOREIGN KEY FK_8D302095A6CC7B2');
        $this->addSql('ALTER TABLE tarif DROP FOREIGN KEY FK_E7189C9B76F6B31');
        $this->addSql('ALTER TABLE tarif DROP FOREIGN KEY FK_E7189C9C54C8C93');
        $this->addSql('DROP TABLE responsable_eleve');
        $this->addSql('DROP TABLE tarif');
        $this->addSql('DROP TABLE tranche');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP INDEX IDX_ECA105F7B76F6B31 ON eleve');
        $this->addSql('ALTER TABLE eleve DROP tranche_id');
        $this->addSql('DROP INDEX IDX_52520D07B76F6B31 ON responsable');
        $this->addSql('ALTER TABLE responsable DROP tranche_id');
    }
}
