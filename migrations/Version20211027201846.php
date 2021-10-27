<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211027201846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE but (id INT AUTO_INCREMENT NOT NULL, joueur_id INT DEFAULT NULL, matchs_id INT DEFAULT NULL, minute_but INT DEFAULT NULL, type_but VARCHAR(255) DEFAULT NULL, INDEX IDX_B132FECAA9E2D76C (joueur_id), INDEX IDX_B132FECA88EB7468 (matchs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, niveau_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_2449BA15B3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe_saison (equipe_id INT NOT NULL, saison_id INT NOT NULL, INDEX IDX_CDE7B32E6D861B89 (equipe_id), INDEX IDX_CDE7B32EF965414C (saison_id), PRIMARY KEY(equipe_id, saison_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe_joueurs (equipe_id INT NOT NULL, joueurs_id INT NOT NULL, INDEX IDX_28FD94216D861B89 (equipe_id), INDEX IDX_28FD9421A3DC7281 (joueurs_id), PRIMARY KEY(equipe_id, joueurs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe_saison_joueur (id INT AUTO_INCREMENT NOT NULL, equipe_id INT DEFAULT NULL, saison_id INT DEFAULT NULL, joueur_id INT DEFAULT NULL, INDEX IDX_194D40486D861B89 (equipe_id), INDEX IDX_194D4048F965414C (saison_id), INDEX IDX_194D4048A9E2D76C (joueur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueurs (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, photo_joueur LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matchs (id INT AUTO_INCREMENT NOT NULL, equipe_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, date_match DATE DEFAULT NULL, heure_match TIME DEFAULT NULL, INDEX IDX_6B1E60416D861B89 (equipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matchs_saison (matchs_id INT NOT NULL, saison_id INT NOT NULL, INDEX IDX_E09C1A7388EB7468 (matchs_id), INDEX IDX_E09C1A73F965414C (saison_id), PRIMARY KEY(matchs_id, saison_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participation (id INT AUTO_INCREMENT NOT NULL, joueur_id INT DEFAULT NULL, matchs_id INT NOT NULL, minutes_jeu INT DEFAULT NULL, INDEX IDX_AB55E24FA9E2D76C (joueur_id), INDEX IDX_AB55E24F88EB7468 (matchs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE passe_decisive (id INT AUTO_INCREMENT NOT NULL, joueur_id INT DEFAULT NULL, matchs_id INT DEFAULT NULL, minute_passe INT DEFAULT NULL, INDEX IDX_ABDCFE8DA9E2D76C (joueur_id), INDEX IDX_ABDCFE8D88EB7468 (matchs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saison (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saison_joueurs (saison_id INT NOT NULL, joueurs_id INT NOT NULL, INDEX IDX_13313DABF965414C (saison_id), INDEX IDX_13313DABA3DC7281 (joueurs_id), PRIMARY KEY(saison_id, joueurs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, roles JSON NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE but ADD CONSTRAINT FK_B132FECAA9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueurs (id)');
        $this->addSql('ALTER TABLE but ADD CONSTRAINT FK_B132FECA88EB7468 FOREIGN KEY (matchs_id) REFERENCES matchs (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE equipe_saison ADD CONSTRAINT FK_CDE7B32E6D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe_saison ADD CONSTRAINT FK_CDE7B32EF965414C FOREIGN KEY (saison_id) REFERENCES saison (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe_joueurs ADD CONSTRAINT FK_28FD94216D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe_joueurs ADD CONSTRAINT FK_28FD9421A3DC7281 FOREIGN KEY (joueurs_id) REFERENCES joueurs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe_saison_joueur ADD CONSTRAINT FK_194D40486D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE equipe_saison_joueur ADD CONSTRAINT FK_194D4048F965414C FOREIGN KEY (saison_id) REFERENCES saison (id)');
        $this->addSql('ALTER TABLE equipe_saison_joueur ADD CONSTRAINT FK_194D4048A9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueurs (id)');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E60416D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE matchs_saison ADD CONSTRAINT FK_E09C1A7388EB7468 FOREIGN KEY (matchs_id) REFERENCES matchs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matchs_saison ADD CONSTRAINT FK_E09C1A73F965414C FOREIGN KEY (saison_id) REFERENCES saison (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FA9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueurs (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F88EB7468 FOREIGN KEY (matchs_id) REFERENCES matchs (id)');
        $this->addSql('ALTER TABLE passe_decisive ADD CONSTRAINT FK_ABDCFE8DA9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueurs (id)');
        $this->addSql('ALTER TABLE passe_decisive ADD CONSTRAINT FK_ABDCFE8D88EB7468 FOREIGN KEY (matchs_id) REFERENCES matchs (id)');
        $this->addSql('ALTER TABLE saison_joueurs ADD CONSTRAINT FK_13313DABF965414C FOREIGN KEY (saison_id) REFERENCES saison (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE saison_joueurs ADD CONSTRAINT FK_13313DABA3DC7281 FOREIGN KEY (joueurs_id) REFERENCES joueurs (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe_saison DROP FOREIGN KEY FK_CDE7B32E6D861B89');
        $this->addSql('ALTER TABLE equipe_joueurs DROP FOREIGN KEY FK_28FD94216D861B89');
        $this->addSql('ALTER TABLE equipe_saison_joueur DROP FOREIGN KEY FK_194D40486D861B89');
        $this->addSql('ALTER TABLE matchs DROP FOREIGN KEY FK_6B1E60416D861B89');
        $this->addSql('ALTER TABLE but DROP FOREIGN KEY FK_B132FECAA9E2D76C');
        $this->addSql('ALTER TABLE equipe_joueurs DROP FOREIGN KEY FK_28FD9421A3DC7281');
        $this->addSql('ALTER TABLE equipe_saison_joueur DROP FOREIGN KEY FK_194D4048A9E2D76C');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24FA9E2D76C');
        $this->addSql('ALTER TABLE passe_decisive DROP FOREIGN KEY FK_ABDCFE8DA9E2D76C');
        $this->addSql('ALTER TABLE saison_joueurs DROP FOREIGN KEY FK_13313DABA3DC7281');
        $this->addSql('ALTER TABLE but DROP FOREIGN KEY FK_B132FECA88EB7468');
        $this->addSql('ALTER TABLE matchs_saison DROP FOREIGN KEY FK_E09C1A7388EB7468');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F88EB7468');
        $this->addSql('ALTER TABLE passe_decisive DROP FOREIGN KEY FK_ABDCFE8D88EB7468');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15B3E9C81');
        $this->addSql('ALTER TABLE equipe_saison DROP FOREIGN KEY FK_CDE7B32EF965414C');
        $this->addSql('ALTER TABLE equipe_saison_joueur DROP FOREIGN KEY FK_194D4048F965414C');
        $this->addSql('ALTER TABLE matchs_saison DROP FOREIGN KEY FK_E09C1A73F965414C');
        $this->addSql('ALTER TABLE saison_joueurs DROP FOREIGN KEY FK_13313DABF965414C');
        $this->addSql('DROP TABLE but');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE equipe_saison');
        $this->addSql('DROP TABLE equipe_joueurs');
        $this->addSql('DROP TABLE equipe_saison_joueur');
        $this->addSql('DROP TABLE joueurs');
        $this->addSql('DROP TABLE matchs');
        $this->addSql('DROP TABLE matchs_saison');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE participation');
        $this->addSql('DROP TABLE passe_decisive');
        $this->addSql('DROP TABLE saison');
        $this->addSql('DROP TABLE saison_joueurs');
        $this->addSql('DROP TABLE utilisateur');
    }
}
