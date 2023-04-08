<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171104204843 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE ext_log_entries');
        $this->addSql('DROP TABLE ext_translations');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('ALTER TABLE adresses CHANGE ref_adresse ref_adresse VARCHAR(32) NOT NULL');
        $this->addSql('ALTER TABLE annuaire CHANGE ref_contact ref_contact VARCHAR(32) NOT NULL');
        $this->addSql('ALTER TABLE pdf_types CHANGE id_pdf_type id_pdf_type TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE stocks_articles CHANGE ref_stock_article ref_stock_article VARCHAR(32) NOT NULL');
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
        $this->addSql('ALTER TABLE stocks_articles CHANGE ref_stock_article ref_stock_article VARCHAR(32) NOT NULL COLLATE utf8_unicode_ci');
    }
}
