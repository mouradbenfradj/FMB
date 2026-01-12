<?php

namespace App\Service;

use App\Entity\Segment;
use App\Entity\FlotteurSegment;
use App\Service\EmplacementService;
use App\Service\Interface\EtatActualProdInterface;

class FlotteurSegmentService
{
    private FlotteurSegment $flotteurSegment;
    public function setFlotteurSegmentToService(FlotteurSegment $flotteurSegment): void
    {
        $this->flotteurSegment = $flotteurSegment;
    }
    public function getFlottabiliter(): float
    {
        $somme = 0;
        $nombre = $this->flotteurSegment->getNombre();

        for ($i = 0; $i < $nombre; $i++) {
            $somme += $this->flotteurSegment->getFlotteur()->getKgf();
        }

        return $somme;
    }
}
