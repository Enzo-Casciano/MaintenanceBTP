<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210210103013 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3C141C0A0');
        $this->addSql('DROP TABLE criticite');
        $this->addSql('DROP INDEX IDX_97A0ADA3C141C0A0 ON ticket');
        $this->addSql('ALTER TABLE ticket ADD nom_criticite VARCHAR(50) DEFAULT NULL, DROP criticite_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE criticite (id INT AUTO_INCREMENT NOT NULL, nom_criticite VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ticket ADD criticite_id INT DEFAULT NULL, DROP nom_criticite');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3C141C0A0 FOREIGN KEY (criticite_id) REFERENCES criticite (id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3C141C0A0 ON ticket (criticite_id)');
    }
}
