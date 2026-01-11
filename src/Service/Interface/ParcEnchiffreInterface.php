<?php

namespace App\Service\Interface;

use App\Entity\Parc;

interface ParcEnchiffreInterface
{
    public function totalParcs(Parc $parc): int;
    public function totalFilieres(Parc $parc): int;
    public function cordePrepareesASec(Parc $parc): int;
    public function cordeslEau(Parc $parc): int;
    public function cordesVides(Parc $parc): int;
    public function totalCordes(Parc $parc): int;
}
