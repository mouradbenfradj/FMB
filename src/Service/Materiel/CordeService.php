<?php

namespace App\Service\Materiel;

use App\Entity\StockCorde;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\Interface\TravailleAFaireInterface;

class CordeService implements TravailleAFaireInterface
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function preparation(object $materiel)
    {
        $materielChoisie = $materiel->getCorde();
        $quantiterEnStock = $materiel->getCorde()->getQuantiter();
        $nombreChoisie = $materiel->getNombre();
        $materielChoisie->setQuantiter($quantiterEnStock - $nombreChoisie);
        $this->entityManager->persist($materielChoisie);
        $nombreAFabriquer = $materiel->getNombre();
        $lot = $materiel->getLot();
        for ($i = 0; $i < $nombreAFabriquer; $i++) {
            $lot->setSnQte($lot->getSnQte() - $materiel->getDensite());
            $this->entityManager->persist($lot);
            $stockCorde = new StockCorde();
            $stockCorde->setCorde($materielChoisie);
            $stockCorde->setStockArticleSn($lot);
            $stockCorde->setDatedecreation($materiel->getDatedecreation());
            $stockCorde->setLongeur($materiel->getLongeur());
            $stockCorde->setQuantiter($materiel->getDensite());
            $this->entityManager->persist($stockCorde);
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
