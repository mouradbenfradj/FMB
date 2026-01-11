<?php

namespace App\Service;

use App\Entity\Emplacement;

class EmplacementService
{
    private Emplacement $emplacement;
    public function isEmpty(Emplacement $emplacement): bool
    {
        $this->emplacement = $emplacement;
        return $this->emplacement->getStockCordes()->count() || $this->emplacement->getStockLanternes()->count();
    }
}
