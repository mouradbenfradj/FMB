<?php

namespace App\Service\DesignPatterns\PatronsComportementaux;

use App\Service\DesignPatterns\PatronsComportementaux\Etat\EtatService;
use App\Service\DesignPatterns\PatronsComportementaux\Memento\MementoService;
use App\Service\DesignPatterns\PatronsComportementaux\Commande\CommandeService;
use App\Service\DesignPatterns\PatronsComportementaux\Visiteur\VisiteurService;
use App\Service\DesignPatterns\PatronsComportementaux\Mediateur\MediateurService;
use App\Service\DesignPatterns\PatronsComportementaux\Strategie\StrategieService;
use App\Service\DesignPatterns\PatronsComportementaux\Iterateur\IterateurDevService;
use App\Service\DesignPatterns\PatronsComportementaux\Observateur\ObservateurService;
use App\Service\DesignPatterns\PatronsComportementaux\PatronDeMethode\PatronDeMethodeService;
use App\Service\DesignPatterns\PatronsComportementaux\ChaineDeResponsabilité\ChaineDeResponsabilitéService;

class PatronsComportementauxService
{
    private ChaineDeResponsabilitéService $chaineDeResponsabilitéService;
    private CommandeService $commandeService;
    private EtatService $etatService;
    private IterateurDevService $iterateurDevService;
    private MediateurService $mediateurService;
    private MementoService $mementoService;
    private ObservateurService $observateurService;
    private PatronDeMethodeService $patronDeMethodeService;
    private StrategieService $strategieService;
    private VisiteurService $visiteurService;

    public function __construct(
        ChaineDeResponsabilitéService $chaineDeResponsabilitéService,
        CommandeService $commandeService,
        EtatService $etatService,
        IterateurDevService $iterateurDevService,
        MediateurService $mediateurService,
        MementoService $mementoService,
        ObservateurService $observateurService,
        PatronDeMethodeService $patronDeMethodeService,
        StrategieService $strategieService,
        VisiteurService $visiteurService,
    ) {
        $this->chaineDeResponsabilitéService = $chaineDeResponsabilitéService;
        $this->commandeService = $commandeService;
        $this->etatService = $etatService;
        $this->iterateurDevService = $iterateurDevService;
        $this->mediateurService = $mediateurService;
        $this->mementoService = $mementoService;
        $this->observateurService = $observateurService;
        $this->patronDeMethodeService = $patronDeMethodeService;
        $this->strategieService = $strategieService;
        $this->visiteurService = $visiteurService;
    }

    public function usePatterneChaineDeResponsabilitéService()
    {
        $this->chaineDeResponsabilitéService->chaineDeResponsabilitéService();
    }

    public function usePatterneCommandeService()
    {
        $this->commandeService->run();
    }

    public function usePatterneEtatService()
    {
        $this->etatService->run();
    }

    public function usePatterneIterateurDevService()
    {
        $this->iterateurDevService->runIterateur();
    }

    public function usePatterneMediateurService()
    {
        $this->mediateurService->run();
    }
    public function usePatterneMementoService()
    {
        $this->mementoService->runMementoService();
    }
    public function usePatterneObservateurService()
    {
        $this->observateurService->runObservateurService();
    }
    public function usePatternePatronDeMethodeService()
    {
        $this->patronDeMethodeService->runPatronDeMethodeService();
    }
    public function usePatterneStrategieService()
    {
        $this->strategieService->runStrategieService();
    }
    public function usePatterneVisiteurService()
    {
        $this->visiteurService->runVisiteurService();
    }
}
