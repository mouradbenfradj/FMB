<?php

namespace App\Service\Materiel;

use App\Service\Materiel\CordeService;
use Doctrine\ORM\EntityManagerInterface;

use App\Service\Materiel\MaterielService;
use App\Service\Interface\TravailleAFaireInterface;


class TravailleCordeService extends MaterielService
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getMateriel(): TravailleAFaireInterface
    {
        return new CordeService($this->entityManager);
    }
}
