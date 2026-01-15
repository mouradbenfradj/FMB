<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class StockArticleSnService
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function preparation($lot, $densite)
    {
        $lot->setSnQte($lot->getSnQte() - $densite);
        $this->entityManager->persist($lot);
    }
}
