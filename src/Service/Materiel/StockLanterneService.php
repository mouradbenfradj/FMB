<?php

namespace App\Service\Materiel;

use App\Entity\StockLanterne;
use Doctrine\ORM\EntityManagerInterface;

class StockLanterneService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function preparation($lanterneChoisie, $lot, $datedecreation)
    {
        $stockLanterne = new StockLanterne();
        $stockLanterne->setLanterne($lanterneChoisie);
        $stockLanterne->setStockArticleSn($lot);
        $stockLanterne->setDatedecreation($datedecreation);
        $stockLanterne->setPret(false);
        $this->entityManager->persist($stockLanterne);
    }

    // Add other methods as needed
}
