<?php

namespace App\Service;

use App\Entity\Segment;
use App\Entity\FlotteurSegment;
use App\Service\EmplacementService;
use App\Service\Interface\EtatActualProdInterface;

class FlotteurSegmentService
{
    private ?FlotteurSegment $flotteurSegment = null;
    public function setFlotteurSegmentToService(FlotteurSegment $flotteurSegment): void
    {
        $this->flotteurSegment = $flotteurSegment;
    }
    public function getFlottabiliter(): float
    {
        $somme = 0;
        $nombre = $this->flotteurSegment->getNombre();

        for ($i = 0; $i < $nombre; $i++) {
            $flotteur = $this->flotteurSegment->getFlotteur();
            if ($flotteur === null) {
                throw new \Exception('Flotteur is null for FlotteurSegment ID: ' . $this->flotteurSegment->getId());
            }
            $kgf = $flotteur->getKgf();
            if ($kgf === null) {
                throw new \Exception('Kgf is null for Flotteur ID: ' . $flotteur->getId());
            }
            $somme += $kgf;
        }

        return $somme;
    }
}
