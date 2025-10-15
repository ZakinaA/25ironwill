<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251013150022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classe_instrument (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, num_rue INT NOT NULL, rue VARCHAR(255) NOT NULL, copos INT NOT NULL, ville VARCHAR(70) NOT NULL, tel INT NOT NULL, mail VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur_type_instrument (professeur_id INT NOT NULL, type_instrument_id INT NOT NULL, INDEX IDX_1E1989D6BAB22EE9 (professeur_id), INDEX IDX_1E1989D67C1CAAA9 (type_instrument_id), PRIMARY KEY(professeur_id, type_instrument_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_instrument (id INT AUTO_INCREMENT NOT NULL, classe_instrument_id INT DEFAULT NULL, libelle VARCHAR(255) DEFAULT NULL, INDEX IDX_21BCBFF8CE879FB1 (classe_instrument_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE professeur_type_instrument ADD CONSTRAINT FK_1E1989D6BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE professeur_type_instrument ADD CONSTRAINT FK_1E1989D67C1CAAA9 FOREIGN KEY (type_instrument_id) REFERENCES type_instrument (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_instrument ADD CONSTRAINT FK_21BCBFF8CE879FB1 FOREIGN KEY (classe_instrument_id) REFERENCES type_instrument (id)');
        $this->addSql('ALTER TABLE instrument ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE instrument ADD CONSTRAINT FK_3CBF69DDC54C8C93 FOREIGN KEY (type_id) REFERENCES type_instrument (id)');
        $this->addSql('CREATE INDEX IDX_3CBF69DDC54C8C93 ON instrument (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE instrument DROP FOREIGN KEY FK_3CBF69DDC54C8C93');
        $this->addSql('ALTER TABLE professeur_type_instrument DROP FOREIGN KEY FK_1E1989D6BAB22EE9');
        $this->addSql('ALTER TABLE professeur_type_instrument DROP FOREIGN KEY FK_1E1989D67C1CAAA9');
        $this->addSql('ALTER TABLE type_instrument DROP FOREIGN KEY FK_21BCBFF8CE879FB1');
        $this->addSql('DROP TABLE classe_instrument');
        $this->addSql('DROP TABLE professeur');
        $this->addSql('DROP TABLE professeur_type_instrument');
        $this->addSql('DROP TABLE type_instrument');
        $this->addSql('DROP INDEX IDX_3CBF69DDC54C8C93 ON instrument');
        $this->addSql('ALTER TABLE instrument DROP type_id');
    }
}
