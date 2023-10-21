<?php

namespace App\Service\Conteneur;

use App\Interfaces\StatistiqueInterface;
use App\Repository\Asc\Conteneur\CordeRepository;

class CordeService implements StatistiqueInterface
{

    private $_cache;
    private $_cordeRepository;

    public function __construct(
        CordeRepository $cordeRepository
    ) {
        $this->_cordeRepository = $cordeRepository;
    }

    public function total(?int $parcId): int
    {

        $somme = 0;
        if ($parcId == 0)
            $somme = count($this->_cordeRepository->findAll());
        else
            $somme += 1;
        return $somme;
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
