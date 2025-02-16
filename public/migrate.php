<?php
// public/migrate.php

// Mot de passe simple pour sécuriser l'accès
$password = 'TonMotDePasseUltraSecurise';

// Vérifie le mot de passe
if (!isset($_GET['password']) || $_GET['password'] !== $password) {
    http_response_code(403);
    echo 'Accès refusé';
    exit;
}

// Charge les composants Symfony et exécute les migrations
require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;

// Charge les variables d'environnement
$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../.env.local');

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Bundle\FrameworkBundle\Console\Application;

$kernel = new \App\Kernel('prod', false);
$kernel->boot();

$application = new Application($kernel);
$application->setAutoExit(false);

// Définir la variable d'environnement pour exclure la migration
putenv('SKIP_MIGRATION_20231021152830=true');

echo nl2br($outputMigrate->fetch());

// Exécute la commande doctrine:schema:update
$inputSchemaUpdate = new ArrayInput([
    'command' => 'doctrine:schema:update',
    '--force' => true, // Force l'exécution sans confirmation
    '--no-interaction' => true, // Pas d'interaction
]);
// Exécute la commande doctrine:schema:update
$inputAssets = new ArrayInput([
    'command' => 'assets:install',
    '--symlink' => true, // Force l'exécution sans confirmation
    '--no-debug' => true, // Pas d'interaction
]);
$outputSchemaUpdate = new BufferedOutput();

$application->run($inputAssets, $outputSchemaUpdate);
$application->run($inputSchemaUpdate, $outputSchemaUpdate);

echo nl2br($outputSchemaUpdate->fetch());
