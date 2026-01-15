<?php

namespace App\Service\Materiel;

use App\Entity\StockCorde;
use App\Service\StockArticleSnService;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\Materiel\StockCordeService;
use App\Service\Interface\TravailleAFaireInterface;

class CordeService implements TravailleAFaireInterface
{

    private EntityManagerInterface $entityManager;
    private StockCordeService $stockCordeService;
    private StockArticleSnService $stockArticleSnService;

    public function __construct(EntityManagerInterface $entityManager, StockCordeService $stockCordeService, StockArticleSnService $stockArticleSnService)
    {
        $this->entityManager = $entityManager;
        $this->stockCordeService = $stockCordeService;
        $this->stockArticleSnService = $stockArticleSnService;
    }
    public function preparation(object $materiel)
    {
        $materielChoisie = $materiel->getCorde();
        $quantiterEnStock = $materiel->getCorde()->getQuantiter();
        $nombreAFabriquer = $materiel->getNombre();
        $materielChoisie->setQuantiter($quantiterEnStock - $nombreAFabriquer);
        $lot = $materiel->getLot();
        $this->entityManager->persist($materielChoisie);
        for ($i = 0; $i < $nombreAFabriquer; $i++) {
            $this->stockArticleSnService->preparation($lot, $materiel->getDensite());
            $this->stockCordeService->preparation($materielChoisie, $lot, $materiel->getDatedecreation(), $materiel->getLongeur(), $materiel->getDensite());
        }
    }
    public function mae(object $formData, $emplacementsIds, $parc)
    {
        dd('mar');
    }
    public function retrait(object $materiel)
    {
        dd('retrait');
    }
    public function assemblage(object $materiel)
    {
        dd('assemblage');
    }
    public function passageChaussette(object $materiel)
    {
        dd('passageChaussette');
    }
    public function traitementComerciale(object $materiel)
    {
        dd('traitementComerciale');
    }
}
