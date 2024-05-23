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
    public function aEau(?int $parcId = 0, ?int $article = null): int
    {
        return $this->statistiqueInterface->aEau($parcId, $article);
    }
}