<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201117143141 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE salle_ticket (salle_id INT NOT NULL, ticket_id INT NOT NULL, INDEX IDX_A323715CDC304035 (salle_id), INDEX IDX_A323715C700047D2 (ticket_id), PRIMARY KEY(salle_id, ticket_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE salle_ticket ADD CONSTRAINT FK_A323715CDC304035 FOREIGN KEY (salle_id) REFERENCES salle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salle_ticket ADD CONSTRAINT FK_A323715C700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3DC304035');
        $this->addSql('DROP INDEX IDX_97A0ADA3DC304035 ON ticket');
        $this->addSql('ALTER TABLE ticket DROP salle_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE salle_ticket');
        $this->addSql('ALTER TABLE ticket ADD salle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3DC304035 FOREIGN KEY (salle_id) REFERENCES salle (id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3DC304035 ON ticket (salle_id)');
    }
}
