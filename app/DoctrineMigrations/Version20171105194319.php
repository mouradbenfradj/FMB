<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171105194319 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adresses CHANGE ref_adresse ref_adresse VARCHAR(32) NOT NULL');
        $this->addSql('ALTER TABLE annuaire CHANGE ref_contact ref_contact VARCHAR(32) NOT NULL');
        $this->addSql('ALTER TABLE pdf_types CHANGE id_pdf_type id_pdf_type TINYINT(1) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adresses CHANGE ref_adresse ref_adresse VARCHAR(32) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE annuaire CHANGE ref_contact ref_contact VARCHAR(32) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE pdf_types CHANGE id_pdf_type id_pdf_type TINYINT(1) NOT NULL');
    }
}
