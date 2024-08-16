<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240816141703 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE AlerteJaune (id INT AUTO_INCREMENT NOT NULL, nomAlerte VARCHAR(255) NOT NULL, avantNombreJour INT NOT NULL, avantNombreMoi INT NOT NULL, avantNombreAnnee INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE AlerteRouge (id INT AUTO_INCREMENT NOT NULL, nomAlerte VARCHAR(255) NOT NULL, avantNombreJour INT NOT NULL, avantNombreMoi INT NOT NULL, avantNombreAnnee INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE AlerteVert (id INT AUTO_INCREMENT NOT NULL, nomAlerte VARCHAR(255) NOT NULL, avantNombreJour INT NOT NULL, avantNombreMoi INT NOT NULL, avantNombreAnnee INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Articles (id INT AUTO_INCREMENT NOT NULL, refArticle VARCHAR(32) NOT NULL, libArticle VARCHAR(250) NOT NULL, descCourte LONGTEXT DEFAULT NULL, descLongue LONGTEXT DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, content_changed DATETIME DEFAULT NULL, fruitDeMer_id INT NOT NULL, INDEX IDX_46AB533EA8A02557 (fruitDeMer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Corde (id INT AUTO_INCREMENT NOT NULL, parc_id INT DEFAULT NULL, quantiter INT NOT NULL, nom VARCHAR(255) NOT NULL, longeur DOUBLE PRECISION NOT NULL, INDEX IDX_D108B59B812D24CA (parc_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Cycle (id INT AUTO_INCREMENT NOT NULL, processus_id INT NOT NULL, nomCycle VARCHAR(255) NOT NULL, numDebCycle INT NOT NULL, numFinCycle INT NOT NULL, couleurTexte VARCHAR(255) DEFAULT NULL, couleurFondText VARCHAR(255) DEFAULT NULL, alerteVert_id INT NOT NULL, alerteJaune_id INT NOT NULL, alerteRouge_id INT NOT NULL, INDEX IDX_7147FE97A55629DC (processus_id), INDEX IDX_7147FE97F141ED2B (alerteVert_id), INDEX IDX_7147FE97D640B227 (alerteJaune_id), INDEX IDX_7147FE9724318195 (alerteRouge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Emplacement (id INT AUTO_INCREMENT NOT NULL, segment_id INT NOT NULL, place INT NOT NULL, dateRemplissage DATETIME DEFAULT NULL, INDEX IDX_4653EA21DB296AAD (segment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Filiere (id INT AUTO_INCREMENT NOT NULL, parc_id INT NOT NULL, nomFiliere VARCHAR(255) NOT NULL, observation LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', aireDeTravaille TINYINT(1) NOT NULL, INDEX IDX_E16D6402812D24CA (parc_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Flotteur (id INT AUTO_INCREMENT NOT NULL, nomFlotteur VARCHAR(255) NOT NULL, volume INT NOT NULL, kgf DOUBLE PRECISION DEFAULT NULL, taux DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE FlotteurSegment (id INT AUTO_INCREMENT NOT NULL, segment_id INT NOT NULL, flotteur_id INT NOT NULL, nombre INT NOT NULL, distanceDeDepart DOUBLE PRECISION NOT NULL, pas DOUBLE PRECISION NOT NULL, INDEX IDX_F011EA39DB296AAD (segment_id), INDEX IDX_F011EA399AE7A92D (flotteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE FruitDeMer (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Lanterne (id INT AUTO_INCREMENT NOT NULL, parc_id INT DEFAULT NULL, quantiter INT NOT NULL, nom VARCHAR(255) NOT NULL, nbrPoche SMALLINT NOT NULL, INDEX IDX_95560F4E812D24CA (parc_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Parc (id INT AUTO_INCREMENT NOT NULL, lib_parc VARCHAR(64) NOT NULL, abrev_parc VARCHAR(32) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Phase (id INT AUTO_INCREMENT NOT NULL, nomPhase VARCHAR(255) NOT NULL, ordreAffichage INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Poche (id INT AUTO_INCREMENT NOT NULL, position SMALLINT NOT NULL, piece INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Processus (id INT AUTO_INCREMENT NOT NULL, phase_id INT NOT NULL, nomProcessus VARCHAR(255) NOT NULL, INDEX IDX_6C1B0EBE99091188 (phase_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Segment (id INT AUTO_INCREMENT NOT NULL, filiere_id INT NOT NULL, nomSegment VARCHAR(255) NOT NULL, pas DOUBLE PRECISION NOT NULL, longeur DOUBLE PRECISION NOT NULL, INDEX IDX_D73CCCF9180AA129 (filiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE SonataUserUser (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_5059623892FC23A8 (username_canonical), UNIQUE INDEX UNIQ_50596238A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_50596238C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Stock (id INT AUTO_INCREMENT NOT NULL, parc_id INT DEFAULT NULL, libStock VARCHAR(32) NOT NULL, abrevStock VARCHAR(32) NOT NULL, actif TINYINT(1) NOT NULL, INDEX IDX_8AF77964812D24CA (parc_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE StockArticle (id INT AUTO_INCREMENT NOT NULL, stock_id INT DEFAULT NULL, article_id INT NOT NULL, quantiter INT NOT NULL, INDEX IDX_E6A3D917DCD6110 (stock_id), INDEX IDX_E6A3D9177294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE StockArticleSn (id INT AUTO_INCREMENT NOT NULL, snQte DOUBLE PRECISION NOT NULL, numeroSerie VARCHAR(32) NOT NULL, stockArticle_id INT NOT NULL, INDEX IDX_80C95872E8C8C2B9 (stockArticle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE StockCorde (id INT AUTO_INCREMENT NOT NULL, corde_id INT NOT NULL, emplacement_id INT DEFAULT NULL, quantiter INT NOT NULL, pret TINYINT(1) NOT NULL, datedecreation DATE NOT NULL, datederetirement DATE DEFAULT NULL, datederetraittransfert DATE DEFAULT NULL, datedemaetransfert DATE DEFAULT NULL, dateDeMiseAEaudate DATE DEFAULT NULL, chaussement TINYINT(1) NOT NULL, dateassemblage DATE DEFAULT NULL, datechaussement DATE DEFAULT NULL, stockArticleSn_id INT DEFAULT NULL, INDEX IDX_DA6A9E94F9182269 (corde_id), INDEX IDX_DA6A9E948F4DE63C (stockArticleSn_id), INDEX IDX_DA6A9E94C4598A51 (emplacement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE StockLanterne (id INT AUTO_INCREMENT NOT NULL, quantiter INT NOT NULL, pret TINYINT(1) NOT NULL, datedecreation DATE NOT NULL, datederetirement DATE DEFAULT NULL, datederetraittransfert DATE DEFAULT NULL, datedemaetransfert DATE DEFAULT NULL, dateDeMiseAEaudate DATE DEFAULT NULL, chaussement TINYINT(1) NOT NULL, dateassemblage DATE DEFAULT NULL, datechaussement DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE StockPoche (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Articles ADD CONSTRAINT FK_46AB533EA8A02557 FOREIGN KEY (fruitDeMer_id) REFERENCES FruitDeMer (id)');
        $this->addSql('ALTER TABLE Corde ADD CONSTRAINT FK_D108B59B812D24CA FOREIGN KEY (parc_id) REFERENCES Parc (id)');
        $this->addSql('ALTER TABLE Cycle ADD CONSTRAINT FK_7147FE97A55629DC FOREIGN KEY (processus_id) REFERENCES Processus (id)');
        $this->addSql('ALTER TABLE Cycle ADD CONSTRAINT FK_7147FE97F141ED2B FOREIGN KEY (alerteVert_id) REFERENCES AlerteVert (id)');
        $this->addSql('ALTER TABLE Cycle ADD CONSTRAINT FK_7147FE97D640B227 FOREIGN KEY (alerteJaune_id) REFERENCES AlerteJaune (id)');
        $this->addSql('ALTER TABLE Cycle ADD CONSTRAINT FK_7147FE9724318195 FOREIGN KEY (alerteRouge_id) REFERENCES AlerteRouge (id)');
        $this->addSql('ALTER TABLE Emplacement ADD CONSTRAINT FK_4653EA21DB296AAD FOREIGN KEY (segment_id) REFERENCES Segment (id)');
        $this->addSql('ALTER TABLE Filiere ADD CONSTRAINT FK_E16D6402812D24CA FOREIGN KEY (parc_id) REFERENCES Parc (id)');
        $this->addSql('ALTER TABLE FlotteurSegment ADD CONSTRAINT FK_F011EA39DB296AAD FOREIGN KEY (segment_id) REFERENCES Segment (id)');
        $this->addSql('ALTER TABLE FlotteurSegment ADD CONSTRAINT FK_F011EA399AE7A92D FOREIGN KEY (flotteur_id) REFERENCES Flotteur (id)');
        $this->addSql('ALTER TABLE Lanterne ADD CONSTRAINT FK_95560F4E812D24CA FOREIGN KEY (parc_id) REFERENCES Parc (id)');
        $this->addSql('ALTER TABLE Processus ADD CONSTRAINT FK_6C1B0EBE99091188 FOREIGN KEY (phase_id) REFERENCES Phase (id)');
        $this->addSql('ALTER TABLE Segment ADD CONSTRAINT FK_D73CCCF9180AA129 FOREIGN KEY (filiere_id) REFERENCES Filiere (id)');
        $this->addSql('ALTER TABLE Stock ADD CONSTRAINT FK_8AF77964812D24CA FOREIGN KEY (parc_id) REFERENCES Parc (id)');
        $this->addSql('ALTER TABLE StockArticle ADD CONSTRAINT FK_E6A3D917DCD6110 FOREIGN KEY (stock_id) REFERENCES Stock (id)');
        $this->addSql('ALTER TABLE StockArticle ADD CONSTRAINT FK_E6A3D9177294869C FOREIGN KEY (article_id) REFERENCES Articles (id)');
        $this->addSql('ALTER TABLE StockArticleSn ADD CONSTRAINT FK_80C95872E8C8C2B9 FOREIGN KEY (stockArticle_id) REFERENCES StockArticle (id)');
        $this->addSql('ALTER TABLE StockCorde ADD CONSTRAINT FK_DA6A9E94F9182269 FOREIGN KEY (corde_id) REFERENCES Corde (id)');
        $this->addSql('ALTER TABLE StockCorde ADD CONSTRAINT FK_DA6A9E948F4DE63C FOREIGN KEY (stockArticleSn_id) REFERENCES StockArticleSn (id)');
        $this->addSql('ALTER TABLE StockCorde ADD CONSTRAINT FK_DA6A9E94C4598A51 FOREIGN KEY (emplacement_id) REFERENCES Emplacement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Articles DROP FOREIGN KEY FK_46AB533EA8A02557');
        $this->addSql('ALTER TABLE Corde DROP FOREIGN KEY FK_D108B59B812D24CA');
        $this->addSql('ALTER TABLE Cycle DROP FOREIGN KEY FK_7147FE97A55629DC');
        $this->addSql('ALTER TABLE Cycle DROP FOREIGN KEY FK_7147FE97F141ED2B');
        $this->addSql('ALTER TABLE Cycle DROP FOREIGN KEY FK_7147FE97D640B227');
        $this->addSql('ALTER TABLE Cycle DROP FOREIGN KEY FK_7147FE9724318195');
        $this->addSql('ALTER TABLE Emplacement DROP FOREIGN KEY FK_4653EA21DB296AAD');
        $this->addSql('ALTER TABLE Filiere DROP FOREIGN KEY FK_E16D6402812D24CA');
        $this->addSql('ALTER TABLE FlotteurSegment DROP FOREIGN KEY FK_F011EA39DB296AAD');
        $this->addSql('ALTER TABLE FlotteurSegment DROP FOREIGN KEY FK_F011EA399AE7A92D');
        $this->addSql('ALTER TABLE Lanterne DROP FOREIGN KEY FK_95560F4E812D24CA');
        $this->addSql('ALTER TABLE Processus DROP FOREIGN KEY FK_6C1B0EBE99091188');
        $this->addSql('ALTER TABLE Segment DROP FOREIGN KEY FK_D73CCCF9180AA129');
        $this->addSql('ALTER TABLE Stock DROP FOREIGN KEY FK_8AF77964812D24CA');
        $this->addSql('ALTER TABLE StockArticle DROP FOREIGN KEY FK_E6A3D917DCD6110');
        $this->addSql('ALTER TABLE StockArticle DROP FOREIGN KEY FK_E6A3D9177294869C');
        $this->addSql('ALTER TABLE StockArticleSn DROP FOREIGN KEY FK_80C95872E8C8C2B9');
        $this->addSql('ALTER TABLE StockCorde DROP FOREIGN KEY FK_DA6A9E94F9182269');
        $this->addSql('ALTER TABLE StockCorde DROP FOREIGN KEY FK_DA6A9E948F4DE63C');
        $this->addSql('ALTER TABLE StockCorde DROP FOREIGN KEY FK_DA6A9E94C4598A51');
        $this->addSql('DROP TABLE AlerteJaune');
        $this->addSql('DROP TABLE AlerteRouge');
        $this->addSql('DROP TABLE AlerteVert');
        $this->addSql('DROP TABLE Articles');
        $this->addSql('DROP TABLE Corde');
        $this->addSql('DROP TABLE Cycle');
        $this->addSql('DROP TABLE Emplacement');
        $this->addSql('DROP TABLE Filiere');
        $this->addSql('DROP TABLE Flotteur');
        $this->addSql('DROP TABLE FlotteurSegment');
        $this->addSql('DROP TABLE FruitDeMer');
        $this->addSql('DROP TABLE Lanterne');
        $this->addSql('DROP TABLE Parc');
        $this->addSql('DROP TABLE Phase');
        $this->addSql('DROP TABLE Poche');
        $this->addSql('DROP TABLE Processus');
        $this->addSql('DROP TABLE Segment');
        $this->addSql('DROP TABLE SonataUserUser');
        $this->addSql('DROP TABLE Stock');
        $this->addSql('DROP TABLE StockArticle');
        $this->addSql('DROP TABLE StockArticleSn');
        $this->addSql('DROP TABLE StockCorde');
        $this->addSql('DROP TABLE StockLanterne');
        $this->addSql('DROP TABLE StockPoche');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
