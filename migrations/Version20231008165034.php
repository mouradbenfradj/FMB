<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231008165034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Articles (id INT AUTO_INCREMENT NOT NULL, refArticle VARCHAR(32) NOT NULL, libArticle VARCHAR(250) NOT NULL, descCourte LONGTEXT DEFAULT NULL, descLongue LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Corde (id INT AUTO_INCREMENT NOT NULL, parc_id INT DEFAULT NULL, quantiter INT NOT NULL, nomCorde VARCHAR(255) NOT NULL, INDEX IDX_D108B59B812D24CA (parc_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Emplacement (id INT AUTO_INCREMENT NOT NULL, flotteur_id INT NOT NULL, place INT NOT NULL, dateDeRemplissage DATE DEFAULT NULL, INDEX IDX_4653EA219AE7A92D (flotteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Filiere (id INT AUTO_INCREMENT NOT NULL, parc_id INT NOT NULL, nomFiliere VARCHAR(255) NOT NULL, observation LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', aireDeTravaille TINYINT(1) NOT NULL, INDEX IDX_E16D6402812D24CA (parc_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Flotteur (id INT AUTO_INCREMENT NOT NULL, segment_id INT NOT NULL, nomFlotteur VARCHAR(255) NOT NULL, INDEX IDX_75346AB1DB296AAD (segment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Lanterne (id INT AUTO_INCREMENT NOT NULL, parc_id INT DEFAULT NULL, nomLanterne VARCHAR(255) NOT NULL, quantiter INT NOT NULL, nbrPoche SMALLINT NOT NULL, INDEX IDX_95560F4E812D24CA (parc_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Parc (id INT AUTO_INCREMENT NOT NULL, id_parc SMALLINT NOT NULL, lib_parc VARCHAR(64) NOT NULL, abrev_parc VARCHAR(32) NOT NULL, UNIQUE INDEX UNIQ_6AEE5A3F8A32F657 (id_parc), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Poche (id INT AUTO_INCREMENT NOT NULL, position SMALLINT NOT NULL, piece INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Processus (id INT AUTO_INCREMENT NOT NULL, tree_root INT DEFAULT NULL, parent_id INT DEFAULT NULL, nomProcessus VARCHAR(255) NOT NULL, numeroDebCycle INT NOT NULL, limiteDuCycle INT NOT NULL, abrevProcessus VARCHAR(255) NOT NULL, duree LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', articleSortie VARCHAR(255) NOT NULL, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, INDEX IDX_6C1B0EBEA977936C (tree_root), INDEX IDX_6C1B0EBE727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Segment (id INT AUTO_INCREMENT NOT NULL, filiere_id INT NOT NULL, nomSegment VARCHAR(255) NOT NULL, longeur NUMERIC(10, 2) NOT NULL, INDEX IDX_D73CCCF9180AA129 (filiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE SonataUserUser (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_5059623892FC23A8 (username_canonical), UNIQUE INDEX UNIQ_50596238A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_50596238C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Stock (id INT AUTO_INCREMENT NOT NULL, parc_id INT DEFAULT NULL, libStock VARCHAR(32) NOT NULL, abrevStock VARCHAR(32) NOT NULL, actif TINYINT(1) NOT NULL, INDEX IDX_8AF77964812D24CA (parc_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE StocksArticles (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, stock_id INT NOT NULL, quantiter INT NOT NULL, INDEX IDX_A0CC0E137294869C (article_id), INDEX IDX_A0CC0E13DCD6110 (stock_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Corde ADD CONSTRAINT FK_D108B59B812D24CA FOREIGN KEY (parc_id) REFERENCES Parc (id)');
        $this->addSql('ALTER TABLE Emplacement ADD CONSTRAINT FK_4653EA219AE7A92D FOREIGN KEY (flotteur_id) REFERENCES Flotteur (id)');
        $this->addSql('ALTER TABLE Filiere ADD CONSTRAINT FK_E16D6402812D24CA FOREIGN KEY (parc_id) REFERENCES Parc (id)');
        $this->addSql('ALTER TABLE Flotteur ADD CONSTRAINT FK_75346AB1DB296AAD FOREIGN KEY (segment_id) REFERENCES Segment (id)');
        $this->addSql('ALTER TABLE Lanterne ADD CONSTRAINT FK_95560F4E812D24CA FOREIGN KEY (parc_id) REFERENCES Parc (id)');
        $this->addSql('ALTER TABLE Processus ADD CONSTRAINT FK_6C1B0EBEA977936C FOREIGN KEY (tree_root) REFERENCES Processus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Processus ADD CONSTRAINT FK_6C1B0EBE727ACA70 FOREIGN KEY (parent_id) REFERENCES Processus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Segment ADD CONSTRAINT FK_D73CCCF9180AA129 FOREIGN KEY (filiere_id) REFERENCES Filiere (id)');
        $this->addSql('ALTER TABLE Stock ADD CONSTRAINT FK_8AF77964812D24CA FOREIGN KEY (parc_id) REFERENCES Parc (id)');
        $this->addSql('ALTER TABLE StocksArticles ADD CONSTRAINT FK_A0CC0E137294869C FOREIGN KEY (article_id) REFERENCES Articles (id)');
        $this->addSql('ALTER TABLE StocksArticles ADD CONSTRAINT FK_A0CC0E13DCD6110 FOREIGN KEY (stock_id) REFERENCES Stock (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Corde DROP FOREIGN KEY FK_D108B59B812D24CA');
        $this->addSql('ALTER TABLE Emplacement DROP FOREIGN KEY FK_4653EA219AE7A92D');
        $this->addSql('ALTER TABLE Filiere DROP FOREIGN KEY FK_E16D6402812D24CA');
        $this->addSql('ALTER TABLE Flotteur DROP FOREIGN KEY FK_75346AB1DB296AAD');
        $this->addSql('ALTER TABLE Lanterne DROP FOREIGN KEY FK_95560F4E812D24CA');
        $this->addSql('ALTER TABLE Processus DROP FOREIGN KEY FK_6C1B0EBEA977936C');
        $this->addSql('ALTER TABLE Processus DROP FOREIGN KEY FK_6C1B0EBE727ACA70');
        $this->addSql('ALTER TABLE Segment DROP FOREIGN KEY FK_D73CCCF9180AA129');
        $this->addSql('ALTER TABLE Stock DROP FOREIGN KEY FK_8AF77964812D24CA');
        $this->addSql('ALTER TABLE StocksArticles DROP FOREIGN KEY FK_A0CC0E137294869C');
        $this->addSql('ALTER TABLE StocksArticles DROP FOREIGN KEY FK_A0CC0E13DCD6110');
        $this->addSql('DROP TABLE Articles');
        $this->addSql('DROP TABLE Corde');
        $this->addSql('DROP TABLE Emplacement');
        $this->addSql('DROP TABLE Filiere');
        $this->addSql('DROP TABLE Flotteur');
        $this->addSql('DROP TABLE Lanterne');
        $this->addSql('DROP TABLE Parc');
        $this->addSql('DROP TABLE Poche');
        $this->addSql('DROP TABLE Processus');
        $this->addSql('DROP TABLE Segment');
        $this->addSql('DROP TABLE SonataUserUser');
        $this->addSql('DROP TABLE Stock');
        $this->addSql('DROP TABLE StocksArticles');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
