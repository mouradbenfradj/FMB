<?php
// src/Service/ParcCacheService.php

namespace App\Service\Cache;

use App\Service\MouleCalculator;
use App\Repository\ParcRepository;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\CacheInterface;

class ParcCacheService
{
    // Incrémente la version de la clé quand la structure des données change
    private const CACHE_KEY_ALL_PARCS = 'parcs_data_v4';
    private const CACHE_DURATION = 7200; // 2 heures

    public function __construct(
        private ParcRepository $parcRepository,
        private CacheInterface $cache,
        private MouleCalculator $mouleCalculator
    ) {}

    public function getAllParcsWithRelations(): array
    {
        $result = $this->cache->get(self::CACHE_KEY_ALL_PARCS, function (ItemInterface $item) {
            $item->expiresAfter(self::CACHE_DURATION);

            $result = $this->parcRepository->createQueryBuilder('p')
                ->select('p', 'f', 'seg', 'fs', 'e', 'sc', 'sl', 'c', 's', 'l')
                // Parc → Filières
                ->leftJoin('p.filieres', 'f')
                // Filière → Segments
                ->leftJoin('f.segments', 'seg')
                // Segment → FlotteurSegments
                ->leftJoin('seg.flotteurSegments', 'fs')
                // Segment → Emplacements
                ->leftJoin('seg.emplacements', 'e')
                // Emplacement → Stocks
                ->leftJoin('e.stockCordes', 'sc')
                ->leftJoin('e.stockLanternes', 'sl')
                // Autres relations directes du parc
                ->leftJoin('p.cordes', 'c')
                ->leftJoin('p.stocks', 's')
                ->leftJoin('p.lanternes', 'l')
                ->getQuery()
                ->getResult();

            $this->injectMouleCalculator($result);
            return $result;
        });

        // Always inject after retrieving from cache, since serialization loses the injected service
        $this->injectMouleCalculator($result);
        return $result;
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

    private function injectMouleCalculator(array $parcs): void
    {
        foreach ($parcs as $parc) {
            foreach ($parc->getFilieres() as $filiere) {
                foreach ($filiere->getSegments() as $segment) {
                    foreach ($segment->getEmplacements() as $emplacement) {
                        foreach ($emplacement->getStockCordes() as $stockCorde) {
                            $this->injectIntoStockCorde($stockCorde);
                        }
                    }
                }
            }
        }
    }

    private function injectIntoStockCorde($stockCorde): void
    {
        $reflection = new \ReflectionClass($stockCorde);
        if ($reflection->hasProperty('mouleCalculator')) {
            $property = $reflection->getProperty('mouleCalculator');
            $property->setAccessible(true);
            $property->setValue($stockCorde, $this->mouleCalculator);
        }
    }
}
