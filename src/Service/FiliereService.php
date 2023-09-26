<?php

namespace App\Service;

use App\Entity\Asc\Filiere;
use App\Repository\Asc\FiliereRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Contracts\Cache\CacheInterface;

class FiliereService
{
    private $cache;
    private $parcService;
    private $filiereRepository;

    public function __construct(
        ParcService $parcService,
        FiliereRepository $filiereRepository,
        CacheInterface $cache
    ) {
        $this->cache = $cache;
        $this->parcService = $parcService;
        $this->filiereRepository = $filiereRepository;
    }
    /**
     * @return Filiere[] Tableau des objets Parc
     */
    public function getFilieres(int $id)
    {
        return $this->filiereRepository->findByParc($id);
    }
}
