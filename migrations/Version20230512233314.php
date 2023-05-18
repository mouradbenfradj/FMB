<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230512233314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168106D6E95');
        $this->addSql('ALTER TABLE emplacement DROP FOREIGN KEY FK_C0CF65F6787EB836');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5ECFB88E14F');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE acl_entries DROP FOREIGN KEY FK_46C8B806EA000B10');
        $this->addSql('ALTER TABLE acl_entries DROP FOREIGN KEY FK_46C8B8063D9AB4A6');
        $this->addSql('ALTER TABLE acl_entries DROP FOREIGN KEY FK_46C8B806DF9183C9');
        $this->addSql('ALTER TABLE acl_object_identities DROP FOREIGN KEY FK_9407E54977FA751A');
        $this->addSql('ALTER TABLE acl_object_identity_ancestors DROP FOREIGN KEY FK_825DE299C671CEA1');
        $this->addSql('ALTER TABLE acl_object_identity_ancestors DROP FOREIGN KEY FK_825DE2993D9AB4A6');
        $this->addSql('ALTER TABLE art_categs DROP FOREIGN KEY FK_9DBE2AB07A08541E');
        $this->addSql('ALTER TABLE articles_modele_materiel DROP FOREIGN KEY FK_A13E48A7C62E5DB6');
        $this->addSql('ALTER TABLE emballage DROP FOREIGN KEY FK_17D1FF4BC4598A51');
        $this->addSql('ALTER TABLE emballage DROP FOREIGN KEY FK_17D1FF4B3FCC49A5');
        $this->addSql('ALTER TABLE emballage DROP FOREIGN KEY FK_17D1FF4B727ACA70');
        $this->addSql('ALTER TABLE emballage DROP FOREIGN KEY FK_17D1FF4B5A633396565B809');
        $this->addSql('ALTER TABLE emballage DROP FOREIGN KEY FK_17D1FF4BA55629DC');
        $this->addSql('ALTER TABLE emballage_content DROP FOREIGN KEY FK_67EEC147787EB836');
        $this->addSql('ALTER TABLE fos_user_user_group DROP FOREIGN KEY FK_B3C77447A76ED395');
        $this->addSql('ALTER TABLE fos_user_user_group DROP FOREIGN KEY FK_B3C77447FE54D947');
        $this->addSql('ALTER TABLE timeline__action_component DROP FOREIGN KEY FK_6ACD1B169D32F035');
        $this->addSql('ALTER TABLE timeline__action_component DROP FOREIGN KEY FK_6ACD1B16E2ABAFFF');
        $this->addSql('ALTER TABLE timeline__timeline DROP FOREIGN KEY FK_FFBC6AD59D32F035');
        $this->addSql('ALTER TABLE timeline__timeline DROP FOREIGN KEY FK_FFBC6AD523EDC87');
        $this->addSql('DROP TABLE acl_classes');
        $this->addSql('DROP TABLE acl_entries');
        $this->addSql('DROP TABLE acl_object_identities');
        $this->addSql('DROP TABLE acl_object_identity_ancestors');
        $this->addSql('DROP TABLE acl_security_identities');
        $this->addSql('DROP TABLE art_categs');
        $this->addSql('DROP TABLE articles_modele_materiel');
        $this->addSql('DROP TABLE emballage');
        $this->addSql('DROP TABLE emballage_content');
        $this->addSql('DROP TABLE ext_log_entries');
        $this->addSql('DROP TABLE ext_translations');
        $this->addSql('DROP TABLE fos_user_group');
        $this->addSql('DROP TABLE fos_user_user');
        $this->addSql('DROP TABLE fos_user_user_group');
        $this->addSql('DROP TABLE timeline');
        $this->addSql('DROP TABLE timeline__action');
        $this->addSql('DROP TABLE timeline__action_component');
        $this->addSql('DROP TABLE timeline__component');
        $this->addSql('DROP TABLE timeline__timeline');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('ALTER TABLE articles CHANGE ref_art_categ ref_art_categ VARCHAR(32) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_C0CF65F6787EB836 ON emplacement');
        $this->addSql('ALTER TABLE emplacement ADD stockspoches_id INT DEFAULT NULL, ADD stockslanterne_id INT DEFAULT NULL, CHANGE emballage_id stockscorde_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE emplacement ADD CONSTRAINT FK_C0CF65F6D21B079C FOREIGN KEY (stockscorde_id) REFERENCES stocks_cordes (id)');
        $this->addSql('ALTER TABLE emplacement ADD CONSTRAINT FK_C0CF65F63D3C50F8 FOREIGN KEY (stockspoches_id) REFERENCES stocks_poches_bs (id)');
        $this->addSql('ALTER TABLE emplacement ADD CONSTRAINT FK_C0CF65F65DBC32FB FOREIGN KEY (stockslanterne_id) REFERENCES stocks_lanternes (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C0CF65F6D21B079C ON emplacement (stockscorde_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C0CF65F63D3C50F8 ON emplacement (stockspoches_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C0CF65F65DBC32FB ON emplacement (stockslanterne_id)');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5ECFB88E14F');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5ECFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE magasins CHANGE mode_vente mode_vente VARCHAR(255) NOT NULL, CHANGE actif actif TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE stocks_poches_bs CHANGE numero_serie numero_serie VARCHAR(32) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5ECFB88E14F');
        $this->addSql('CREATE TABLE acl_classes (id INT UNSIGNED AUTO_INCREMENT NOT NULL, class_type VARCHAR(200) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, UNIQUE INDEX UNIQ_69DD750638A36066 (class_type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE acl_entries (id INT UNSIGNED AUTO_INCREMENT NOT NULL, class_id INT UNSIGNED NOT NULL, object_identity_id INT UNSIGNED DEFAULT NULL, security_identity_id INT UNSIGNED NOT NULL, field_name VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, ace_order SMALLINT UNSIGNED NOT NULL, mask INT NOT NULL, granting TINYINT(1) NOT NULL, granting_strategy VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, audit_success TINYINT(1) NOT NULL, audit_failure TINYINT(1) NOT NULL, INDEX IDX_46C8B806EA000B10 (class_id), INDEX IDX_46C8B806DF9183C9 (security_identity_id), INDEX IDX_46C8B8063D9AB4A6 (object_identity_id), UNIQUE INDEX UNIQ_46C8B806EA000B103D9AB4A64DEF17BCE4289BF4 (class_id, object_identity_id, field_name, ace_order), INDEX IDX_46C8B806EA000B103D9AB4A6DF9183C9 (class_id, object_identity_id, security_identity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE acl_object_identities (id INT UNSIGNED AUTO_INCREMENT NOT NULL, parent_object_identity_id INT UNSIGNED DEFAULT NULL, class_id INT UNSIGNED NOT NULL, object_identifier VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, entries_inheriting TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_9407E5494B12AD6EA000B10 (object_identifier, class_id), INDEX IDX_9407E54977FA751A (parent_object_identity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE acl_object_identity_ancestors (object_identity_id INT UNSIGNED NOT NULL, ancestor_id INT UNSIGNED NOT NULL, INDEX IDX_825DE299C671CEA1 (ancestor_id), INDEX IDX_825DE2993D9AB4A6 (object_identity_id), PRIMARY KEY(object_identity_id, ancestor_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE acl_security_identities (id INT UNSIGNED AUTO_INCREMENT NOT NULL, identifier VARCHAR(200) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, username TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8835EE78772E836AF85E0677 (identifier, username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE art_categs (ref_art_categ VARCHAR(32) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, ref_art_categ_parent VARCHAR(32) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, lib_art_categ VARCHAR(64) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, modele VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, id_modele_spe SMALLINT DEFAULT NULL, desc_art_categ MEDIUMTEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, defaut_id_tva SMALLINT DEFAULT NULL, duree_dispo BIGINT NOT NULL, defaut_numero_compte_vente VARCHAR(10) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, defaut_numero_compte_achat VARCHAR(10) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, restriction VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, INDEX ref_art_categ_parent (ref_art_categ_parent), INDEX defaut_id_tva (defaut_id_tva), INDEX lib_art_categ (lib_art_categ), INDEX id_article_modele (modele), INDEX id_modele_spe (id_modele_spe), PRIMARY KEY(ref_art_categ)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE articles_modele_materiel (ref_article VARCHAR(32) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, poids DOUBLE PRECISION NOT NULL, colisage VARCHAR(32) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, duree_garantie SMALLINT NOT NULL, PRIMARY KEY(ref_article)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE emballage (id INT AUTO_INCREMENT NOT NULL, ref_stock_article VARCHAR(32) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, processus_id INT DEFAULT NULL, emplacement_id INT DEFAULT NULL, ref_stock_article_sn VARCHAR(32) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, numero_serie VARCHAR(32) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, parent_id INT DEFAULT NULL, doc_line VARCHAR(32) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, pret TINYINT(1) NOT NULL, chaussement TINYINT(1) NOT NULL, dateAssemblage DATE DEFAULT NULL, dateDeCreation DATE NOT NULL, date_de_mise_a_eau DATE DEFAULT NULL, dateDeRetraitTransfert DATE DEFAULT NULL, dateDeMAETransfert DATE DEFAULT NULL, dateDeRetirement DATE DEFAULT NULL, dateChaussement DATE DEFAULT NULL, cycle_r INT NOT NULL, INDEX IDX_17D1FF4B3FCC49A5 (ref_stock_article), INDEX IDX_17D1FF4B5A633396565B809 (ref_stock_article_sn, numero_serie), INDEX IDX_17D1FF4B727ACA70 (parent_id), UNIQUE INDEX UNIQ_17D1FF4BC4598A51 (emplacement_id), INDEX IDX_17D1FF4BA55629DC (processus_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE emballage_content (id INT AUTO_INCREMENT NOT NULL, emballage_id INT DEFAULT NULL, quantite INT NOT NULL, emplacement INT NOT NULL, INDEX IDX_67EEC147787EB836 (emballage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ext_log_entries (id INT AUTO_INCREMENT NOT NULL, action VARCHAR(8) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, logged_at DATETIME NOT NULL, object_id VARCHAR(64) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, object_class VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, version INT NOT NULL, data LONGTEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci` COMMENT \'(DC2Type:array)\', username VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, INDEX log_date_lookup_idx (logged_at), INDEX log_version_lookup_idx (object_id, object_class, version), INDEX log_class_lookup_idx (object_class), INDEX log_user_lookup_idx (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ext_translations (id INT AUTO_INCREMENT NOT NULL, locale VARCHAR(8) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, object_class VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, field VARCHAR(32) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, foreign_key VARCHAR(64) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, content LONGTEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, UNIQUE INDEX lookup_unique_idx (locale, object_class, field, foreign_key), INDEX translations_lookup_idx (locale, object_class, foreign_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE fos_user_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, roles LONGTEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_583D1F3E5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE fos_user_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, username_canonical VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, email_canonical VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, password VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, date_of_birth DATETIME DEFAULT NULL, firstname VARCHAR(64) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, lastname VARCHAR(64) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, website VARCHAR(64) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, biography VARCHAR(1000) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, gender VARCHAR(1) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, locale VARCHAR(8) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, timezone VARCHAR(64) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, phone VARCHAR(64) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, facebook_uid VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, facebook_name VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, facebook_data JSON CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, twitter_uid VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, twitter_name VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, twitter_data JSON CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, gplus_uid VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, gplus_name VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, gplus_data JSON CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, token VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, two_step_code VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, UNIQUE INDEX UNIQ_C560D76192FC23A8 (username_canonical), UNIQUE INDEX UNIQ_C560D761A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE fos_user_user_group (user_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_B3C77447A76ED395 (user_id), INDEX IDX_B3C77447FE54D947 (group_id), PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE timeline (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE timeline__action (id INT AUTO_INCREMENT NOT NULL, verb VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, status_current VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, status_wanted VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, duplicate_key VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, duplicate_priority INT DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE timeline__action_component (id INT AUTO_INCREMENT NOT NULL, action_id INT DEFAULT NULL, component_id INT DEFAULT NULL, type VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, text VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, INDEX IDX_6ACD1B169D32F035 (action_id), INDEX IDX_6ACD1B16E2ABAFFF (component_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE timeline__component (id INT AUTO_INCREMENT NOT NULL, model VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, identifier LONGTEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'(DC2Type:array)\', hash VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, UNIQUE INDEX UNIQ_1B2F01CDD1B862B8 (hash), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE timeline__timeline (id INT AUTO_INCREMENT NOT NULL, action_id INT DEFAULT NULL, subject_id INT DEFAULT NULL, context VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, type VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, created_at DATETIME NOT NULL, INDEX IDX_FFBC6AD523EDC87 (subject_id), INDEX type_idx (type), INDEX IDX_FFBC6AD59D32F035 (action_id), INDEX context_idx (context), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, username_canonical VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, email_canonical VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, password VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_1D1C63B392FC23A8 (username_canonical), UNIQUE INDEX UNIQ_1D1C63B3A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B806EA000B10 FOREIGN KEY (class_id) REFERENCES acl_classes (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B8063D9AB4A6 FOREIGN KEY (object_identity_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B806DF9183C9 FOREIGN KEY (security_identity_id) REFERENCES acl_security_identities (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acl_object_identities ADD CONSTRAINT FK_9407E54977FA751A FOREIGN KEY (parent_object_identity_id) REFERENCES acl_object_identities (id)');
        $this->addSql('ALTER TABLE acl_object_identity_ancestors ADD CONSTRAINT FK_825DE299C671CEA1 FOREIGN KEY (ancestor_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acl_object_identity_ancestors ADD CONSTRAINT FK_825DE2993D9AB4A6 FOREIGN KEY (object_identity_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE art_categs ADD CONSTRAINT FK_9DBE2AB07A08541E FOREIGN KEY (ref_art_categ_parent) REFERENCES art_categs (ref_art_categ)');
        $this->addSql('ALTER TABLE articles_modele_materiel ADD CONSTRAINT FK_A13E48A7C62E5DB6 FOREIGN KEY (ref_article) REFERENCES articles (ref_article)');
        $this->addSql('ALTER TABLE emballage ADD CONSTRAINT FK_17D1FF4BC4598A51 FOREIGN KEY (emplacement_id) REFERENCES emplacement (id)');
        $this->addSql('ALTER TABLE emballage ADD CONSTRAINT FK_17D1FF4B3FCC49A5 FOREIGN KEY (ref_stock_article) REFERENCES stocks_articles (ref_stock_article)');
        $this->addSql('ALTER TABLE emballage ADD CONSTRAINT FK_17D1FF4B727ACA70 FOREIGN KEY (parent_id) REFERENCES emballage (id)');
        $this->addSql('ALTER TABLE emballage ADD CONSTRAINT FK_17D1FF4B5A633396565B809 FOREIGN KEY (ref_stock_article_sn, numero_serie) REFERENCES stocks_articles_sn (ref_stock_article, numero_serie)');
        $this->addSql('ALTER TABLE emballage ADD CONSTRAINT FK_17D1FF4BA55629DC FOREIGN KEY (processus_id) REFERENCES processus (id)');
        $this->addSql('ALTER TABLE emballage_content ADD CONSTRAINT FK_67EEC147787EB836 FOREIGN KEY (emballage_id) REFERENCES emballage (id)');
        $this->addSql('ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447FE54D947 FOREIGN KEY (group_id) REFERENCES fos_user_group (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE timeline__action_component ADD CONSTRAINT FK_6ACD1B169D32F035 FOREIGN KEY (action_id) REFERENCES timeline__action (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE timeline__action_component ADD CONSTRAINT FK_6ACD1B16E2ABAFFF FOREIGN KEY (component_id) REFERENCES timeline__component (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE timeline__timeline ADD CONSTRAINT FK_FFBC6AD59D32F035 FOREIGN KEY (action_id) REFERENCES timeline__action (id)');
        $this->addSql('ALTER TABLE timeline__timeline ADD CONSTRAINT FK_FFBC6AD523EDC87 FOREIGN KEY (subject_id) REFERENCES timeline__component (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE articles CHANGE ref_art_categ ref_art_categ VARCHAR(32) DEFAULT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168106D6E95 FOREIGN KEY (ref_art_categ) REFERENCES art_categs (ref_art_categ)');
        $this->addSql('ALTER TABLE emplacement DROP FOREIGN KEY FK_C0CF65F6D21B079C');
        $this->addSql('ALTER TABLE emplacement DROP FOREIGN KEY FK_C0CF65F63D3C50F8');
        $this->addSql('ALTER TABLE emplacement DROP FOREIGN KEY FK_C0CF65F65DBC32FB');
        $this->addSql('DROP INDEX UNIQ_C0CF65F6D21B079C ON emplacement');
        $this->addSql('DROP INDEX UNIQ_C0CF65F63D3C50F8 ON emplacement');
        $this->addSql('DROP INDEX UNIQ_C0CF65F65DBC32FB ON emplacement');
        $this->addSql('ALTER TABLE emplacement ADD emballage_id INT DEFAULT NULL, DROP stockscorde_id, DROP stockspoches_id, DROP stockslanterne_id');
        $this->addSql('ALTER TABLE emplacement ADD CONSTRAINT FK_C0CF65F6787EB836 FOREIGN KEY (emballage_id) REFERENCES emballage (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C0CF65F6787EB836 ON emplacement (emballage_id)');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5ECFB88E14F');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5ECFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES fos_user_user (id)');
        $this->addSql('ALTER TABLE magasins CHANGE mode_vente mode_vente VARCHAR(255) DEFAULT NULL, CHANGE actif actif TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE stocks_poches_bs CHANGE numero_serie numero_serie VARCHAR(32) NOT NULL');
    }
}
