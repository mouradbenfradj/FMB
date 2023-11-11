<?php

namespace App\Service\Conteneur;

use App\Interfaces\StatistiqueInterface;
use App\Repository\Asc\Conteneur\CordeRepository;
use App\Repository\Asc\Stock\StockCordeRepository;

class CordeService implements StatistiqueInterface
{

    private $_cache;
    private $_cordeRepository;
    private $_stockCordeRepository;

    public function __construct(
        CordeRepository $cordeRepository,
        StockCordeRepository $stockCordeRepository
    ) {
        $this->_cordeRepository = $cordeRepository;
        $this->stockCordeRepository = $stockCordeRepository;
    }

    public function total(?int $parcId): int
    {

        $somme = 0;
        if ($parcId == 0)
            $somme = count($this->_stockCordeRepository->findAll());
        else
            $somme = count($this->_stockCordeRepository->findBy([]));
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
