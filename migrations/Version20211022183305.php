<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211022183305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE joueurs_saison');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE joueurs_saison (joueurs_id INT NOT NULL, saison_id INT NOT NULL, INDEX IDX_73DD3107A3DC7281 (joueurs_id), INDEX IDX_73DD3107F965414C (saison_id), PRIMARY KEY(joueurs_id, saison_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE joueurs_saison ADD CONSTRAINT FK_73DD3107A3DC7281 FOREIGN KEY (joueurs_id) REFERENCES joueurs (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE joueurs_saison ADD CONSTRAINT FK_73DD3107F965414C FOREIGN KEY (saison_id) REFERENCES saison (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
