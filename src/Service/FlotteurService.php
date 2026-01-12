<?php

namespace App\Service;

use App\Entity\Parc;
use App\Entity\Flotteur;

class FlotteurService
{
    private Flotteur $flotteur;
    public function __construct(Flotteur $flotteur)
    {
        $this->flotteur = $flotteur;
    }
}
