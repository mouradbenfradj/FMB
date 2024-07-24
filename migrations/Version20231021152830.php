<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20231021152830 extends AbstractMigration
{
    /*
        docker cp www_asc:/var/www/asc/migrations/admin_oysterpro_db.sql ./admin_oysterpro_db.sql

        docker cp ./admin_oysterpro_db.sql db_oysterpro:/tmp/admin_oysterpro_db.sql

        docker exec -it db_oysterpro /bin/bash -c "mysql -u root -pmourad oysterpro < /tmp/admin_oysterpro_db.sql"

        docker exec -it db_oyster /bin/bash -c "mysql -u root -pmourad oysterpro < /tmp/admin_oysterpro_db.sql"
     */
    protected const DB_NAME = 'oysterpro';
    protected const SQL_FILE = __DIR__ . '/admin_oysterpro_db.sql';

    public function up(Schema $schema): void
    {
        ini_set('max_execution_time', '0');
        ini_set('memory_limit', '512M');

        if ($this->isOysterProConnection()) {
            $this->executeSqlFile();
        }
    }

    protected function isOysterProConnection(): bool
    {
        $connectionParams = $this->connection->getParams();
        return $connectionParams['dbname'] === self::DB_NAME;
    }

    protected function executeSqlFile(): void
    {
        $sqlCommands = file_exists(self::SQL_FILE)
            ? explode(';', file_get_contents(self::SQL_FILE))
            : [];

        foreach ($sqlCommands as $sql) {
            $sql = trim($sql);
            if (!empty($sql)) {
                $this->addSql($sql);
            }
        }
    }

    public function postUp(Schema $schema): void
    {
        echo "Tout a été correctement installé.\n";
    }
}
