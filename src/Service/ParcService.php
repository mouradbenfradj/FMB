<?php

namespace App\Service;

use App\Entity\Asc\Parc;
use App\Repository\Asc\ParcRepository;

class ParcService
{
    private $_parcRepository;

    public function __construct(ParcRepository $parcRepository)
    {
        $this->_parcRepository = $parcRepository;
    }

    /**
     * @return Parc[] Tableau des objets Parc
     */
    public function findAllParc(): array
    {
        return $this->_parcRepository->findAll();
    }
}
