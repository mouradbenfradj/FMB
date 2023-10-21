<?php

namespace App\Service;

use App\Interfaces\StatistiqueInterface;

class StatistiqueService
{

    private $statistiqueInterface;

    public function __construct()
    {
    }

    public function setConteneur(StatistiqueInterface $statistiqueInterface)
    {
        $this->statistiqueInterface = $statistiqueInterface;
    }

    public function total(?int $parcId = 0): int
    {
        return $this->statistiqueInterface->total($parcId);
    }
}
