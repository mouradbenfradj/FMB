<?php

namespace App\Service\Materiel;

use Doctrine\ORM\EntityManagerInterface;
use App\Service\Materiel\LanterneService;
use App\Service\Materiel\MaterielService;

use App\Service\Interface\TravailleAFaireInterface;

class TravailleLanterneService extends MaterielService
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getMateriel(): TravailleAFaireInterface
    {
        return new LanterneService($this->entityManager);
    }
}
