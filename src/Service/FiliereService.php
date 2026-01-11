<?php

namespace App\Service;

use App\Entity\Filiere;
use App\Service\Interface\EtatActualProdInterface;

class FiliereService implements EtatActualProdInterface
{
    private Filiere $filiere;
    private int $nombreDePlace;
    private int $nombreDePlaceRemplit;

    public function __construct(Filiere $filiere)
    {
        $this->filiere = $filiere;
        $this->nombreDePlace = $segment->getEmplacements()->count();
        $this->nombreDePlaceRemplit = 0;
    }


    public function getColumn(): array
    {
        return  [
            $this->ref(),
            $this->remplissage(),
            $this->flottabiliter(),
            $this->taille(),
            $this->totalEmplacement(),
            $this->emplacementVide(),
            $this->emplacementRemplit(),
            $this->totalCorde(),
            $this->totalCordeHuitre(),
            $this->totalCordeMoule(),
            $this->totalCordeLanterne(),
            $this->totalCordePoche(),
            $this->dateDeMAE(),
            $this->passageChaussette(),
            $this->segments()
        ];
    }
    public function ref(): string
    {
        return  $this->filiere->getNomFiliere();
    }
    public function remplissage(): float
    {
        $remplit = $this->filiere->getNombreEmplacementsRemplit();
        $totale =  $this->filiere->getNombreEmplacements();

        dump($totale, $remplit);
        return ($totale - $remplit) / 100;
    }
    public function flottabiliter(): float
    {

        $flottabiliter = 0;
        dump($this->filiere->getFlottabiliter());
        return $this->filiere->getFlottabiliter();
    }
    public function taille(): float
    {
        $totale = 0;
        foreach ($this->filiere->getSegments() as $segment) {
            $totale += $segment->getLongeur();
        }
        dump($totale);
        return $totale;
    }
    public function totalEmplacement(): int
    {
        dump($this->filiere->getNombreEmplacements());

        return $this->filiere->getNombreEmplacements();
    }
    public function emplacementVide(): int
    {
        dump($this->filiere->getNombreEmplacementsVide());

        return $this->filiere->getNombreEmplacementsVide();
    }
    public function emplacementRemplit(): int
    {
        dump($this->filiere->getNombreEmplacementsRemplit());

        return $this->filiere->getNombreEmplacementsRemplit();
    }
    public function totalCorde(): int
    {

        dump($this->filiere->getTotaleCordes());

        return $this->filiere->getTotaleCordes();
    }
    public function totalCordeHuitre(): int
    {
        dump($this->filiere->getTotaleCordesHuitre());

        return $this->filiere->getTotaleCordesHuitre();
    }
    public function totalCordeMoule(): int
    {

        dump($this->filiere->getTotaleCordesMoule());

        return $this->filiere->getTotaleCordesMoule();
    }
    public function totalCordeLanterne(): int
    {
        dump($this->filiere->getTotaleLanterne());

        return $this->filiere->getTotaleLanterne();
    }
    public function totalCordePoche(): int
    {

        dump($this->filiere->getTotalePoche());

        return $this->filiere->getTotalePoche();
    }
    public function dateDeMAE() {}
    public function passageChaussette(): int
    {
        return 0;
    }
    public function segments() {}
}
