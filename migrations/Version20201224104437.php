<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201224104437 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE criticite (id INT AUTO_INCREMENT NOT NULL, nom_criticite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervention (id INT AUTO_INCREMENT NOT NULL, description_intervention VARCHAR(255) DEFAULT NULL, description_refus VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiel (id INT AUTO_INCREMENT NOT NULL, nom_materiel VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiel_ticket (materiel_id INT NOT NULL, ticket_id INT NOT NULL, INDEX IDX_5B7E779416880AAF (materiel_id), INDEX IDX_5B7E7794700047D2 (ticket_id), PRIMARY KEY(materiel_id, ticket_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, nom_niveau VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau_zone (niveau_id INT NOT NULL, zone_id INT NOT NULL, INDEX IDX_12A7ABCAB3E9C81 (niveau_id), INDEX IDX_12A7ABCA9F2C3FAB (zone_id), PRIMARY KEY(niveau_id, zone_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, nom_role VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle (id INT AUTO_INCREMENT NOT NULL, numero_salle VARCHAR(10) NOT NULL, etat_salle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle_ticket (salle_id INT NOT NULL, ticket_id INT NOT NULL, INDEX IDX_A323715CDC304035 (salle_id), INDEX IDX_A323715C700047D2 (ticket_id), PRIMARY KEY(salle_id, ticket_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, nom_statut VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, intervention_id INT DEFAULT NULL, statut_id INT DEFAULT NULL, criticite_id INT DEFAULT NULL, titre_ticket VARCHAR(255) NOT NULL, description_ticket VARCHAR(255) NOT NULL, date_ticket DATETIME DEFAULT NULL, categorie_ticket VARCHAR(50) NOT NULL, INDEX IDX_97A0ADA3FB88E14F (utilisateur_id), UNIQUE INDEX UNIQ_97A0ADA38EAE3863 (intervention_id), INDEX IDX_97A0ADA3F6203804 (statut_id), INDEX IDX_97A0ADA3C141C0A0 (criticite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, nom_utilisateur VARCHAR(50) NOT NULL, prenom_utilisateur VARCHAR(50) NOT NULL, mail_utilisateur VARCHAR(50) NOT NULL, INDEX IDX_1D1C63B3D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zone (id INT AUTO_INCREMENT NOT NULL, nom_zone VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zone_salle (zone_id INT NOT NULL, salle_id INT NOT NULL, INDEX IDX_E8B9D1FA9F2C3FAB (zone_id), INDEX IDX_E8B9D1FADC304035 (salle_id), PRIMARY KEY(zone_id, salle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE materiel_ticket ADD CONSTRAINT FK_5B7E779416880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE materiel_ticket ADD CONSTRAINT FK_5B7E7794700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE niveau_zone ADD CONSTRAINT FK_12A7ABCAB3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE niveau_zone ADD CONSTRAINT FK_12A7ABCA9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salle_ticket ADD CONSTRAINT FK_A323715CDC304035 FOREIGN KEY (salle_id) REFERENCES salle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salle_ticket ADD CONSTRAINT FK_A323715C700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA38EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3C141C0A0 FOREIGN KEY (criticite_id) REFERENCES criticite (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE zone_salle ADD CONSTRAINT FK_E8B9D1FA9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE zone_salle ADD CONSTRAINT FK_E8B9D1FADC304035 FOREIGN KEY (salle_id) REFERENCES salle (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3C141C0A0');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA38EAE3863');
        $this->addSql('ALTER TABLE materiel_ticket DROP FOREIGN KEY FK_5B7E779416880AAF');
        $this->addSql('ALTER TABLE niveau_zone DROP FOREIGN KEY FK_12A7ABCAB3E9C81');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3D60322AC');
        $this->addSql('ALTER TABLE salle_ticket DROP FOREIGN KEY FK_A323715CDC304035');
        $this->addSql('ALTER TABLE zone_salle DROP FOREIGN KEY FK_E8B9D1FADC304035');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3F6203804');
        $this->addSql('ALTER TABLE materiel_ticket DROP FOREIGN KEY FK_5B7E7794700047D2');
        $this->addSql('ALTER TABLE salle_ticket DROP FOREIGN KEY FK_A323715C700047D2');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3FB88E14F');
        $this->addSql('ALTER TABLE niveau_zone DROP FOREIGN KEY FK_12A7ABCA9F2C3FAB');
        $this->addSql('ALTER TABLE zone_salle DROP FOREIGN KEY FK_E8B9D1FA9F2C3FAB');
        $this->addSql('DROP TABLE criticite');
        $this->addSql('DROP TABLE intervention');
        $this->addSql('DROP TABLE materiel');
        $this->addSql('DROP TABLE materiel_ticket');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE niveau_zone');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE salle');
        $this->addSql('DROP TABLE salle_ticket');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE zone');
        $this->addSql('DROP TABLE zone_salle');
    }
}
