<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251124123246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE accessoire (id INT AUTO_INCREMENT NOT NULL, instrument_id INT DEFAULT NULL, libelle VARCHAR(100) NOT NULL, INDEX IDX_8FD026ACF11D9C (instrument_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe_instrument (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, message VARCHAR(500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contrat_pret (id INT AUTO_INCREMENT NOT NULL, eleve_id INT DEFAULT NULL, instrument_id INT DEFAULT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, attestation_assurance VARCHAR(255) NOT NULL, etat_detaille_debut VARCHAR(50) NOT NULL, etat_detaille_retour VARCHAR(50) NOT NULL, INDEX IDX_1FB84C67A6CC7B2 (eleve_id), INDEX IDX_1FB84C67CF11D9C (instrument_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE couleur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE couleur_instrument (couleur_id INT NOT NULL, instrument_id INT NOT NULL, INDEX IDX_2E62255DC31BA576 (couleur_id), INDEX IDX_2E62255DCF11D9C (instrument_id), PRIMARY KEY(couleur_id, instrument_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, type_instrument_id INT DEFAULT NULL, professeur_id INT DEFAULT NULL, jour_id INT DEFAULT NULL, libelle VARCHAR(128) NOT NULL, age_mini INT NOT NULL, heure_debut DATETIME NOT NULL, heure_fin TIME NOT NULL, nb_places INT NOT NULL, age_maxi INT NOT NULL, INDEX IDX_FDCA8C9CC54C8C93 (type_id), INDEX IDX_FDCA8C9C7C1CAAA9 (type_instrument_id), INDEX IDX_FDCA8C9CBAB22EE9 (professeur_id), INDEX IDX_FDCA8C9C220C6AD0 (jour_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleve (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, num_rue INT NOT NULL, rue VARCHAR(30) DEFAULT NULL, copos INT NOT NULL, ville VARCHAR(30) NOT NULL, tel INT NOT NULL, mail VARCHAR(40) NOT NULL, UNIQUE INDEX UNIQ_ECA105F7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, cours_id INT DEFAULT NULL, eleve_id INT DEFAULT NULL, date_inscription DATE NOT NULL, montant_du DOUBLE PRECISION DEFAULT NULL, INDEX IDX_5E90F6D67ECF78B0 (cours_id), INDEX IDX_5E90F6D6A6CC7B2 (eleve_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instrument (id INT AUTO_INCREMENT NOT NULL, marque_id INT DEFAULT NULL, type_id INT DEFAULT NULL, num_serie VARCHAR(255) NOT NULL, date_achat DATE NOT NULL, prix_achat DOUBLE PRECISION NOT NULL, utilisation VARCHAR(50) NOT NULL, chemin_image VARCHAR(255) DEFAULT NULL, INDEX IDX_3CBF69DD4827B9B2 (marque_id), INDEX IDX_3CBF69DDC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervention (id INT AUTO_INCREMENT NOT NULL, professionnel_id INT DEFAULT NULL, instrument_id INT DEFAULT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, description VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, quotite INT NOT NULL, INDEX IDX_D11814AB8A49CC82 (professionnel_id), INDEX IDX_D11814ABCF11D9C (instrument_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jour (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier_professionnel (metier_id INT NOT NULL, professionnel_id INT NOT NULL, INDEX IDX_FA14296CED16FA20 (metier_id), INDEX IDX_FA14296C8A49CC82 (professionnel_id), PRIMARY KEY(metier_id, professionnel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiment (id INT AUTO_INCREMENT NOT NULL, inscription_id INT DEFAULT NULL, eleve_id INT DEFAULT NULL, quotient_id INT DEFAULT NULL, montant DOUBLE PRECISION NOT NULL, date_paiment DATE NOT NULL, INDEX IDX_DC8138F5DAC5993 (inscription_id), INDEX IDX_DC8138FA6CC7B2 (eleve_id), INDEX IDX_DC8138FF2C3D606 (quotient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, num_rue INT NOT NULL, rue VARCHAR(255) NOT NULL, copos INT NOT NULL, ville VARCHAR(70) NOT NULL, tel INT NOT NULL, mail VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur_type_instrument (professeur_id INT NOT NULL, type_instrument_id INT NOT NULL, INDEX IDX_1E1989D6BAB22EE9 (professeur_id), INDEX IDX_1E1989D67C1CAAA9 (type_instrument_id), PRIMARY KEY(professeur_id, type_instrument_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professionnel (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, num_rue INT NOT NULL, rue VARCHAR(50) NOT NULL, copos INT NOT NULL, ville VARCHAR(50) NOT NULL, tel VARCHAR(12) NOT NULL, mail VARCHAR(70) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE responsable (id INT AUTO_INCREMENT NOT NULL, quotient_id INT DEFAULT NULL, user_id INT NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, num_rue INT NOT NULL, rue VARCHAR(40) NOT NULL, copos INT NOT NULL, ville VARCHAR(40) NOT NULL, tel INT NOT NULL, mail VARCHAR(50) NOT NULL, INDEX IDX_52520D07F2C3D606 (quotient_id), UNIQUE INDEX UNIQ_52520D07A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE responsable_eleve (responsable_id INT NOT NULL, eleve_id INT NOT NULL, INDEX IDX_8D30209553C59D72 (responsable_id), INDEX IDX_8D302095A6CC7B2 (eleve_id), PRIMARY KEY(responsable_id, eleve_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarif (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, montant DOUBLE PRECISION NOT NULL, INDEX IDX_E7189C9C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarif_cours (id INT AUTO_INCREMENT NOT NULL, tranche_quotient_id_id INT DEFAULT NULL, cours_id_id INT DEFAULT NULL, prix_facture NUMERIC(20, 0) NOT NULL, INDEX IDX_24FE176C1FCAE54 (tranche_quotient_id_id), INDEX IDX_24FE176C4F221781 (cours_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tranche_quotient (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, quotient_min INT NOT NULL, quotient_max INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_instrument (id INT AUTO_INCREMENT NOT NULL, classe_instrument_id INT DEFAULT NULL, classeinstrument_id INT DEFAULT NULL, libelle VARCHAR(255) DEFAULT NULL, INDEX IDX_21BCBFF8CE879FB1 (classe_instrument_id), INDEX IDX_21BCBFF8F7D7F589 (classeinstrument_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(255) NOT NULL, num_rue INT NOT NULL, rue VARCHAR(255) DEFAULT NULL, copos INT DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, tel INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE accessoire ADD CONSTRAINT FK_8FD026ACF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id)');
        $this->addSql('ALTER TABLE contrat_pret ADD CONSTRAINT FK_1FB84C67A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE contrat_pret ADD CONSTRAINT FK_1FB84C67CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id)');
        $this->addSql('ALTER TABLE couleur_instrument ADD CONSTRAINT FK_2E62255DC31BA576 FOREIGN KEY (couleur_id) REFERENCES couleur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE couleur_instrument ADD CONSTRAINT FK_2E62255DCF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C7C1CAAA9 FOREIGN KEY (type_instrument_id) REFERENCES type_instrument (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CBAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C220C6AD0 FOREIGN KEY (jour_id) REFERENCES jour (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D67ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE instrument ADD CONSTRAINT FK_3CBF69DD4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE instrument ADD CONSTRAINT FK_3CBF69DDC54C8C93 FOREIGN KEY (type_id) REFERENCES type_instrument (id)');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814AB8A49CC82 FOREIGN KEY (professionnel_id) REFERENCES professionnel (id)');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814ABCF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id)');
        $this->addSql('ALTER TABLE metier_professionnel ADD CONSTRAINT FK_FA14296CED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE metier_professionnel ADD CONSTRAINT FK_FA14296C8A49CC82 FOREIGN KEY (professionnel_id) REFERENCES professionnel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE paiment ADD CONSTRAINT FK_DC8138F5DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id)');
        $this->addSql('ALTER TABLE paiment ADD CONSTRAINT FK_DC8138FA6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE paiment ADD CONSTRAINT FK_DC8138FF2C3D606 FOREIGN KEY (quotient_id) REFERENCES tranche_quotient (id)');
        $this->addSql('ALTER TABLE professeur_type_instrument ADD CONSTRAINT FK_1E1989D6BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE professeur_type_instrument ADD CONSTRAINT FK_1E1989D67C1CAAA9 FOREIGN KEY (type_instrument_id) REFERENCES type_instrument (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE responsable ADD CONSTRAINT FK_52520D07F2C3D606 FOREIGN KEY (quotient_id) REFERENCES tranche_quotient (id)');
        $this->addSql('ALTER TABLE responsable ADD CONSTRAINT FK_52520D07A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE responsable_eleve ADD CONSTRAINT FK_8D30209553C59D72 FOREIGN KEY (responsable_id) REFERENCES responsable (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE responsable_eleve ADD CONSTRAINT FK_8D302095A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tarif ADD CONSTRAINT FK_E7189C9C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE tarif_cours ADD CONSTRAINT FK_24FE176C1FCAE54 FOREIGN KEY (tranche_quotient_id_id) REFERENCES tranche_quotient (id)');
        $this->addSql('ALTER TABLE tarif_cours ADD CONSTRAINT FK_24FE176C4F221781 FOREIGN KEY (cours_id_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE type_instrument ADD CONSTRAINT FK_21BCBFF8CE879FB1 FOREIGN KEY (classe_instrument_id) REFERENCES type_instrument (id)');
        $this->addSql('ALTER TABLE type_instrument ADD CONSTRAINT FK_21BCBFF8F7D7F589 FOREIGN KEY (classeinstrument_id) REFERENCES classe_instrument (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accessoire DROP FOREIGN KEY FK_8FD026ACF11D9C');
        $this->addSql('ALTER TABLE contrat_pret DROP FOREIGN KEY FK_1FB84C67A6CC7B2');
        $this->addSql('ALTER TABLE contrat_pret DROP FOREIGN KEY FK_1FB84C67CF11D9C');
        $this->addSql('ALTER TABLE couleur_instrument DROP FOREIGN KEY FK_2E62255DC31BA576');
        $this->addSql('ALTER TABLE couleur_instrument DROP FOREIGN KEY FK_2E62255DCF11D9C');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CC54C8C93');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C7C1CAAA9');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CBAB22EE9');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C220C6AD0');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7A76ED395');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D67ECF78B0');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6A6CC7B2');
        $this->addSql('ALTER TABLE instrument DROP FOREIGN KEY FK_3CBF69DD4827B9B2');
        $this->addSql('ALTER TABLE instrument DROP FOREIGN KEY FK_3CBF69DDC54C8C93');
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814AB8A49CC82');
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814ABCF11D9C');
        $this->addSql('ALTER TABLE metier_professionnel DROP FOREIGN KEY FK_FA14296CED16FA20');
        $this->addSql('ALTER TABLE metier_professionnel DROP FOREIGN KEY FK_FA14296C8A49CC82');
        $this->addSql('ALTER TABLE paiment DROP FOREIGN KEY FK_DC8138F5DAC5993');
        $this->addSql('ALTER TABLE paiment DROP FOREIGN KEY FK_DC8138FA6CC7B2');
        $this->addSql('ALTER TABLE paiment DROP FOREIGN KEY FK_DC8138FF2C3D606');
        $this->addSql('ALTER TABLE professeur_type_instrument DROP FOREIGN KEY FK_1E1989D6BAB22EE9');
        $this->addSql('ALTER TABLE professeur_type_instrument DROP FOREIGN KEY FK_1E1989D67C1CAAA9');
        $this->addSql('ALTER TABLE responsable DROP FOREIGN KEY FK_52520D07F2C3D606');
        $this->addSql('ALTER TABLE responsable DROP FOREIGN KEY FK_52520D07A76ED395');
        $this->addSql('ALTER TABLE responsable_eleve DROP FOREIGN KEY FK_8D30209553C59D72');
        $this->addSql('ALTER TABLE responsable_eleve DROP FOREIGN KEY FK_8D302095A6CC7B2');
        $this->addSql('ALTER TABLE tarif DROP FOREIGN KEY FK_E7189C9C54C8C93');
        $this->addSql('ALTER TABLE tarif_cours DROP FOREIGN KEY FK_24FE176C1FCAE54');
        $this->addSql('ALTER TABLE tarif_cours DROP FOREIGN KEY FK_24FE176C4F221781');
        $this->addSql('ALTER TABLE type_instrument DROP FOREIGN KEY FK_21BCBFF8CE879FB1');
        $this->addSql('ALTER TABLE type_instrument DROP FOREIGN KEY FK_21BCBFF8F7D7F589');
        $this->addSql('DROP TABLE accessoire');
        $this->addSql('DROP TABLE classe_instrument');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE contrat_pret');
        $this->addSql('DROP TABLE couleur');
        $this->addSql('DROP TABLE couleur_instrument');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE eleve');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE instrument');
        $this->addSql('DROP TABLE intervention');
        $this->addSql('DROP TABLE jour');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE metier');
        $this->addSql('DROP TABLE metier_professionnel');
        $this->addSql('DROP TABLE paiment');
        $this->addSql('DROP TABLE professeur');
        $this->addSql('DROP TABLE professeur_type_instrument');
        $this->addSql('DROP TABLE professionnel');
        $this->addSql('DROP TABLE responsable');
        $this->addSql('DROP TABLE responsable_eleve');
        $this->addSql('DROP TABLE tarif');
        $this->addSql('DROP TABLE tarif_cours');
        $this->addSql('DROP TABLE tranche_quotient');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE type_instrument');
        $this->addSql('DROP TABLE user');
    }
}
