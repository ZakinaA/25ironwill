<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251110153846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7B76F6B31');
        $this->addSql('ALTER TABLE responsable DROP FOREIGN KEY FK_52520D07B76F6B31');
        $this->addSql('ALTER TABLE tarif DROP FOREIGN KEY FK_E7189C9B76F6B31');
        $this->addSql('DROP TABLE tranche');
        $this->addSql('DROP INDEX IDX_ECA105F7B76F6B31 ON eleve');
        $this->addSql('ALTER TABLE eleve DROP tranche_id');
        $this->addSql('ALTER TABLE paiment ADD eleve_id INT DEFAULT NULL, ADD quotient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE paiment ADD CONSTRAINT FK_DC8138FA6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE paiment ADD CONSTRAINT FK_DC8138FF2C3D606 FOREIGN KEY (quotient_id) REFERENCES tranche_quotient (id)');
        $this->addSql('CREATE INDEX IDX_DC8138FA6CC7B2 ON paiment (eleve_id)');
        $this->addSql('CREATE INDEX IDX_DC8138FF2C3D606 ON paiment (quotient_id)');
        $this->addSql('DROP INDEX IDX_52520D07B76F6B31 ON responsable');
        $this->addSql('ALTER TABLE responsable CHANGE tranche_id quotient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE responsable ADD CONSTRAINT FK_52520D07F2C3D606 FOREIGN KEY (quotient_id) REFERENCES tranche_quotient (id)');
        $this->addSql('CREATE INDEX IDX_52520D07F2C3D606 ON responsable (quotient_id)');
        $this->addSql('DROP INDEX IDX_E7189C9B76F6B31 ON tarif');
        $this->addSql('ALTER TABLE tarif DROP tranche_id');
        $this->addSql('ALTER TABLE tranche_quotient CHANGE nom_tranche libelle VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tranche (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, quotient_mini INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE eleve ADD tranche_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7B76F6B31 FOREIGN KEY (tranche_id) REFERENCES tranche (id)');
        $this->addSql('CREATE INDEX IDX_ECA105F7B76F6B31 ON eleve (tranche_id)');
        $this->addSql('ALTER TABLE paiment DROP FOREIGN KEY FK_DC8138FA6CC7B2');
        $this->addSql('ALTER TABLE paiment DROP FOREIGN KEY FK_DC8138FF2C3D606');
        $this->addSql('DROP INDEX IDX_DC8138FA6CC7B2 ON paiment');
        $this->addSql('DROP INDEX IDX_DC8138FF2C3D606 ON paiment');
        $this->addSql('ALTER TABLE paiment DROP eleve_id, DROP quotient_id');
        $this->addSql('ALTER TABLE responsable DROP FOREIGN KEY FK_52520D07F2C3D606');
        $this->addSql('DROP INDEX IDX_52520D07F2C3D606 ON responsable');
        $this->addSql('ALTER TABLE responsable CHANGE quotient_id tranche_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE responsable ADD CONSTRAINT FK_52520D07B76F6B31 FOREIGN KEY (tranche_id) REFERENCES tranche (id)');
        $this->addSql('CREATE INDEX IDX_52520D07B76F6B31 ON responsable (tranche_id)');
        $this->addSql('ALTER TABLE tarif ADD tranche_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tarif ADD CONSTRAINT FK_E7189C9B76F6B31 FOREIGN KEY (tranche_id) REFERENCES tranche (id)');
        $this->addSql('CREATE INDEX IDX_E7189C9B76F6B31 ON tarif (tranche_id)');
        $this->addSql('ALTER TABLE tranche_quotient CHANGE libelle nom_tranche VARCHAR(255) NOT NULL');
    }
}
