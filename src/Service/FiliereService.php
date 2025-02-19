<?php

namespace App\Service;

use App\Entity\Asc\FiliereComposite\Filiere;
use App\Entity\Asc\Parc;
use App\Interfaces\StatistiqueInterface;
use App\Repository\Asc\FiliereComposite\FiliereRepository;
use App\Service\Cache\ParcCacheService;
use Doctrine\Common\Collections\Collection;
use Symfony\Contracts\Cache\CacheInterface;

class FiliereService implements StatistiqueInterface
{
    private $cache;
    private $_parcCacheService;
    private $_filiereRepository;

    public function __construct(
        ParcCacheService $parcCacheService,
        FiliereRepository $filiereRepository,
        CacheInterface $cache
    ) {
        $this->cache = $cache;
        $this->_parcCacheService = $parcCacheService;
        $this->_filiereRepository = $filiereRepository;
    }
    /**
     * @return Filiere[] Tableau des objets Parc
     */
    public function getFilieres(int $id)
    {
        return $this->_filiereRepository->findByParcId($id);
    }


    public function total(Parc $parc = null): int
    {

        $somme = 0;
        if (!$parc)
            foreach ($this->_parcCacheService->findAllFromParcCache() as  $parc)
                $somme += $parc->getTotaleFilieres();
        else
            $somme += $parc->getTotaleFilieres();
        return  $somme;
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
