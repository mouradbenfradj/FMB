<?php

namespace App\Service;

use App\Entity\Asc\FiliereComposite\Filiere;
use App\Interfaces\StatistiqueInterface;
use App\Repository\Asc\FiliereComposite\FiliereRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Contracts\Cache\CacheInterface;

class FiliereService implements StatistiqueInterface
{
    private $cache;
    private $_parcService;
    private $_filiereRepository;

    public function __construct(
        ParcService $parcService,
        FiliereRepository $filiereRepository,
        CacheInterface $cache
    ) {
        $this->cache = $cache;
        $this->_parcService = $parcService;
        $this->_filiereRepository = $filiereRepository;
    }
    /**
     * @return Filiere[] Tableau des objets Parc
     */
    public function getFilieres(int $id)
    {
        return $this->_filiereRepository->findByParcId($id);
    }


    public function total(?int $parcId): int
    {
        $somme = 0;
        if ($parcId == 0)
            foreach ($this->_parcService->findAllFromParcCache() as  $parc)
                $somme += count($this->getFilieres($parc->getId()));
        else
            $somme += count($this->getFilieres($parcId));
        return  $somme;
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
