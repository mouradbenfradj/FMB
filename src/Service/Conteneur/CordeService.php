<?php

namespace App\Service\Conteneur;

use App\Interfaces\StatistiqueInterface;
use App\Repository\Asc\Conteneur\CordeRepository;
use App\Repository\Asc\Stock\StockCordeRepository;
use App\Service\Cache\ParcCacheService;

class CordeService implements StatistiqueInterface
{

    private $_cache;
    private $_cordeRepository;
    private $_stockCordeRepository;
    private $_parcCacheService;

    public function __construct(
        CordeRepository $cordeRepository,
        ParcCacheService $parcCacheService,
        StockCordeRepository $stockCordeRepository
    ) {
        $this->_cordeRepository = $cordeRepository;
        $this->_stockCordeRepository = $stockCordeRepository;
        $this->_parcCacheService = $parcCacheService;
    }

    public function total(?int $parcId): int
    {

        $somme = 0;
        if ($parcId == 0)
            foreach ($this->_parcCacheService->findAllFromParcCache() as  $parc) {
                $cordes = $this->_cordeRepository->findByParc($parc->getId());
                $somme += array_sum(array_map(fn ($corde): int => $corde->getQuantiter(), $cordes));
            }
        else {
            $cordes = $this->_cordeRepository->findByParc($parcId);
            $somme += array_sum(array_map(fn ($corde): int => $corde->getQuantiter(), $cordes));
        }
        return $somme;
    }
    public function aEau(?int $parcId = 0, ?int $article): int
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
