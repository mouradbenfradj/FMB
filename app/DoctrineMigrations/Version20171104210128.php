<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171104210128 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE acl_entries DROP FOREIGN KEY FK_46C8B8063D9AB4A6;
ALTER TABLE acl_entries DROP FOREIGN KEY FK_46C8B806DF9183C9;
ALTER TABLE acl_entries DROP FOREIGN KEY FK_46C8B806EA000B10;
ALTER TABLE acl_object_identities DROP FOREIGN KEY FK_9407E54977FA751A;
ALTER TABLE acl_object_identity_ancestors DROP FOREIGN KEY FK_825DE2993D9AB4A6;
ALTER TABLE acl_object_identity_ancestors DROP FOREIGN KEY FK_825DE299C671CEA1;
ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168106D6E95;
ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168B960C52B;
ALTER TABLE articles_modele_materiel DROP FOREIGN KEY FK_A13E48A7C62E5DB6;
ALTER TABLE corde DROP FOREIGN KEY FK_10C99A9F54AF5F27;
ALTER TABLE docs_lines DROP FOREIGN KEY FK_4F432E4E42BE39FA;
ALTER TABLE docs_lines DROP FOREIGN KEY FK_4F432E4E8ABB67EB;
ALTER TABLE docs_lines_sn DROP FOREIGN KEY FK_A86F6F76E19C5A7;
ALTER TABLE documents DROP FOREIGN KEY FK_A2B072885B8597ED;
ALTER TABLE documents DROP FOREIGN KEY FK_A2B07288737EF27F;
ALTER TABLE documents DROP FOREIGN KEY FK_A2B072888876B5E8;
ALTER TABLE documents DROP FOREIGN KEY FK_A2B072889041C869;
ALTER TABLE documents DROP FOREIGN KEY FK_A2B07288D48DF710;
ALTER TABLE documents_types DROP FOREIGN KEY FK_65778722D31FA908;
ALTER TABLE emplacement DROP FOREIGN KEY FK_C0CF65F69AE7A92D;
ALTER TABLE filiere DROP FOREIGN KEY FK_2ED05D9E54AF5F27;
ALTER TABLE flotteur DROP FOREIGN KEY FK_8C4208E7DB296AAD;
ALTER TABLE fos_user_user_group DROP FOREIGN KEY FK_B3C77447A76ED395;
ALTER TABLE fos_user_user_group DROP FOREIGN KEY FK_B3C77447FE54D947;
ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5ECFB88E14F;
ALTER TABLE lanterne DROP FOREIGN KEY FK_6C206D1854AF5F27;
ALTER TABLE magasins DROP FOREIGN KEY FK_BE50D53FA5B31750;
ALTER TABLE magasins DROP FOREIGN KEY FK_BE50D53FE0F4C8F9;
ALTER TABLE poche DROP FOREIGN KEY FK_86D8F186524B0562;
ALTER TABLE poches_bs DROP FOREIGN KEY FK_90E7094254AF5F27;
ALTER TABLE processus DROP FOREIGN KEY FK_EEEA8C1D477FF5A2;
ALTER TABLE processus DROP FOREIGN KEY FK_EEEA8C1D6AB2EA46;
ALTER TABLE processus DROP FOREIGN KEY FK_EEEA8C1DC62E5DB6;
ALTER TABLE segment DROP FOREIGN KEY FK_1881F565180AA129;
ALTER TABLE segment DROP FOREIGN KEY FK_1881F5659A8FAD16;
ALTER TABLE segment DROP FOREIGN KEY FK_1881F565B4465BB;
ALTER TABLE stocks_articles DROP FOREIGN KEY FK_5CE171BEA5B31750;
ALTER TABLE stocks_articles DROP FOREIGN KEY FK_5CE171BEC62E5DB6;
ALTER TABLE stocks_articles_sn DROP FOREIGN KEY FK_18509FEA3FCC49A5;
ALTER TABLE stocks_articles_sn_virtuel DROP FOREIGN KEY FK_7712F2063FCC49A5;
ALTER TABLE stocks_cordes DROP FOREIGN KEY FK_35E2087D3FCC49A5565B809;
ALTER TABLE stocks_cordes DROP FOREIGN KEY FK_35E2087D880E0320;
ALTER TABLE stocks_cordes DROP FOREIGN KEY FK_35E2087DA55629DC;
ALTER TABLE stocks_cordes DROP FOREIGN KEY FK_35E2087DC4598A51;
ALTER TABLE stocks_cordes DROP FOREIGN KEY FK_35E2087DF9182269;
ALTER TABLE stocks_lanternes DROP FOREIGN KEY FK_675D3C913FCC49A5565B809;
ALTER TABLE stocks_lanternes DROP FOREIGN KEY FK_675D3C91880E0320;
ALTER TABLE stocks_lanternes DROP FOREIGN KEY FK_675D3C919F4902B6;
ALTER TABLE stocks_lanternes DROP FOREIGN KEY FK_675D3C91A55629DC;
ALTER TABLE stocks_lanternes DROP FOREIGN KEY FK_675D3C91C4598A51;
ALTER TABLE stocks_poches_bs DROP FOREIGN KEY FK_FFB442E33FCC49A5565B809;
ALTER TABLE stocks_poches_bs DROP FOREIGN KEY FK_FFB442E380B18279;
ALTER TABLE stocks_poches_bs DROP FOREIGN KEY FK_FFB442E384E991DD;
ALTER TABLE stocks_poches_bs DROP FOREIGN KEY FK_FFB442E3880E0320;
ALTER TABLE stocks_poches_bs DROP FOREIGN KEY FK_FFB442E3A55629DC;
ALTER TABLE stocks_poches_bs DROP FOREIGN KEY FK_FFB442E3C4598A51;
ALTER TABLE timeline__action_component DROP FOREIGN KEY FK_6ACD1B169D32F035;
ALTER TABLE timeline__action_component DROP FOREIGN KEY FK_6ACD1B16E2ABAFFF;
ALTER TABLE timeline__timeline DROP FOREIGN KEY FK_FFBC6AD523EDC87;
ALTER TABLE timeline__timeline DROP FOREIGN KEY FK_FFBC6AD59D32F035;
DROP TABLE acl_classes;
DROP TABLE acl_entries;
DROP TABLE acl_object_identities;
DROP TABLE acl_object_identity_ancestors;
DROP TABLE acl_security_identities;
DROP TABLE adresses;
DROP TABLE adresses_types;
DROP TABLE annuaire;
DROP TABLE annuaire_categories;
DROP TABLE art_categs;
DROP TABLE art_categs_specificites;
DROP TABLE articles;
DROP TABLE articles_modele_materiel;
DROP TABLE articles_valorisations;
DROP TABLE civilites;
DROP TABLE corde;
DROP TABLE docs_lines;
DROP TABLE docs_lines_sn;
DROP TABLE documents;
DROP TABLE documents_etats;
DROP TABLE documents_types;
DROP TABLE emplacement;
DROP TABLE ext_log_entries;
DROP TABLE ext_translations;
DROP TABLE filiere;
DROP TABLE flotteur;
DROP TABLE fos_user_group;
DROP TABLE fos_user_user;
DROP TABLE fos_user_user_group;
DROP TABLE historique;
DROP TABLE lanterne;
DROP TABLE magasins;
DROP TABLE magasins_enseignes;
DROP TABLE pays;
DROP TABLE pdf_modeles;
DROP TABLE pdf_types;
DROP TABLE phases;
DROP TABLE poche;
DROP TABLE poches_bs;
DROP TABLE processus;
DROP TABLE segment;
DROP TABLE stocks;
DROP TABLE stocks_articles;
DROP TABLE stocks_articles_sn;
DROP TABLE stocks_articles_sn_virtuel;
DROP TABLE stocks_cordes;
DROP TABLE stocks_lanternes;
DROP TABLE stocks_poches_bs;
DROP TABLE tarifs_listes;
DROP TABLE timeline;
DROP TABLE timeline__action;
DROP TABLE timeline__action_component;
DROP TABLE timeline__component;
DROP TABLE timeline__timeline');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ext_log_entries (id INT AUTO_INCREMENT NOT NULL, action VARCHAR(8) NOT NULL COLLATE utf8_unicode_ci, logged_at DATETIME NOT NULL, object_id VARCHAR(64) DEFAULT NULL COLLATE utf8_unicode_ci, object_class VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, version INT NOT NULL, data LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:array)\', username VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, INDEX log_class_lookup_idx (object_class), INDEX log_date_lookup_idx (logged_at), INDEX log_user_lookup_idx (username), INDEX log_version_lookup_idx (object_id, object_class, version), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ext_translations (id INT AUTO_INCREMENT NOT NULL, locale VARCHAR(8) NOT NULL COLLATE utf8_unicode_ci, object_class VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, field VARCHAR(32) NOT NULL COLLATE utf8_unicode_ci, foreign_key VARCHAR(64) NOT NULL COLLATE utf8_unicode_ci, content LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, UNIQUE INDEX lookup_unique_idx (locale, object_class, field, foreign_key), INDEX translations_lookup_idx (locale, object_class, foreign_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, username_canonical VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, email VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, email_canonical VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, password VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_1D1C63B392FC23A8 (username_canonical), UNIQUE INDEX UNIQ_1D1C63B3A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresses CHANGE ref_adresse ref_adresse VARCHAR(32) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE annuaire CHANGE ref_contact ref_contact VARCHAR(32) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE pdf_types CHANGE id_pdf_type id_pdf_type TINYINT(1) NOT NULL');
    }
}
