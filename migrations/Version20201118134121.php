<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201118134121 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ticket_salle');
        $this->addSql('ALTER TABLE salle CHANGE etat_salle etat_salle VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE ticket CHANGE date_ticket date_ticket DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ticket_salle (ticket_id INT NOT NULL, salle_id INT NOT NULL, INDEX IDX_66A71DD7700047D2 (ticket_id), INDEX IDX_66A71DD7DC304035 (salle_id), PRIMARY KEY(ticket_id, salle_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ticket_salle ADD CONSTRAINT FK_66A71DD7700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ticket_salle ADD CONSTRAINT FK_66A71DD7DC304035 FOREIGN KEY (salle_id) REFERENCES salle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salle CHANGE etat_salle etat_salle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE ticket CHANGE date_ticket date_ticket DATETIME NOT NULL');
    }
}
