<?php

namespace App\Service;

use App\Entity\Asc\Parc;
use App\Repository\Asc\ParcRepository;
use Symfony\Contracts\Cache\CacheInterface;

class ParcService
{
    private $_cache;
    private $_parcRepository;

    public function __construct(
        ParcRepository $parcRepository,
        CacheInterface $cache
    ) {
        $this->_cache = $cache;
        $this->_parcRepository = $parcRepository;
    }

    /**
     * @return Parc[] Tableau des objets Parc
     */
    public function findAllFromParcCache(): array
    {
        return $this->_cache->get('all_parc', function () {
            return $this->_parcRepository->findAll();
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

    public function deleteParcCache(): array
    {
        $this->_cache->delete('all_parc');
    }
}
