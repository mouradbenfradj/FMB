<?php

namespace App\Service\Conteneur;

use App\Interfaces\StatistiqueInterface;

/**
 * LanterneService
 */
class LanterneService implements StatistiqueInterface
{

    public function total(?int $parcId): int
    {
        return 0;
    }
    public function aEau(string $article): array
    {
        return [];
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
