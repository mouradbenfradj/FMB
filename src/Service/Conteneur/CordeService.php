<?php

namespace App\Service\Conteneur;

use App\Entity\Asc\Parc;
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

    public function total(Parc $parc = null): int
    {

        $somme = 0;
        if (!$parc)
            foreach ($this->_parcCacheService->findAllFromParcCache() as  $parc) {
                $cordes = $this->_cordeRepository->findByParc($parc->getId());
                $somme += array_sum(array_map(fn($corde): int => $corde->getQuantiter(), $cordes));
            }
        else {
            $cordes = $parc->getCordes()->toArray();
            $somme += array_sum(array_map(fn($corde): int => $corde->getQuantiter(), $cordes));
        }
        return $somme;
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
