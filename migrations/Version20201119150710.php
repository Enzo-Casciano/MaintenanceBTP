<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201119150710 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE salle_ticket (salle_id INT NOT NULL, ticket_id INT NOT NULL, INDEX IDX_A323715CDC304035 (salle_id), INDEX IDX_A323715C700047D2 (ticket_id), PRIMARY KEY(salle_id, ticket_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zone_salle (zone_id INT NOT NULL, salle_id INT NOT NULL, INDEX IDX_E8B9D1FA9F2C3FAB (zone_id), INDEX IDX_E8B9D1FADC304035 (salle_id), PRIMARY KEY(zone_id, salle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE salle_ticket ADD CONSTRAINT FK_A323715CDC304035 FOREIGN KEY (salle_id) REFERENCES salle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salle_ticket ADD CONSTRAINT FK_A323715C700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE zone_salle ADD CONSTRAINT FK_E8B9D1FA9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE zone_salle ADD CONSTRAINT FK_E8B9D1FADC304035 FOREIGN KEY (salle_id) REFERENCES salle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention DROP categorie_intervention');
        $this->addSql('ALTER TABLE salle DROP FOREIGN KEY FK_4E977E5C9F2C3FAB');
        $this->addSql('DROP INDEX IDX_4E977E5C9F2C3FAB ON salle');
        $this->addSql('ALTER TABLE salle DROP zone_id, CHANGE numero_salle numero_salle VARCHAR(10) NOT NULL, CHANGE etat_salle etat_salle VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3DC304035');
        $this->addSql('DROP INDEX IDX_97A0ADA3DC304035 ON ticket');
        $this->addSql('ALTER TABLE ticket ADD categorie_ticket VARCHAR(50) NOT NULL, DROP salle_id, CHANGE date_ticket date_ticket DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE zone CHANGE nom_zone nom_zone VARCHAR(30) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE salle_ticket');
        $this->addSql('DROP TABLE zone_salle');
        $this->addSql('ALTER TABLE intervention ADD categorie_intervention VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE salle ADD zone_id INT DEFAULT NULL, CHANGE numero_salle numero_salle VARCHAR(5) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE etat_salle etat_salle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE salle ADD CONSTRAINT FK_4E977E5C9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id)');
        $this->addSql('CREATE INDEX IDX_4E977E5C9F2C3FAB ON salle (zone_id)');
        $this->addSql('ALTER TABLE ticket ADD salle_id INT DEFAULT NULL, DROP categorie_ticket, CHANGE date_ticket date_ticket DATETIME NOT NULL');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3DC304035 FOREIGN KEY (salle_id) REFERENCES salle (id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3DC304035 ON ticket (salle_id)');
        $this->addSql('ALTER TABLE zone CHANGE nom_zone nom_zone VARCHAR(15) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}