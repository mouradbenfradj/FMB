<?php

namespace App\Service\DesignPatterns;

use App\Service\DesignPatterns\PatronsDeCreation\PatronsDeCreationService;
use App\Service\DesignPatterns\PatronsStructurels\PatronsStructurelsService;
use App\Service\DesignPatterns\PatronsComportementaux\PatronsComportementauxService;

class DesignPatternsService
{
    private PatronsDeCreationService $patronsDeCreationService;
    private  PatronsComportementauxService $patronsComportementauxService;
    private  PatronsStructurelsService $patronsStructurelsService;

    public function __construct(
        PatronsDeCreationService $patronsDeCreationService,
        PatronsComportementauxService $patronsComportementauxService,
        PatronsStructurelsService $patronsStructurelsService,
    ) {
        $this->patronsDeCreationService = $patronsDeCreationService;
        $this->patronsComportementauxService = $patronsComportementauxService;
        $this->patronsStructurelsService = $patronsStructurelsService;
    }


    public function usePatronsDeCreation()
    {
        return $this->patronsDeCreationService;
    }

    public function usePatronsComportementauxService()
    {
        return $this->patronsComportementauxService;
    }

    public function usePatronsStructurelsService()
    {
        return $this->patronsStructurelsService;
    }
}
