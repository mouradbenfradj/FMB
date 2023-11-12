<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20231021152830 extends AbstractMigration
{
    protected $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function up(Schema $schema): void
    {
        ini_set('max_execution_time', '0');
        ini_set('memory_limit', '512M');

        // Check if the current connection is associated with the 'oysterpro' database
        if ($this->isOysterProConnection()) {

            foreach (explode(';', file_get_contents(__DIR__ . '/admin_oysterpro_db.sql')) as $sql) {
                if (strlen(trim($sql)) > 0) {
                    $this->addSql($sql);
                }
            }
        }
    }

    /**
     * Check if the current connection is associated with the 'oysterpro' database.
     *
     * @return bool
     */
    private function isOysterProConnection(): bool
    {
        // Replace 'oysterpro' with the actual name of the 'oysterpro' database
        $connectionParams = $this->connection->getParams();
        return $connectionParams['dbname'] === 'oysterpro';
    }
}