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
    protected const DELIMITER = '--DELIMITER--';

    public function up(Schema $schema): void
    {
        // Vérifiez si la variable d'environnement 'SKIP_MIGRATION_20231021152830' est définie
        if (getenv('SKIP_MIGRATION_20231021152830')) {
            echo "Migration skipped due to environment variable setting.\n";
            return;
        }

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
        $this->connection->executeQuery('SET GLOBAL max_allowed_packet = 1073741824;');
        $this->connection->executeQuery('SET GLOBAL wait_timeout = 31536000;');

        $sqlCommands = file_exists(self::SQL_FILE)
            ? explode(self::DELIMITER, file_get_contents(self::SQL_FILE))
            : [];

        $batchSize = 1000; // Nombre de commandes SQL par lot
        $batch = [];

        foreach ($sqlCommands as $sql) {
            $sql = trim($sql);
            if (!empty($sql)) {
                $batch[] = $sql;
                if (count($batch) >= $batchSize) {
                    $this->executeBatch($batch);
                    $batch = [];
                }
            }
        }

        // Exécuter les commandes restantes
        if (!empty($batch)) {
            $this->executeBatch($batch);
        }
    }



    protected function executeBatch(array $batch): void
    {
        try {
            $this->connection->beginTransaction();
            foreach ($batch as $sql) {
                $this->addSql($sql);
            }
            $this->connection->commit();
        } catch (\Exception $e) {
            $this->connection->rollBack();
            echo "Erreur lors de l'exécution du lot de commandes SQL.\n";
            echo "Message d'erreur : " . $e->getMessage() . "\n";
        }
    }


    public function postUp(Schema $schema): void
    {
        echo "Tout a été correctement installé.\n";
    }
}
