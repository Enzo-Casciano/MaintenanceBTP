<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201118160323 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE zone_salle (zone_id INT NOT NULL, salle_id INT NOT NULL, INDEX IDX_E8B9D1FA9F2C3FAB (zone_id), INDEX IDX_E8B9D1FADC304035 (salle_id), PRIMARY KEY(zone_id, salle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE zone_salle ADD CONSTRAINT FK_E8B9D1FA9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE zone_salle ADD CONSTRAINT FK_E8B9D1FADC304035 FOREIGN KEY (salle_id) REFERENCES salle (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE salle_zone');
        $this->addSql('ALTER TABLE zone CHANGE nom_zone nom_zone VARCHAR(30) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE salle_zone (salle_id INT NOT NULL, zone_id INT NOT NULL, INDEX IDX_1D6B8987DC304035 (salle_id), INDEX IDX_1D6B89879F2C3FAB (zone_id), PRIMARY KEY(salle_id, zone_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE salle_zone ADD CONSTRAINT FK_1D6B89879F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salle_zone ADD CONSTRAINT FK_1D6B8987DC304035 FOREIGN KEY (salle_id) REFERENCES salle (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE zone_salle');
        $this->addSql('ALTER TABLE zone CHANGE nom_zone nom_zone VARCHAR(15) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
