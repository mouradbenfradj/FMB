<?php

namespace App\Service\TravailleAFaire\Preparation;

use App\Entity\Corde;
use App\Entity\StockCorde;
use App\Entity\StockArticleSn;
use App\Service\Interface\PreparationInterface;

class PreparationCordeService
{
    private Corde $corde;
    private StockArticleSn $stockArticleSn;
    public function __construct(Corde $corde, StockArticleSn $stockArticleSn)
    {
        $this->corde = $corde;
        $this->stockArticleSn = $stockArticleSn;
    }

    public function setCorde(Corde $corde)
    {
        $this->corde = $corde;
    }
    public function setStockArticleSn(StockArticleSn $stockArticleSn)
    {
        $this->stockArticleSn = $stockArticleSn;
    }

    public function prepare($materiel, $quantiteEnStock, $nombreChoisie, $nombreAFabriquer, $lot)
    {

        $this->corde = $materiel->getCorde();
        $quantiteEnStock = $materiel->getCorde()->getQuantite();
        $nombreChoisie = $materiel->getNombre();
        $this->corde->setQuantite($quantiteEnStock - $nombreChoisie);
        $this->entityManager->persist($this->corde);
        $nombreAFabriquer = $materiel->getNombre();
        $lot = $materiel->getLot();








        $this->corde->setQuantite($quantiteEnStock - $nombreChoisie);
        $quantiteADiminuer = $lot->getSnQte();
        for ($i = 0; $i < $nombreAFabriquer; $i++) {
            $quantiteADiminuer = $quantiteADiminuer - $materiel->getDensite();

            $stockCorde = new StockCorde();

            $stockCorde->setStockArticleSn($lot);
            $stockCorde->setDatedecreation($materiel->getDatedecreation());
            $stockCorde->setLongeur($materiel->getLongeur());
            $stockCorde->setQuantite($materiel->getDensite());
            $this->corde->addStockCorde($stockCorde);
        }
        $lot->setSnQte($quantiteADiminuer);
        $this->entityManager->persist($lot);
        $this->entityManager->persist($this->corde);
    }
}
