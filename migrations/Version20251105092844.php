<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251105092844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tarif_cours (id INT AUTO_INCREMENT NOT NULL, tranche_quotient_id_id INT DEFAULT NULL, cours_id_id INT DEFAULT NULL, prix_facture NUMERIC(20, 0) NOT NULL, INDEX IDX_24FE176C1FCAE54 (tranche_quotient_id_id), INDEX IDX_24FE176C4F221781 (cours_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tarif_cours ADD CONSTRAINT FK_24FE176C1FCAE54 FOREIGN KEY (tranche_quotient_id_id) REFERENCES tranche_quotient (id)');
        $this->addSql('ALTER TABLE tarif_cours ADD CONSTRAINT FK_24FE176C4F221781 FOREIGN KEY (cours_id_id) REFERENCES type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarif_cours DROP FOREIGN KEY FK_24FE176C1FCAE54');
        $this->addSql('ALTER TABLE tarif_cours DROP FOREIGN KEY FK_24FE176C4F221781');
        $this->addSql('DROP TABLE tarif_cours');
    }
}
