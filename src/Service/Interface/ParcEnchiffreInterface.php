<?php

namespace App\Service\Interface;

use App\Entity\Parc;

interface ParcEnchiffreInterface
{
    public function getData(int $parcId): array;
    public function totalParcs(int $parcId): int;
    public function totalFilieres(int $parcId): int;
    public function cordePrepareesASec(int $parcId): int;
    public function cordeslEau(int $parcId): int;
    public function cordesVides(int $parcId): int;
    public function totalCordes(int $parcId): int;
}
