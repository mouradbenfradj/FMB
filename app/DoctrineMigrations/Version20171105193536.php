<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171105193536 extends AbstractMigration
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

        $this->addSql('CREATE TABLE fos_user_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_583D1F3E5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE fos_user_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, date_of_birth DATETIME DEFAULT NULL, firstname VARCHAR(64) DEFAULT NULL, lastname VARCHAR(64) DEFAULT NULL, website VARCHAR(64) DEFAULT NULL, biography VARCHAR(1000) DEFAULT NULL, gender VARCHAR(1) DEFAULT NULL, locale VARCHAR(8) DEFAULT NULL, timezone VARCHAR(64) DEFAULT NULL, phone VARCHAR(64) DEFAULT NULL, facebook_uid VARCHAR(255) DEFAULT NULL, facebook_name VARCHAR(255) DEFAULT NULL, facebook_data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', twitter_uid VARCHAR(255) DEFAULT NULL, twitter_name VARCHAR(255) DEFAULT NULL, twitter_data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', gplus_uid VARCHAR(255) DEFAULT NULL, gplus_name VARCHAR(255) DEFAULT NULL, gplus_data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', token VARCHAR(255) DEFAULT NULL, two_step_code VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_C560D76192FC23A8 (username_canonical), UNIQUE INDEX UNIQ_C560D761A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE fos_user_user_group (user_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_B3C77447A76ED395 (user_id), INDEX IDX_B3C77447FE54D947 (group_id), PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE timeline__action (id INT AUTO_INCREMENT NOT NULL, verb VARCHAR(255) NOT NULL, status_current VARCHAR(255) NOT NULL, status_wanted VARCHAR(255) NOT NULL, duplicate_key VARCHAR(255) DEFAULT NULL, duplicate_priority INT DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE timeline__action_component (id INT AUTO_INCREMENT NOT NULL, action_id INT DEFAULT NULL, component_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, text VARCHAR(255) DEFAULT NULL, INDEX IDX_6ACD1B169D32F035 (action_id), INDEX IDX_6ACD1B16E2ABAFFF (component_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE timeline__component (id INT AUTO_INCREMENT NOT NULL, model VARCHAR(255) NOT NULL, identifier LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', hash VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1B2F01CDD1B862B8 (hash), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE timeline__timeline (id INT AUTO_INCREMENT NOT NULL, action_id INT DEFAULT NULL, subject_id INT DEFAULT NULL, context VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_FFBC6AD59D32F035 (action_id), INDEX IDX_FFBC6AD523EDC87 (subject_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE ext_translations (id INT AUTO_INCREMENT NOT NULL, locale VARCHAR(8) NOT NULL, object_class VARCHAR(255) NOT NULL, field VARCHAR(32) NOT NULL, foreign_key VARCHAR(64) NOT NULL, content LONGTEXT DEFAULT NULL, INDEX translations_lookup_idx (locale, object_class, foreign_key), UNIQUE INDEX lookup_unique_idx (locale, object_class, field, foreign_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE ext_log_entries (id INT AUTO_INCREMENT NOT NULL, action VARCHAR(8) NOT NULL, logged_at DATETIME NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', username VARCHAR(255) DEFAULT NULL, INDEX log_class_lookup_idx (object_class), INDEX log_date_lookup_idx (logged_at), INDEX log_user_lookup_idx (username), INDEX log_version_lookup_idx (object_id, object_class, version), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE adresses (ref_adresse VARCHAR(32) NOT NULL, ref_contact VARCHAR(32) NOT NULL, id_type_adresse SMALLINT DEFAULT NULL, lib_adresse VARCHAR(128) NOT NULL, text_adresse VARCHAR(160) NOT NULL, code_postal VARCHAR(9) NOT NULL, ville VARCHAR(28) NOT NULL, id_pays SMALLINT DEFAULT NULL, note MEDIUMBLOB NOT NULL, ordre SMALLINT NOT NULL, INDEX id_pays (id_pays), INDEX ref_contact (ref_contact), INDEX id_type_adresse (id_type_adresse), PRIMARY KEY(ref_adresse)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE adresses_types (id_adresse_type SMALLINT AUTO_INCREMENT NOT NULL, adresse_type VARCHAR(64) NOT NULL, defaut SMALLINT NOT NULL, PRIMARY KEY(id_adresse_type)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE annuaire (ref_contact VARCHAR(32) NOT NULL, id_civilite SMALLINT DEFAULT NULL, nom VARCHAR(128) NOT NULL, id_categorie SMALLINT DEFAULT NULL, siret VARCHAR(32) NOT NULL, tva_intra VARCHAR(32) NOT NULL, note MEDIUMBLOB NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME NOT NULL, date_archivage DATETIME DEFAULT NULL, INDEX nom (nom), INDEX id_civilite (id_civilite), INDEX id_categorie (id_categorie), PRIMARY KEY(ref_contact)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE annuaire_categories (id_categorie SMALLINT AUTO_INCREMENT NOT NULL, lib_categorie VARCHAR(32) NOT NULL, ordre TINYINT(1) NOT NULL, app_tarifs VARCHAR(255) NOT NULL, PRIMARY KEY(id_categorie)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE art_categs (ref_art_categ VARCHAR(32) NOT NULL, lib_art_categ VARCHAR(64) NOT NULL, modele VARCHAR(255) DEFAULT NULL, id_modele_spe SMALLINT DEFAULT NULL, desc_art_categ MEDIUMTEXT NOT NULL, defaut_id_tva SMALLINT DEFAULT NULL, duree_dispo BIGINT NOT NULL, defaut_numero_compte_vente VARCHAR(10) NOT NULL, defaut_numero_compte_achat VARCHAR(10) NOT NULL, ref_art_categ_parent VARCHAR(32) DEFAULT NULL, restriction VARCHAR(255) NOT NULL, INDEX lib_art_categ (lib_art_categ), INDEX ref_art_categ_parent (ref_art_categ_parent), INDEX id_article_modele (modele), INDEX defaut_id_tva (defaut_id_tva), INDEX id_modele_spe (id_modele_spe), PRIMARY KEY(ref_art_categ)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE art_categs_specificites (id_modele_spe SMALLINT AUTO_INCREMENT NOT NULL, lib_modele_spe VARCHAR(255) NOT NULL, PRIMARY KEY(id_modele_spe)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE articles (ref_article VARCHAR(32) NOT NULL, ref_art_categ VARCHAR(32) DEFAULT NULL, id_valo SMALLINT DEFAULT NULL, ref_oem VARCHAR(64) DEFAULT NULL, ref_interne VARCHAR(32) DEFAULT NULL, lib_article VARCHAR(250) NOT NULL, lib_ticket VARCHAR(64) NOT NULL, desc_courte MEDIUMBLOB NOT NULL, desc_longue MEDIUMBLOB NOT NULL, modele VARCHAR(255) NOT NULL, ref_constructeur VARCHAR(32) DEFAULT NULL, prix_public_ht DOUBLE PRECISION DEFAULT NULL, prix_achat_ht DOUBLE PRECISION DEFAULT NULL, paa_ht DOUBLE PRECISION DEFAULT NULL, paa_last_maj DATETIME NOT NULL, id_tva SMALLINT DEFAULT NULL, promo SMALLINT NOT NULL, valo_indice DOUBLE PRECISION NOT NULL, lot TINYINT(1) NOT NULL, composant TINYINT(1) NOT NULL, variante TINYINT(1) NOT NULL, gestion_sn TINYINT(1) NOT NULL, date_debut_dispo DATETIME NOT NULL, date_fin_dispo DATETIME NOT NULL, dispo TINYINT(1) NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME NOT NULL, numero_compte_achat VARCHAR(10) DEFAULT NULL, numero_compte_vente VARCHAR(10) DEFAULT NULL, is_achetable TINYINT(1) NOT NULL, is_vendable TINYINT(1) NOT NULL, id_modele_spe SMALLINT DEFAULT NULL, INDEX lib_article (lib_article), INDEX ref_art_categ (ref_art_categ), INDEX ref_constructeur (ref_constructeur), INDEX dispo (dispo), INDEX ref_oem (ref_oem), INDEX id_tva (id_tva), INDEX id_valo (id_valo), INDEX id_modele_spe (id_modele_spe), UNIQUE INDEX ref_interne (ref_interne), PRIMARY KEY(ref_article)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE articles_modele_materiel (ref_article VARCHAR(32) NOT NULL, poids DOUBLE PRECISION NOT NULL, colisage VARCHAR(32) NOT NULL, duree_garantie SMALLINT NOT NULL, PRIMARY KEY(ref_article)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE articles_valorisations (id_valo SMALLINT AUTO_INCREMENT NOT NULL, groupe VARCHAR(255) NOT NULL, lib_valo VARCHAR(64) NOT NULL, abrev_valo VARCHAR(6) NOT NULL, popup TINYINT(1) NOT NULL, PRIMARY KEY(id_valo)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE civilites (id_civilite SMALLINT AUTO_INCREMENT NOT NULL, lib_civ_court VARCHAR(16) NOT NULL, lib_civ_long VARCHAR(64) NOT NULL, categorie VARCHAR(255) NOT NULL, INDEX lib_civ_court (lib_civ_court), INDEX lib_civ_long (lib_civ_long), PRIMARY KEY(id_civilite)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE corde (id INT AUTO_INCREMENT NOT NULL, magasin SMALLINT NOT NULL, nbrtotaleEnStock INT NOT NULL, nomCorde VARCHAR(255) NOT NULL, INDEX IDX_10C99A9F54AF5F27 (magasin), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE docs_lines (ref_doc_line VARCHAR(32) NOT NULL, ref_doc_line_parent VARCHAR(32) DEFAULT NULL, ref_doc VARCHAR(32) DEFAULT NULL, ref_article VARCHAR(32) DEFAULT NULL, lib_article VARCHAR(250) NOT NULL, desc_article MEDIUMTEXT NOT NULL, qte DOUBLE PRECISION NOT NULL, pu_ht DOUBLE PRECISION NOT NULL, remise DOUBLE PRECISION NOT NULL, tva DOUBLE PRECISION NOT NULL, ordre SMALLINT NOT NULL, visible TINYINT(1) NOT NULL, pa_ht DOUBLE PRECISION DEFAULT NULL, pa_forced TINYINT(1) NOT NULL, INDEX ref_doc (ref_doc), INDEX ref_article (ref_article), INDEX ref_doc_line_parent (ref_doc_line_parent), PRIMARY KEY(ref_doc_line)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE docs_lines_sn (numero_serie VARCHAR(32) NOT NULL, ref_doc_line VARCHAR(32) NOT NULL, sn_qte DOUBLE PRECISION NOT NULL, INDEX ref_doc_line (ref_doc_line), INDEX numero_serie (numero_serie), PRIMARY KEY(numero_serie, ref_doc_line)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE documents (ref_doc VARCHAR(32) NOT NULL, id_pays_contact SMALLINT DEFAULT NULL, ref_adr_contact VARCHAR(32) DEFAULT NULL, ref_contact VARCHAR(32) DEFAULT NULL, id_etat_doc SMALLINT DEFAULT NULL, id_type_doc SMALLINT DEFAULT NULL, code_affaire VARCHAR(64) NOT NULL, nom_contact VARCHAR(128) NOT NULL, adresse_contact MEDIUMTEXT NOT NULL, code_postal_contact VARCHAR(9) NOT NULL, ville_contact VARCHAR(28) NOT NULL, app_tarifs VARCHAR(255) NOT NULL, description MEDIUMTEXT NOT NULL, date_creation_doc DATETIME NOT NULL, code_file VARCHAR(32) NOT NULL, INDEX id_type_doc (id_type_doc), INDEX id_etat_doc (id_etat_doc), INDEX ref_contact (ref_contact), INDEX ref_adr_contact (ref_adr_contact), INDEX id_pays_contact (id_pays_contact), INDEX code_affaire (code_affaire), PRIMARY KEY(ref_doc)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE documents_etats (id_etat_doc SMALLINT AUTO_INCREMENT NOT NULL, id_type_doc SMALLINT NOT NULL, lib_etat_doc VARCHAR(32) NOT NULL, ordre TINYINT(1) NOT NULL, is_open TINYINT(1) NOT NULL, INDEX ordre (ordre), INDEX id_type_doc (id_type_doc), PRIMARY KEY(id_etat_doc)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE documents_types (id_type_doc SMALLINT AUTO_INCREMENT NOT NULL, id_pdf_modele SMALLINT DEFAULT NULL, lib_type_doc VARCHAR(64) NOT NULL, lib_type_printed VARCHAR(64) NOT NULL, code_doc VARCHAR(32) NOT NULL, id_type_groupe TINYINT(1) NOT NULL, actif TINYINT(1) NOT NULL, INDEX actif (actif), INDEX id_pdf_modele (id_pdf_modele), INDEX id_type_groupe (id_type_groupe), PRIMARY KEY(id_type_doc)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE emplacement (id INT AUTO_INCREMENT NOT NULL, flotteur_id INT NOT NULL, place INT NOT NULL, date_remplissage DATE DEFAULT NULL, depth INT NOT NULL, INDEX IDX_C0CF65F69AE7A92D (flotteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE filiere (id INT AUTO_INCREMENT NOT NULL, magasin SMALLINT NOT NULL, title VARCHAR(64) NOT NULL, nomFiliere VARCHAR(255) NOT NULL, observation LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', aireDeTravaille TINYINT(1) NOT NULL, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, INDEX IDX_2ED05D9E54AF5F27 (magasin), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE flotteur (id INT AUTO_INCREMENT NOT NULL, segment_id INT NOT NULL, title VARCHAR(64) NOT NULL, nomFlotteur VARCHAR(255) NOT NULL, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, depth INT NOT NULL, INDEX IDX_8C4208E7DB296AAD (segment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE historique (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, dateOp DATETIME NOT NULL, operation VARCHAR(255) NOT NULL, tache_effectuer LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_EDBFD5ECFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE lanterne (magasin SMALLINT NOT NULL, nomLanterne VARCHAR(255) NOT NULL, nbrpoche INT NOT NULL, nbrtotaleEnStock INT NOT NULL, INDEX IDX_6C206D1854AF5F27 (magasin), PRIMARY KEY(nomLanterne)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE magasins (id_magasin SMALLINT AUTO_INCREMENT NOT NULL, id_stock SMALLINT DEFAULT NULL, id_tarif SMALLINT DEFAULT NULL, lib_magasin VARCHAR(64) NOT NULL, abrev_magasin VARCHAR(32) NOT NULL, id_mag_enseigne SMALLINT DEFAULT NULL, mode_vente VARCHAR(255) NOT NULL, actif TINYINT(1) NOT NULL, INDEX id_stock (id_stock), INDEX id_tarif (id_tarif), INDEX actif (actif), INDEX id_mag_enseigne (id_mag_enseigne), PRIMARY KEY(id_magasin)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE magasins_enseignes (id_mag_enseigne SMALLINT AUTO_INCREMENT NOT NULL, lib_enseigne VARCHAR(255) NOT NULL, PRIMARY KEY(id_mag_enseigne)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE pays (id_pays SMALLINT AUTO_INCREMENT NOT NULL, pays VARCHAR(64) NOT NULL, code_pays VARCHAR(2) NOT NULL, defaut_id_langage TINYINT(1) NOT NULL, use_etat TINYINT(1) NOT NULL, affichage TINYINT(1) NOT NULL, UNIQUE INDEX pays (pays), PRIMARY KEY(id_pays)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE pdf_modeles (id_pdf_modele SMALLINT AUTO_INCREMENT NOT NULL, id_pdf_type TINYINT(1) NOT NULL, lib_modele VARCHAR(64) NOT NULL, desc_modele MEDIUMTEXT NOT NULL, code_pdf_modele VARCHAR(32) NOT NULL, INDEX id_pdf_type (id_pdf_type), PRIMARY KEY(id_pdf_modele)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE pdf_types (id_pdf_type TINYINT(1) NOT NULL, lib_pdf_type VARCHAR(64) NOT NULL, PRIMARY KEY(id_pdf_type)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE phases (id INT AUTO_INCREMENT NOT NULL, nomPhase VARCHAR(255) NOT NULL, ordeDaffichage INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE poche (id INT AUTO_INCREMENT NOT NULL, stocklanterne_id INT NOT NULL, quantite INT NOT NULL, emplacement INT NOT NULL, INDEX IDX_86D8F186524B0562 (stocklanterne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE poches_bs (id INT AUTO_INCREMENT NOT NULL, magasin SMALLINT NOT NULL, nbrTotaleEnStock INT NOT NULL, nomPoche VARCHAR(255) NOT NULL, INDEX IDX_90E7094254AF5F27 (magasin), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE processus (id INT AUTO_INCREMENT NOT NULL, id_processus_parent_id INT DEFAULT NULL, ref_article VARCHAR(32) NOT NULL, phases_processus_id INT NOT NULL, numeroDebCycle INT NOT NULL, limiteDuCycle INT NOT NULL, nomProcessus VARCHAR(255) NOT NULL, abrevProcessus VARCHAR(255) NOT NULL, duree LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', alerteRougeJours LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', alerteJauneJours LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', couleur VARCHAR(255) NOT NULL, couleurDuFond VARCHAR(255) NOT NULL, articleSortie VARCHAR(255) NOT NULL, INDEX IDX_EEEA8C1D6AB2EA46 (id_processus_parent_id), INDEX IDX_EEEA8C1DC62E5DB6 (ref_article), INDEX IDX_EEEA8C1D477FF5A2 (phases_processus_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE segment (id INT AUTO_INCREMENT NOT NULL, filiere_id INT NOT NULL, ancestor INT NOT NULL, descendant INT NOT NULL, title VARCHAR(64) NOT NULL, nomSegment VARCHAR(255) NOT NULL, longeur NUMERIC(10, 2) NOT NULL, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, depth INT NOT NULL, INDEX IDX_1881F565180AA129 (filiere_id), INDEX IDX_1881F565B4465BB (ancestor), INDEX IDX_1881F5659A8FAD16 (descendant), INDEX IDX_65651ACF665A5B6A (depth), UNIQUE INDEX IDX_78A95BB6B1F19475 (ancestor, descendant), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE stocks (id_stock SMALLINT AUTO_INCREMENT NOT NULL, lib_stock VARCHAR(32) NOT NULL, abrev_stock VARCHAR(32) NOT NULL, ref_adr_stock VARCHAR(32) DEFAULT NULL, actif TINYINT(1) NOT NULL, INDEX actif (actif), INDEX ref_adr_stock (ref_adr_stock), PRIMARY KEY(id_stock)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE stocks_articles (ref_stock_article VARCHAR(32) NOT NULL, ref_article VARCHAR(32) DEFAULT NULL, id_stock SMALLINT DEFAULT NULL, qte DOUBLE PRECISION NOT NULL, INDEX id_stock (id_stock), INDEX ref_article (ref_article), PRIMARY KEY(ref_stock_article)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE stocks_articles_sn (numero_serie VARCHAR(32) NOT NULL, ref_stock_article VARCHAR(32) NOT NULL, sn_qte DOUBLE PRECISION NOT NULL, INDEX numero_serie (numero_serie), INDEX ref_stock_article (ref_stock_article), PRIMARY KEY(numero_serie, ref_stock_article)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE stocks_articles_sn_virtuel (numero_serie VARCHAR(32) NOT NULL, ref_stock_article VARCHAR(32) NOT NULL, sn_qte DOUBLE PRECISION NOT NULL, sn_qte_traiter DOUBLE PRECISION DEFAULT NULL, sn_qte_mise_en_vente DOUBLE PRECISION DEFAULT NULL, sn_qte_a_remettre_en_poche DOUBLE PRECISION DEFAULT NULL, sn_qte_morte DOUBLE PRECISION DEFAULT NULL, sn_qte_perdu DOUBLE PRECISION DEFAULT NULL, INDEX numero_serie (numero_serie), INDEX ref_stock_article (ref_stock_article), PRIMARY KEY(numero_serie, ref_stock_article)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE stocks_cordes (id INT AUTO_INCREMENT NOT NULL, corde_id INT NOT NULL, processus_id INT DEFAULT NULL, emplacement_id INT DEFAULT NULL, ref_stock_article VARCHAR(32) DEFAULT NULL, numero_serie VARCHAR(32) NOT NULL, doc_line VARCHAR(32) DEFAULT NULL, quantiter INT NOT NULL, pret TINYINT(1) NOT NULL, chaussement TINYINT(1) NOT NULL, dateDeCreation DATE NOT NULL, date_de_mise_a_eau DATE DEFAULT NULL, dateDeRetraitTransfert DATE DEFAULT NULL, dateDeMAETransfert DATE DEFAULT NULL, dateAssemblage DATE DEFAULT NULL, dateChaussement DATE DEFAULT NULL, dateDeRetirement DATE DEFAULT NULL, INDEX IDX_35E2087DF9182269 (corde_id), INDEX IDX_35E2087DA55629DC (processus_id), UNIQUE INDEX UNIQ_35E2087DC4598A51 (emplacement_id), INDEX IDX_35E2087D3FCC49A5565B809 (ref_stock_article, numero_serie), INDEX IDX_35E2087D880E0320 (doc_line), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE stocks_lanternes (id INT AUTO_INCREMENT NOT NULL, lanterne_id VARCHAR(255) NOT NULL, processus_id INT DEFAULT NULL, emplacement_id INT DEFAULT NULL, ref_stock_article VARCHAR(32) DEFAULT NULL, numero_serie VARCHAR(32) NOT NULL, doc_line VARCHAR(32) DEFAULT NULL, pret TINYINT(1) NOT NULL, chaussement TINYINT(1) NOT NULL, dateDeCreation DATE NOT NULL, date_de_mise_a_eau DATE DEFAULT NULL, dateDeRetraitTransfert DATE DEFAULT NULL, dateDeMAETransfert DATE DEFAULT NULL, dateDeRetirement DATE DEFAULT NULL, dateChaussement DATE DEFAULT NULL, cycle_r INT NOT NULL, INDEX IDX_675D3C919F4902B6 (lanterne_id), INDEX IDX_675D3C91A55629DC (processus_id), UNIQUE INDEX UNIQ_675D3C91C4598A51 (emplacement_id), INDEX IDX_675D3C913FCC49A5565B809 (ref_stock_article, numero_serie), INDEX IDX_675D3C91880E0320 (doc_line), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE stocks_poches_bs (id INT AUTO_INCREMENT NOT NULL, pochesbs_id INT NOT NULL, processus_id INT DEFAULT NULL, ref_stock_article VARCHAR(32) DEFAULT NULL, numero_serie VARCHAR(32) DEFAULT NULL, emplacement_id INT DEFAULT NULL, corde_assemblage_id INT DEFAULT NULL, doc_line VARCHAR(32) DEFAULT NULL, quantiter INT NOT NULL, pret TINYINT(1) NOT NULL, chaussement TINYINT(1) NOT NULL, dateDeCreation DATE NOT NULL, dateDeMiseAEau DATE DEFAULT NULL, dateDeRetraitTransfert DATE DEFAULT NULL, dateDeMAETransfert DATE DEFAULT NULL, dateAssemblage DATE DEFAULT NULL, dateDeRetirement DATE DEFAULT NULL, dateChaussement DATE DEFAULT NULL, INDEX IDX_FFB442E384E991DD (pochesbs_id), INDEX IDX_FFB442E3A55629DC (processus_id), INDEX IDX_FFB442E33FCC49A5565B809 (ref_stock_article, numero_serie), UNIQUE INDEX UNIQ_FFB442E3C4598A51 (emplacement_id), INDEX IDX_FFB442E380B18279 (corde_assemblage_id), INDEX IDX_FFB442E3880E0320 (doc_line), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE tarifs_listes (id_tarif SMALLINT AUTO_INCREMENT NOT NULL, lib_tarif VARCHAR(32) NOT NULL, desc_tarif MEDIUMTEXT NOT NULL, marge_moyenne VARCHAR(32) NOT NULL, ordre SMALLINT NOT NULL, PRIMARY KEY(id_tarif)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE timeline (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE acl_classes (id INT UNSIGNED AUTO_INCREMENT NOT NULL, class_type VARCHAR(200) NOT NULL, UNIQUE INDEX UNIQ_69DD750638A36066 (class_type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE acl_security_identities (id INT UNSIGNED AUTO_INCREMENT NOT NULL, identifier VARCHAR(200) NOT NULL, username TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8835EE78772E836AF85E0677 (identifier, username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE acl_object_identities (id INT UNSIGNED AUTO_INCREMENT NOT NULL, parent_object_identity_id INT UNSIGNED DEFAULT NULL, class_id INT UNSIGNED NOT NULL, object_identifier VARCHAR(100) NOT NULL, entries_inheriting TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_9407E5494B12AD6EA000B10 (object_identifier, class_id), INDEX IDX_9407E54977FA751A (parent_object_identity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE acl_object_identity_ancestors (object_identity_id INT UNSIGNED NOT NULL, ancestor_id INT UNSIGNED NOT NULL, INDEX IDX_825DE2993D9AB4A6 (object_identity_id), INDEX IDX_825DE299C671CEA1 (ancestor_id), PRIMARY KEY(object_identity_id, ancestor_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE acl_entries (id INT UNSIGNED AUTO_INCREMENT NOT NULL, class_id INT UNSIGNED NOT NULL, object_identity_id INT UNSIGNED DEFAULT NULL, security_identity_id INT UNSIGNED NOT NULL, field_name VARCHAR(50) DEFAULT NULL, ace_order SMALLINT UNSIGNED NOT NULL, mask INT NOT NULL, granting TINYINT(1) NOT NULL, granting_strategy VARCHAR(30) NOT NULL, audit_success TINYINT(1) NOT NULL, audit_failure TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_46C8B806EA000B103D9AB4A64DEF17BCE4289BF4 (class_id, object_identity_id, field_name, ace_order), INDEX IDX_46C8B806EA000B103D9AB4A6DF9183C9 (class_id, object_identity_id, security_identity_id), INDEX IDX_46C8B806EA000B10 (class_id), INDEX IDX_46C8B8063D9AB4A6 (object_identity_id), INDEX IDX_46C8B806DF9183C9 (security_identity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user_user (id) ON DELETE CASCADE;
ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447FE54D947 FOREIGN KEY (group_id) REFERENCES fos_user_group (id) ON DELETE CASCADE;
ALTER TABLE timeline__action_component ADD CONSTRAINT FK_6ACD1B169D32F035 FOREIGN KEY (action_id) REFERENCES timeline__action (id) ON DELETE CASCADE;
ALTER TABLE timeline__action_component ADD CONSTRAINT FK_6ACD1B16E2ABAFFF FOREIGN KEY (component_id) REFERENCES timeline__component (id) ON DELETE CASCADE;
ALTER TABLE timeline__timeline ADD CONSTRAINT FK_FFBC6AD59D32F035 FOREIGN KEY (action_id) REFERENCES timeline__action (id);
ALTER TABLE timeline__timeline ADD CONSTRAINT FK_FFBC6AD523EDC87 FOREIGN KEY (subject_id) REFERENCES timeline__component (id) ON DELETE CASCADE;
ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168106D6E95 FOREIGN KEY (ref_art_categ) REFERENCES art_categs (ref_art_categ);
ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168B960C52B FOREIGN KEY (id_valo) REFERENCES articles_valorisations (id_valo);
ALTER TABLE articles_modele_materiel ADD CONSTRAINT FK_A13E48A7C62E5DB6 FOREIGN KEY (ref_article) REFERENCES articles (ref_article);
ALTER TABLE corde ADD CONSTRAINT FK_10C99A9F54AF5F27 FOREIGN KEY (magasin) REFERENCES magasins (id_magasin);
ALTER TABLE docs_lines ADD CONSTRAINT FK_4F432E4E8ABB67EB FOREIGN KEY (ref_doc_line_parent) REFERENCES docs_lines (ref_doc_line);
ALTER TABLE docs_lines ADD CONSTRAINT FK_4F432E4E42BE39FA FOREIGN KEY (ref_doc) REFERENCES documents (ref_doc);
ALTER TABLE docs_lines_sn ADD CONSTRAINT FK_A86F6F76E19C5A7 FOREIGN KEY (ref_doc_line) REFERENCES docs_lines (ref_doc_line);
ALTER TABLE documents ADD CONSTRAINT FK_A2B07288737EF27F FOREIGN KEY (id_pays_contact) REFERENCES pays (id_pays);
ALTER TABLE documents ADD CONSTRAINT FK_A2B072885B8597ED FOREIGN KEY (ref_adr_contact) REFERENCES adresses (ref_adresse);
ALTER TABLE documents ADD CONSTRAINT FK_A2B072888876B5E8 FOREIGN KEY (ref_contact) REFERENCES annuaire (ref_contact);
ALTER TABLE documents ADD CONSTRAINT FK_A2B072889041C869 FOREIGN KEY (id_etat_doc) REFERENCES documents_etats (id_etat_doc);
ALTER TABLE documents ADD CONSTRAINT FK_A2B07288D48DF710 FOREIGN KEY (id_type_doc) REFERENCES documents_types (id_type_doc);
ALTER TABLE documents_types ADD CONSTRAINT FK_65778722D31FA908 FOREIGN KEY (id_pdf_modele) REFERENCES pdf_modeles (id_pdf_modele);
ALTER TABLE emplacement ADD CONSTRAINT FK_C0CF65F69AE7A92D FOREIGN KEY (flotteur_id) REFERENCES flotteur (id);
ALTER TABLE filiere ADD CONSTRAINT FK_2ED05D9E54AF5F27 FOREIGN KEY (magasin) REFERENCES magasins (id_magasin);
ALTER TABLE flotteur ADD CONSTRAINT FK_8C4208E7DB296AAD FOREIGN KEY (segment_id) REFERENCES segment (id);
ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5ECFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES fos_user_user (id);
ALTER TABLE lanterne ADD CONSTRAINT FK_6C206D1854AF5F27 FOREIGN KEY (magasin) REFERENCES magasins (id_magasin);
ALTER TABLE magasins ADD CONSTRAINT FK_BE50D53FA5B31750 FOREIGN KEY (id_stock) REFERENCES stocks (id_stock);
ALTER TABLE magasins ADD CONSTRAINT FK_BE50D53FE0F4C8F9 FOREIGN KEY (id_tarif) REFERENCES tarifs_listes (id_tarif);
ALTER TABLE poche ADD CONSTRAINT FK_86D8F186524B0562 FOREIGN KEY (stocklanterne_id) REFERENCES stocks_lanternes (id);
ALTER TABLE poches_bs ADD CONSTRAINT FK_90E7094254AF5F27 FOREIGN KEY (magasin) REFERENCES magasins (id_magasin);
ALTER TABLE processus ADD CONSTRAINT FK_EEEA8C1D6AB2EA46 FOREIGN KEY (id_processus_parent_id) REFERENCES processus (id);
ALTER TABLE processus ADD CONSTRAINT FK_EEEA8C1DC62E5DB6 FOREIGN KEY (ref_article) REFERENCES articles (ref_article);
ALTER TABLE processus ADD CONSTRAINT FK_EEEA8C1D477FF5A2 FOREIGN KEY (phases_processus_id) REFERENCES phases (id);
ALTER TABLE segment ADD CONSTRAINT FK_1881F565180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id);
ALTER TABLE segment ADD CONSTRAINT FK_1881F565B4465BB FOREIGN KEY (ancestor) REFERENCES filiere (id) ON DELETE CASCADE;
ALTER TABLE segment ADD CONSTRAINT FK_1881F5659A8FAD16 FOREIGN KEY (descendant) REFERENCES filiere (id) ON DELETE CASCADE;
ALTER TABLE stocks_articles ADD CONSTRAINT FK_5CE171BEC62E5DB6 FOREIGN KEY (ref_article) REFERENCES articles (ref_article);
ALTER TABLE stocks_articles ADD CONSTRAINT FK_5CE171BEA5B31750 FOREIGN KEY (id_stock) REFERENCES stocks (id_stock);
ALTER TABLE stocks_articles_sn ADD CONSTRAINT FK_18509FEA3FCC49A5 FOREIGN KEY (ref_stock_article) REFERENCES stocks_articles (ref_stock_article);
ALTER TABLE stocks_articles_sn_virtuel ADD CONSTRAINT FK_7712F2063FCC49A5 FOREIGN KEY (ref_stock_article) REFERENCES stocks_articles (ref_stock_article);
ALTER TABLE stocks_cordes ADD CONSTRAINT FK_35E2087DF9182269 FOREIGN KEY (corde_id) REFERENCES corde (id);
ALTER TABLE stocks_cordes ADD CONSTRAINT FK_35E2087DA55629DC FOREIGN KEY (processus_id) REFERENCES processus (id);
ALTER TABLE stocks_cordes ADD CONSTRAINT FK_35E2087DC4598A51 FOREIGN KEY (emplacement_id) REFERENCES emplacement (id);
ALTER TABLE stocks_cordes ADD CONSTRAINT FK_35E2087D3FCC49A5565B809 FOREIGN KEY (ref_stock_article, numero_serie) REFERENCES stocks_articles_sn (ref_stock_article, numero_serie);
ALTER TABLE stocks_cordes ADD CONSTRAINT FK_35E2087D880E0320 FOREIGN KEY (doc_line) REFERENCES docs_lines (ref_doc_line);
ALTER TABLE stocks_lanternes ADD CONSTRAINT FK_675D3C919F4902B6 FOREIGN KEY (lanterne_id) REFERENCES lanterne (nomLanterne);
ALTER TABLE stocks_lanternes ADD CONSTRAINT FK_675D3C91A55629DC FOREIGN KEY (processus_id) REFERENCES processus (id);
ALTER TABLE stocks_lanternes ADD CONSTRAINT FK_675D3C91C4598A51 FOREIGN KEY (emplacement_id) REFERENCES emplacement (id);
ALTER TABLE stocks_lanternes ADD CONSTRAINT FK_675D3C913FCC49A5565B809 FOREIGN KEY (ref_stock_article, numero_serie) REFERENCES stocks_articles_sn (ref_stock_article, numero_serie);
ALTER TABLE stocks_lanternes ADD CONSTRAINT FK_675D3C91880E0320 FOREIGN KEY (doc_line) REFERENCES docs_lines (ref_doc_line);
ALTER TABLE stocks_poches_bs ADD CONSTRAINT FK_FFB442E384E991DD FOREIGN KEY (pochesbs_id) REFERENCES poches_bs (id);
ALTER TABLE stocks_poches_bs ADD CONSTRAINT FK_FFB442E3A55629DC FOREIGN KEY (processus_id) REFERENCES processus (id);
ALTER TABLE stocks_poches_bs ADD CONSTRAINT FK_FFB442E33FCC49A5565B809 FOREIGN KEY (ref_stock_article, numero_serie) REFERENCES stocks_articles_sn (ref_stock_article, numero_serie);
ALTER TABLE stocks_poches_bs ADD CONSTRAINT FK_FFB442E3C4598A51 FOREIGN KEY (emplacement_id) REFERENCES emplacement (id);
ALTER TABLE stocks_poches_bs ADD CONSTRAINT FK_FFB442E380B18279 FOREIGN KEY (corde_assemblage_id) REFERENCES stocks_cordes (id);
ALTER TABLE stocks_poches_bs ADD CONSTRAINT FK_FFB442E3880E0320 FOREIGN KEY (doc_line) REFERENCES docs_lines (ref_doc_line);
ALTER TABLE acl_object_identities ADD CONSTRAINT FK_9407E54977FA751A FOREIGN KEY (parent_object_identity_id) REFERENCES acl_object_identities (id);
ALTER TABLE acl_object_identity_ancestors ADD CONSTRAINT FK_825DE2993D9AB4A6 FOREIGN KEY (object_identity_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE acl_object_identity_ancestors ADD CONSTRAINT FK_825DE299C671CEA1 FOREIGN KEY (ancestor_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B806EA000B10 FOREIGN KEY (class_id) REFERENCES acl_classes (id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B8063D9AB4A6 FOREIGN KEY (object_identity_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B806DF9183C9 FOREIGN KEY (security_identity_id) REFERENCES acl_security_identities (id) ON UPDATE CASCADE ON DELETE CASCADE;
');
    }
}
