<?php

namespace App\Service;

use App\Entity\Parc;

class ParcService
{
    private Parc $parc;
    public function __construct(Parc $parc)
    {
        $this->parc = $parc;
    }
}
