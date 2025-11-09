<?php
// src/Service/ParcCacheService.php

namespace App\Service;

use App\Repository\ParcRepository;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class ParcCacheService
{
    private const CACHE_KEY_ALL_PARCS = 'parcs_data_v3';
    private const CACHE_DURATION = 7200; // 2 heures

    public function __construct(
        private ParcRepository $parcRepository,
        private CacheInterface $cache
    ) {}

    public function getAllParcsWithRelations(): array
    {
        return $this->cache->get(self::CACHE_KEY_ALL_PARCS, function (ItemInterface $item) {
            $item->expiresAfter(self::CACHE_DURATION);

            return $this->parcRepository->createQueryBuilder('p')
                ->select('p', 'f', 'c', 's', 'l')
                ->leftJoin('p.filieres', 'f')
                ->leftJoin('p.cordes', 'c')
                ->leftJoin('p.stocks', 's')
                ->leftJoin('p.lanternes', 'l')
                ->getQuery()
                ->getResult();
        });
    }

    public function getParcFromCache(int $id, array $allParcs): ?object
    {
        foreach ($allParcs as $parc) {
            if ($parc->getId() === $id) {
                return $parc;
            }
        }
        return null;
    }

    public function refreshCache(): void
    {
        $this->cache->delete(self::CACHE_KEY_ALL_PARCS);
    }
}
