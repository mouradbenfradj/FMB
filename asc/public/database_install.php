<?php

// public/migrate.php

// Mot de passe simple pour sécuriser l'accès
$password = 'MBF6mm09761130';

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

// Exécute la commande doctrine:schema:update
$inputSchemaUpdate = new ArrayInput([
    'command' => 'doctrine:schema:update',
    '--force' => true,
    '--dump-sql' => true,
    '--no-interaction' => true,
]);
$outputSchemaUpdate = new BufferedOutput();

$application->run($inputSchemaUpdate, $outputSchemaUpdate);

echo nl2br($outputSchemaUpdate->fetch());
$inputSchemaUpdate = new ArrayInput([
    'command' => 'cache:clear'
]);
$outputSchemaUpdate = new BufferedOutput();

$application->run($inputSchemaUpdate, $outputSchemaUpdate);

echo nl2br($outputSchemaUpdate->fetch());
// 🎯 CRÉATION DE L'ADMIN SONATA (version mourad)
try {
    echo "<br><strong style='color:orange;'>🔍 Début de la création de l'utilisateur...</strong><br>";

    $container = $kernel->getContainer();
    $entityManager = $container->get('doctrine.orm.entity_manager');
    $userRepository = $entityManager->getRepository(\App\Entity\User::class);

    echo "<strong>✓ EntityManager chargé</strong><br>";

    // Vérifie si l'utilisateur 'mourad' existe déjà
    $existingAdmin = $userRepository->findOneBy(['username' => 'mourad']);

    if ($existingAdmin) {
        echo "<strong style='color:blue;'>ℹ️ Utilisateur 'mourad' existe déjà. Aucune action nécessaire.</strong>";
    } else {
        echo "<strong>✓ Aucun utilisateur 'mourad' existant, création en cours...</strong><br>";

        // **CRÉATION DE L'UTILISATEUR MOURAD**
        try {
            $admin = new \App\Entity\User();
            $admin->setUsername('mourad');
            $admin->setEmail('mourad.ben.fradj@gmail.com');
            $admin->setEnabled(true);
            $admin->setRoles(['ROLE_ADMIN', 'ROLE_SONATA_ADMIN']);
            $admin->setSuperAdmin(true);
            echo "<strong>✓ Données utilisateur configurées</strong><br>";
        } catch (\Exception $e) {
            die("<strong style='color:red;'>❌ Erreur configuration: " . $e->getMessage() . "</strong>");
        }

        // Hachage du mot de passe
        try {
            $passwordHasher = $container->get('security.password_hasher');
            $plainPassword = 'mourad';
            $hashedPassword = $passwordHasher->hashPassword($admin, $plainPassword);
            $admin->setPassword($hashedPassword);
            echo "<strong>✓ Mot de passe hashé</strong><br>";
        } catch (\Exception $e) {
            die("<strong style='color:red;'>❌ Erreur hachage: " . $e->getMessage() . "</strong>");
        }

        // Persistance et sauvegarde
        try {
            $entityManager->persist($admin);
            $entityManager->flush();
            echo "<strong>✓ Utilisateur sauvegardé en base</strong><br>";
        } catch (\Exception $e) {
            die("<strong style='color:red;'>❌ Erreur sauvegarde: " . $e->getMessage() . "</strong>");
        }

        // Message final
        echo "<br><strong style='color:green;'>✅ Utilisateur MOURAD créé avec succès !</strong><br>";
        echo "<strong>Login:</strong> mourad<br>";
        echo "<strong>Mot de passe:</strong> " . htmlspecialchars($plainPassword) . "<br>";
        echo "<strong style='color:red;'>⚠️ CHANGEZ CE MOT DE PASSE IMMÉDIATEMENT APRÈS LA PREMIÈRE CONNEXION !</strong>";
    }
} catch (\Exception $e) {
    echo "<br><strong style='color:red;'>❌ ERREUR CRITIQUE:</strong> " . htmlspecialchars($e->getMessage()) . "<br>";
}
