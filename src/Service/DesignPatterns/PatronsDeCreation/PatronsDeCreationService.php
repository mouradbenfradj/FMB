<?php

namespace App\Service\DesignPatterns\PatronsDeCreation;

use App\Service\DesignPatterns\PatronsDeCreation\Prototype\PPrototype;
use App\Service\DesignPatterns\PatronsDeCreation\Monteur\MonteurService;
use App\Service\DesignPatterns\PatronsDeCreation\Fabrique\FabriqueService;
use App\Service\DesignPatterns\PatronsDeCreation\Singleton\SingletonService;
use App\Service\DesignPatterns\PatronsDeCreation\FabriqueAbstraite\FabriqueAbstraite;

class PatronsDeCreationService
{

    private FabriqueAbstraite $fabriqueAbstraite;
    private MonteurService $monteur;
    private PPrototype $prototype;
    private SingletonService $singletonService;
    private FabriqueService $fabriqueService;

    public function __construct(
        FabriqueService $fabriqueService,
        FabriqueAbstraite $fabriqueAbstraite,
        MonteurService $monteur,
        PPrototype $prototype,
        SingletonService $singletonService
    ) {
        $this->fabriqueService = $fabriqueService;
        $this->fabriqueAbstraite = $fabriqueAbstraite;
        $this->monteur = $monteur;
        $this->prototype = $prototype;
        $this->singletonService = $singletonService;
    }

    public function usePatterneFabrique()
    {
        $this->fabriqueService->affiche();
    }

    public function usePatterneFabriqueAbstraite()
    {
        $this->fabriqueAbstraite->affiche();
    }

    public function usePatterneMonteur()
    {
        $this->monteur->affiche();
    }

    public function usePatternePrototype()
    {
        $this->prototype->run();
    }
    public function usePatterneSingleton()
    {
        $this->singletonService->run();
    }
}
