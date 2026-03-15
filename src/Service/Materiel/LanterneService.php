<?php

namespace App\Service\Materiel;

use App\Entity\StockLanterne;
use App\Service\StockArticleSnService;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\Materiel\StockLanterneService;
use App\Service\Interface\TravailleAFaireInterface;

class LanterneService implements TravailleAFaireInterface
{

    private EntityManagerInterface $entityManager;
    private StockLanterneService $stockLanterneService;
    private StockArticleSnService $stockArticleSnService;

    public function __construct(EntityManagerInterface $entityManager, StockLanterneService $stockLanterneService, StockArticleSnService $stockArticleSnService)
    {
        $this->entityManager = $entityManager;
        $this->stockLanterneService = $stockLanterneService;
        $this->stockArticleSnService = $stockArticleSnService;
    }

    public function preparation(object $materiel)
    {
        $lanterneChoisie = $materiel->getLanterne();
        $quantiteEnStock = $materiel->getLanterne()->getNbrEnStock();
        $nombreAFabriquer = $materiel->getNombre();
        $lanterneChoisie->setNbrEnStock($quantiteEnStock - $nombreAFabriquer);
        $lot = $materiel->getLot();
        $this->entityManager->persist($lanterneChoisie);
        for ($i = 0; $i < $nombreAFabriquer; $i++) {
            $this->stockArticleSnService->preparation($lot, 1); // Assuming density 1 for lanterne
            $this->stockLanterneService->preparation($lanterneChoisie, $lot, $materiel->getDatedecreation());
        }
    }
    public function mae(object $formData, $emplacementsIds, $parc)
    {
        dd('mae');
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
