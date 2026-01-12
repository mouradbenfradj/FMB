<?php

namespace App\Service\DesignPatterns\PatronsStructurels;

use App\Service\DesignPatterns\PatronsStructurels\Pont\PontService;
use App\Service\DesignPatterns\PatronsStructurels\Facade\FacadeService;
use App\Service\DesignPatterns\PatronsStructurels\Composite\CompositeService;
use App\Service\DesignPatterns\PatronsStructurels\Adaptateur\AdaptateurService;
use App\Service\DesignPatterns\PatronsStructurels\Decorateur\DecorateurService;
use App\Service\DesignPatterns\PatronsStructurels\PoidsMouche\PoidsMoucheService;
use App\Service\DesignPatterns\PatronsStructurels\Procuration\ProcurationService;

class PatronsStructurelsService
{

    private AdaptateurService $adaptateurService;
    private CompositeService $compositeService;
    private DecorateurService $decorateurService;
    private FacadeService $facadeService;
    private PoidsMoucheService $poidsMoucheService;
    private PontService $pontService;
    private ProcurationService $procurationService;

    public function __construct(
        AdaptateurService $adaptateurService,
        CompositeService $compositeService,
        DecorateurService $decorateurService,
        FacadeService $facadeService,
        PoidsMoucheService $poidsMoucheService,
        PontService $pontService,
        ProcurationService $procurationService
    ) {
        $this->adaptateurService = $adaptateurService;
        $this->compositeService = $compositeService;
        $this->decorateurService = $decorateurService;
        $this->facadeService = $facadeService;
        $this->poidsMoucheService = $poidsMoucheService;
        $this->pontService = $pontService;
        $this->procurationService = $procurationService;
    }

    public function useAdaptateurService()
    {
        $this->adaptateurService->runAdaptateurService();
    }
    public function useCompositeService()
    {
        $this->compositeService->runCompositeService();
    }
    public function useDecorateurService()
    {
        $this->decorateurService->runDecorateurService();
    }
    public function useFacadeService()
    {
        $this->facadeService->runFacadeService();
    }
    public function usePoidsMoucheService()
    {
        $this->poidsMoucheService->runPoidsMoucheService();
    }
    public function usePontService()
    {
        $this->pontService->runPontService();
    }
    public function useProcurationService()
    {
        $this->procurationService->runProcurationService();
    }
}
