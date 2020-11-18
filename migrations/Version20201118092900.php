<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201118092900 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE salle_zone (salle_id INT NOT NULL, zone_id INT NOT NULL, INDEX IDX_1D6B8987DC304035 (salle_id), INDEX IDX_1D6B89879F2C3FAB (zone_id), PRIMARY KEY(salle_id, zone_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket_salle (ticket_id INT NOT NULL, salle_id INT NOT NULL, INDEX IDX_66A71DD7700047D2 (ticket_id), INDEX IDX_66A71DD7DC304035 (salle_id), PRIMARY KEY(ticket_id, salle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE salle_zone ADD CONSTRAINT FK_1D6B8987DC304035 FOREIGN KEY (salle_id) REFERENCES salle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salle_zone ADD CONSTRAINT FK_1D6B89879F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ticket_salle ADD CONSTRAINT FK_66A71DD7700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ticket_salle ADD CONSTRAINT FK_66A71DD7DC304035 FOREIGN KEY (salle_id) REFERENCES salle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salle DROP FOREIGN KEY FK_4E977E5C9F2C3FAB');
        $this->addSql('DROP INDEX IDX_4E977E5C9F2C3FAB ON salle');
        $this->addSql('ALTER TABLE salle DROP zone_id');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3DC304035');
        $this->addSql('DROP INDEX IDX_97A0ADA3DC304035 ON ticket');
        $this->addSql('ALTER TABLE ticket DROP salle_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE salle_zone');
        $this->addSql('DROP TABLE ticket_salle');
        $this->addSql('ALTER TABLE salle ADD zone_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE salle ADD CONSTRAINT FK_4E977E5C9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id)');
        $this->addSql('CREATE INDEX IDX_4E977E5C9F2C3FAB ON salle (zone_id)');
        $this->addSql('ALTER TABLE ticket ADD salle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3DC304035 FOREIGN KEY (salle_id) REFERENCES salle (id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3DC304035 ON ticket (salle_id)');
    }
}
