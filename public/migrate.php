<?php

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Dotenv\Dotenv;

// Charge les composants Symfony et exécute les migrations
require __DIR__ . '/../vendor/autoload.php';

// Mot de passe simple pour sécuriser l'accès
$password = 'MBF6mm09761130';

// Vérifie le mot de passe
if (!isset($_GET['password']) || $_GET['password'] !== $password) {
    http_response_code(403);
    echo 'Accès refusé';
    exit;
}

// Charge les variables d'environnement
$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../.env.local');

$kernel = new \App\Kernel('prod', false);
$kernel->boot();

$application = new Application($kernel);
$application->setAutoExit(false);

// Définir la variable d'environnement pour exclure la migration
putenv('SKIP_MIGRATION_20231021152830=true');

// Pour le débogage, initialiser les sorties
$outputSchemaUpdate = new BufferedOutput();
$outputAssetsInstall = new BufferedOutput();

// Exécute la commande assets:install
$inputAssets = new ArrayInput([
    'command' => 'assets:install',
    '--symlink' => true,
    '--no-debug' => true,
]);

try {
    $application->run($inputAssets, $outputAssetsInstall);
    echo "Commande assets:install exécutée avec succès:\n";
    echo nl2br($outputAssetsInstall->fetch());
} catch (\Exception $e) {
    echo "Erreur lors de l'exécution de assets:install:\n";
    echo $e->getMessage();
}

// Exécute la commande doctrine:schema:update
$inputSchemaUpdate = new ArrayInput([
    'command' => 'doctrine:schema:update',
    '--force' => true,
    '--no-interaction' => true,
]);

try {
    $application->run($inputSchemaUpdate, $outputSchemaUpdate);
    echo "Commande doctrine:schema:update exécutée avec succès:\n";
    echo nl2br($outputSchemaUpdate->fetch());
} catch (\Exception $e) {
    echo "Erreur lors de l'exécution de doctrine:schema:update:\n";
    echo $e->getMessage();
}
