<?php

namespace App\Service;

use App\Entity\Asc\Parc;
use App\Interfaces\StatistiqueInterface;

class StatistiqueService
{

    private $statistiqueInterface;

    public function __construct() {}

    public function setConteneur(StatistiqueInterface $statistiqueInterface)
    {
        $this->statistiqueInterface = $statistiqueInterface;
    }

    public function total(Parc $parc = null): int
    {
        return $this->statistiqueInterface->total($parc);
    }

    public function aEau(Parc $parc = null, ?int $article = null): int
    {
        return $this->statistiqueInterface->aEau($parc, $article);
    }
}
