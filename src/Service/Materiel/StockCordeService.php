<?php

namespace App\Service\Materiel;

use App\Entity\StockCorde;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\Interface\TravailleAFaireInterface;

class StockCordeService /*  implements TravailleAFaireInterface */
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function preparation($materielChoisie, $lot, $datedecreation, $longeur, $densite)
    {
        $stockCorde = new StockCorde();
        $stockCorde->setCorde($materielChoisie);
        $stockCorde->setStockArticleSn($lot);
        $stockCorde->setDatedecreation($datedecreation);
        $stockCorde->setLongeur($longeur);
        $stockCorde->setQuantite($densite);
        $stockCorde->setPret(false);
        $this->entityManager->persist($stockCorde);
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
