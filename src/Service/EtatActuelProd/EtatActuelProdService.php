<?php

namespace App\Service\EtatActuelProd;

use App\Entity\Parc;
use App\Service\Interface\ParcEnchiffreInterface;

class EtatActuelProdService implements ParcEnchiffreInterface
{
    public function totalParcs(Parc $parc): int
    {
        return 0;
    }
    public function totalFilieres(Parc $parc): int
    {
        return 0;
    }
    public function cordePrepareesASec(Parc $parc): int
    {
        return 0;
    }
    public function cordeslEau(Parc $parc): int
    {
        return 0;
    }
    public function cordesVides(Parc $parc): int
    {
        return 0;
    }
    public function totalCordes(Parc $parc): int
    {
        return 0;
    }
}
