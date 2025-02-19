<?php

namespace App\Service\Cache;

use App\Entity\Asc\Parc;
use Symfony\Contracts\Cache\CacheInterface;
use App\Interfaces\StatistiqueInterface;
use App\Service\ParcService;

class ParcCacheService implements StatistiqueInterface
{
    private $_cache;
    private $_parcService;
    public function __construct(CacheInterface $cache, ParcService $parcService)
    {
        $this->_cache = $cache;
        $this->_parcService = $parcService;
    }
    /**
     * @return Parc[] Tableau des objets Parc
     */
    public function findAllFromParcCache(): array
    {
        return $this->_cache->get('all_parc', function () {
            return $this->_parcService->findAllParc();
        });
    }

    public function getOneParcCache(int $id): ?Parc
    {
        $parcResult = null;
        foreach ($this->findAllFromParcCache() as  $parc) {
            if ($parc->getId() === $id) {
                $parcResult = $parc;
            }
        }
        return $parcResult;
    }

    public function countParcCache(int $id): int
    {
        $somme = 0;
        if ($id == 0)
            $somme = count($this->findAllFromParcCache());
        else
            $somme += 1;
        return $somme;
    }

    public function deleteParcCache(): void
    {
        $this->_cache->delete('all_parc');
    }

    public function total(Parc $parc = null): int
    {
        $somme = 0;
        if (!$parc)
            $somme = count($this->findAllFromParcCache());
        else
            $somme += 1;
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
