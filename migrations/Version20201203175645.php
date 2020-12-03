<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201203175645 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE criticite DROP FOREIGN KEY FK_6F33ED98700047D2');
        $this->addSql('DROP INDEX IDX_6F33ED98700047D2 ON criticite');
        $this->addSql('ALTER TABLE criticite DROP ticket_id');
        $this->addSql('ALTER TABLE ticket ADD criticite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3C141C0A0 FOREIGN KEY (criticite_id) REFERENCES criticite (id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3C141C0A0 ON ticket (criticite_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE criticite ADD ticket_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE criticite ADD CONSTRAINT FK_6F33ED98700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id)');
        $this->addSql('CREATE INDEX IDX_6F33ED98700047D2 ON criticite (ticket_id)');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3C141C0A0');
        $this->addSql('DROP INDEX IDX_97A0ADA3C141C0A0 ON ticket');
        $this->addSql('ALTER TABLE ticket DROP criticite_id');
    }
}
