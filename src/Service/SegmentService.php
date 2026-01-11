<?php

namespace App\Service;

use App\Entity\Segment;
use App\Service\EmplacementService;
use App\Service\Interface\EtatActualProdInterface;

class SegmentService implements EtatActualProdInterface
{
    private Segment $segment;
    private EmplacementService $emplacementService;
    private int $nombreDePlace = 0;
    private int $nombreDePlaceRemplit = 0;
    public function __construct(EmplacementService $emplacementService)
    {
        $this->emplacementService = $emplacementService;
    }
    public function setSegmentToService(Segment $segment): void
    {
        $this->segment = $segment;
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
        return  $this->segment->getNomsegment();
    }


    public function getNombreEmplacementsRemplit(): int
    {
        foreach ($this->segment->getEmplacements() as $emplacement) {
            if (!$this->emplacementService->isEmpty($emplacement)) {
                $this->nombreDePlaceRemplit += 1;
            }
        }


        $somme = 0;
        foreach ($this->segments as $segment) {
            $somme += $segment->getTotaleCordes();
        }
        return $somme;
    }
    public function remplissage(): float
    {
        $remplit = $this->segment->get();
        $totale =  $this->segment->getNombreEmplacements();

        dump($totale, $remplit);
        return ($totale - $remplit) / 100;
    }
    public function flottabiliter(): float
    {

        $flottabiliter = 0;
        dump($this->segment->getFlottabiliter());
        return $this->segment->getFlottabiliter();
    }
    public function taille(): float
    {
        $totale = 0;
        foreach ($this->segment->getSegments() as $segment) {
            $totale += $segment->getLongeur();
        }
        dump($totale);
        return $totale;
    }
    public function totalEmplacement(): int
    {
        return $this->nombreDePlace = $this->segment->getEmplacements()->count();
    }
    public function emplacementVide(): int
    {
        dump($this->segment->getNombreEmplacementsVide());

        return $this->segment->getNombreEmplacementsVide();
    }
    public function emplacementRemplit(): int
    {
        dump($this->segment->getNombreEmplacementsRemplit());

        return $this->segment->getNombreEmplacementsRemplit();
    }
    public function totalCorde(): int
    {

        dump($this->segment->getTotaleCordes());

        return $this->segment->getTotaleCordes();
    }
    public function totalCordeHuitre(): int
    {
        dump($this->segment->getTotaleCordesHuitre());

        return $this->segment->getTotaleCordesHuitre();
    }
    public function totalCordeMoule(): int
    {

        dump($this->segment->getTotaleCordesMoule());

        return $this->segment->getTotaleCordesMoule();
    }
    public function totalCordeLanterne(): int
    {
        dump($this->segment->getTotaleLanterne());

        return $this->segment->getTotaleLanterne();
    }
    public function totalCordePoche(): int
    {

        dump($this->segment->getTotalePoche());

        return $this->segment->getTotalePoche();
    }
    public function dateDeMAE() {}
    public function passageChaussette(): int
    {
        return 0;
    }
    public function segments() {}
}
