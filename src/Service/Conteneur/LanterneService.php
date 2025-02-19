<?php

namespace App\Service\Conteneur;

use App\Entity\Asc\Parc;
use App\Interfaces\StatistiqueInterface;

/**
 * LanterneService
 */
class LanterneService implements StatistiqueInterface
{

    public function total(Parc $parc = null): int
    {

        return 0;
    }
    public function aEau(Parc $parc = null, ?int $article): int
    {
        return 0;
    }
    public function vides(): int
    {
        return 0;
    }
    public function preparees($article): array
    {
        return [];
    }
    public function assembleesPreparees($article): array
    {
        return [];
    }
}
