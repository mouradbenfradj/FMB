<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231021152830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {

        // Get the SQL file content
        $sqlContent = file_get_contents(__DIR__ . '/admin_oysterpro_db.sql');

        // Execute the SQL queries
        //$this->addSql($sqlContent, [], [], ['connection' => 'oysterpro']);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
