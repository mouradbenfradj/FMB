<?php

require_once 'vendor/autoload.php';

use App\Kernel;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\StockCorde;

$kernel = new Kernel('dev', true);
$kernel->boot();

$container = $kernel->getContainer();
$entityManager = $container->get(EntityManagerInterface::class);

// Try to find an existing StockCorde entity
$stockCorde = $entityManager->getRepository(StockCorde::class)->findOneBy([]);

if (!$stockCorde) {
    echo "No StockCorde entities found in database. Creating a test entity...\n";

    // Create a minimal test entity (this might fail if required relations are missing)
    $stockCorde = new StockCorde();
    $stockCorde->setQuantiter(10);
    $stockCorde->setLongeur(100.0);
    $stockCorde->setPret(false);
    $stockCorde->setDatedecreation(new \DateTime());
    $stockCorde->setChaussement(false);

    // Note: This will likely fail due to missing required relations (Corde, StockArticleSn)
    // But we can still test the listener by loading it after creation
    try {
        $entityManager->persist($stockCorde);
        $entityManager->flush();
        echo "Test StockCorde entity created.\n";
    } catch (\Exception $e) {
        echo "Could not create test entity: " . $e->getMessage() . "\n";
        echo "Testing with existing entities only.\n";
        exit(1);
    }
}

// Test if MouleCalculator is injected
try {
    $poid = $stockCorde->getPoid(30); // Test with age 30
    echo "SUCCESS: MouleCalculator is properly injected. Calculated weight: " . $poid . "\n";
} catch (\RuntimeException $e) {
    if (str_contains($e->getMessage(), 'MouleCalculator not injected')) {
        echo "FAILURE: MouleCalculator was not injected by the listener.\n";
    } else {
        echo "ERROR: " . $e->getMessage() . "\n";
    }
} catch (\Exception $e) {
    echo "ERROR during weight calculation: " . $e->getMessage() . "\n";
}

$kernel->shutdown();
