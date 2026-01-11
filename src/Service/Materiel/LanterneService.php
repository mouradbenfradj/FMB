<?php

namespace App\Service\Materiel;

use App\Entity\StockLanterne;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\Interface\TravailleAFaireInterface;

class LanterneService implements TravailleAFaireInterface
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function preparation(object $materiel)
    {
        dd('preparation');
        for ($i = 0; $i < $materiel->getNombre(); $i++) {
            $stockLanterne = new StockLanterne();
            $stockLanterne->setLanterne($materielmodel->getLanterne());
            $stockLanterne->setStockArticleSn($materielmodel->getLot());
            $stockLanterne->setDatedecreation($materielmodel->getDatedecreation());
            //$stockLanterne->setQuantiter($materielmodel->getDensite());
            $this->entityManager->persist($stockLanterne);
            //$materielmodel->getLanterne()->setQuantiter($materielmodel->getLanterne()->getQuantiter() - $materiel->getNombre());
            $materiel->getLanterne()->setNbrEnStock($materielmodel->getLanterne()->getNbrEnStock() - $materiel->getNombre());
            $this->entityManager->persist($materielmodel->getLanterne());
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
