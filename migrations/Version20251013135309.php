<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251013135309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contrat_pret (id INT AUTO_INCREMENT NOT NULL, eleve_id INT DEFAULT NULL, instrument_id INT DEFAULT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, attestation_assurance VARCHAR(255) NOT NULL, etat_detaille_debut VARCHAR(50) NOT NULL, etat_detaille_retour VARCHAR(50) NOT NULL, INDEX IDX_1FB84C67A6CC7B2 (eleve_id), INDEX IDX_1FB84C67CF11D9C (instrument_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleve (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, num_rue INT NOT NULL, rue VARCHAR(30) NOT NULL, copos INT NOT NULL, ville VARCHAR(30) NOT NULL, tel INT NOT NULL, mail VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instrument (id INT AUTO_INCREMENT NOT NULL, instrument_id INT DEFAULT NULL, num_serie INT NOT NULL, date_achat DATE NOT NULL, prix_achat TINYINT(1) NOT NULL, utilisation VARCHAR(50) NOT NULL, chemin_image VARCHAR(255) DEFAULT NULL, INDEX IDX_3CBF69DDCF11D9C (instrument_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervention (id INT AUTO_INCREMENT NOT NULL, professionnel_id INT DEFAULT NULL, instrument_id INT DEFAULT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, description VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, quotite INT NOT NULL, INDEX IDX_D11814AB8A49CC82 (professionnel_id), INDEX IDX_D11814ABCF11D9C (instrument_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professionnel (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, num_rue INT NOT NULL, rue VARCHAR(50) NOT NULL, copos INT NOT NULL, ville VARCHAR(50) NOT NULL, tel VARCHAR(12) NOT NULL, mail VARCHAR(70) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE responsable (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, num_rue INT NOT NULL, rue VARCHAR(40) NOT NULL, copos INT NOT NULL, ville VARCHAR(40) NOT NULL, tel INT NOT NULL, mail VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contrat_pret ADD CONSTRAINT FK_1FB84C67A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE contrat_pret ADD CONSTRAINT FK_1FB84C67CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id)');
        $this->addSql('ALTER TABLE instrument ADD CONSTRAINT FK_3CBF69DDCF11D9C FOREIGN KEY (instrument_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814AB8A49CC82 FOREIGN KEY (professionnel_id) REFERENCES professionnel (id)');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814ABCF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contrat_pret DROP FOREIGN KEY FK_1FB84C67A6CC7B2');
        $this->addSql('ALTER TABLE contrat_pret DROP FOREIGN KEY FK_1FB84C67CF11D9C');
        $this->addSql('ALTER TABLE instrument DROP FOREIGN KEY FK_3CBF69DDCF11D9C');
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814AB8A49CC82');
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814ABCF11D9C');
        $this->addSql('DROP TABLE contrat_pret');
        $this->addSql('DROP TABLE eleve');
        $this->addSql('DROP TABLE instrument');
        $this->addSql('DROP TABLE intervention');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE professionnel');
        $this->addSql('DROP TABLE responsable');
    }
}
