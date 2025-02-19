<?php

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Bundle\FrameworkBundle\Console\Application;

require 'vendor/autoload.php';

// Définir les variables d'environnement pour SQLite temporairement
putenv('DATABASE_URL=sqlite://' . realpath(__DIR__) . '/var/data.db');
putenv('OYSTERPRO_DATABASE_URL=sqlite://' . realpath(__DIR__) . '/var/oysterpro.db');

$kernel = new \App\Kernel('dev', false);
$kernel->boot();

$application = new Application($kernel);
$application->setAutoExit(false);

// Exécuter la commande assets:install
$input = new ArrayInput([
    'command' => 'assets:install',
    '--symlink' => true,
    '--no-debug' => true,
]);

$output = new ConsoleOutput();
$application->run($input, $output);
