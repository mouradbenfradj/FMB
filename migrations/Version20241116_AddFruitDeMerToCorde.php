<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Ajoute la relation fruit_de_mer_id à la table corde
 */
final class Version20241116_AddFruitDeMerToCorde extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajoute la colonne fruit_de_mer_id à la table corde pour filtrer par type de fruit de mer';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE corde ADD fruit_de_mer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE corde ADD CONSTRAINT FK_74C0291F8B3C8E48 FOREIGN KEY (fruit_de_mer_id) REFERENCES fruit_de_mer (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_74C0291F8B3C8E48 ON corde (fruit_de_mer_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE corde DROP FOREIGN KEY FK_74C0291F8B3C8E48');
        $this->addSql('DROP INDEX IDX_74C0291F8B3C8E48 ON corde');
        $this->addSql('ALTER TABLE corde DROP fruit_de_mer_id');
    }
}
