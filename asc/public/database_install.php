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
// 🎯 CRÉATION DE L'ADMIN SONATA (pattern identique à votre fixture)
try {
    echo "<br><strong style='color:orange;'>🔍 Début de la création de l'admin...</strong><br>";

    $container = $kernel->getContainer();
    if (!$container->has('doctrine.orm.entity_manager')) {
        throw new \Exception("Le service doctrine.orm.entity_manager n'est pas disponible");
    }

    $entityManager = $container->get('doctrine.orm.entity_manager');
    $userRepository = $entityManager->getRepository(\App\Entity\User::class);

    echo "<strong>✓ EntityManager chargé</strong><br>";

    // Vérifie si un admin existe déjà (par username)
    $existingAdmin = $userRepository->createQueryBuilder('u')
        ->where('u.username = :username')
        ->setParameter('username', 'admin')
        ->getQuery()
        ->getOneOrNullResult();

    if ($existingAdmin) {
        echo "<strong style='color:blue;'>ℹ️ Utilisateur 'admin' existe déjà (ID: " . $existingAdmin->getId() . "). Aucune action nécessaire.</strong>";
    } else {
        echo "<strong>✓ Aucun admin existant, création en cours...</strong><br>";

        // **CRÉATION IDENTIQUE À VOTRE FIXTURE**
        $admin = new \App\Entity\User();
        $admin->setUsername('mourad');
        $admin->setEmail('mourad.ben.fradj@gmail.com.com');
        $admin->setEnabled(true);
        $admin->setRoles(['ROLE_ADMIN', 'ROLE_SONATA_ADMIN']); // Sonata nécessite ROLE_SONATA_ADMIN
        $admin->setSuperAdmin(true); // Comme dans votre fixture

        // Hachage du mot de passe
        $passwordHasher = $container->get('security.password_hasher');
        $plainPassword = 'mourad!'; // Mot de passe temporaire
        $hashedPassword = $passwordHasher->hashPassword($admin, $plainPassword);
        $admin->setPassword($hashedPassword);

        // Persister et sauvegarder
        $entityManager->persist($admin);
        $entityManager->flush();

        echo "<br><strong style='color:green;'>✅ Admin Sonata créé avec succès !</strong><br>";
        echo "<strong>Login:</strong> admin<br>";
        echo "<strong>Mot de passe temporaire:</strong> " . htmlspecialchars($plainPassword) . "<br>";
        echo "<strong style='color:red;'>⚠️ CHANGEZ CE MOT DE PASSE IMMÉDIATEMENT APRÈS LA PREMIÈRE CONNEXION !</strong>";
    }
} catch (\Exception $e) {
    echo "<br><strong style='color:red;'>❌ ERREUR CRITIQUE:</strong> " . htmlspecialchars($e->getMessage()) . "<br>";
    echo "<strong>Fichier:</strong> " . $e->getFile() . ":" . $e->getLine() . "<br>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
