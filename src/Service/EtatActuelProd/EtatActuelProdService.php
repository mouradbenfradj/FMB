<?php

namespace App\Service\EtatActuelProd;

use App\Entity\Parc;
use App\Entity\Filiere;
use App\Entity\Segment;
use App\Service\FiliereService;
use App\Service\SegmentService;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\CacheInterface;
use App\Service\Interface\ParcEnchiffreInterface;

class EtatActuelProdService
{
    private FiliereService $filiereService;
    private SegmentService $segmentService;
    private CacheInterface $cache;
    public function __construct(FiliereService $filiereService, SegmentService $segmentService, CacheInterface $cache)
    {
        $this->filiereService = $filiereService;
        $this->segmentService = $segmentService;
        $this->cache = $cache;
    }

    public function getFiliereArrayStat(Filiere $filiere): array
    {
        $cacheKey = 'filiere_etat_' . $filiere->getId();

        return $this->cache->get($cacheKey, function (ItemInterface $item) use ($filiere) {
            $item->expiresAfter(300); // Cache for 5 minutes

            $this->filiereService->setFiliereToService($filiere);
            return [
                $this->filiereService->ref(),
                $this->filiereService->remplissage(),
                $this->filiereService->flottabiliter(),
                $this->filiereService->taille(),
                $this->filiereService->totalEmplacement(),
                $this->filiereService->emplacementVide(),
                $this->filiereService->emplacementRemplit(),
                $this->filiereService->totalCorde(),
                $this->filiereService->totalCordeHuitre(),
                $this->filiereService->totalCordeMoule(),
                $this->filiereService->totalCordeLanterne(),
                $this->filiereService->totalCordePoche(),
                $this->filiereService->dateDeMAE(),
                $this->filiereService->passageChaussette(),
                $this->filiereService->poidCordes(),
                $this->filiereService->volumesTotale()
            ];
        });
    }

    public function getSegmentArrayStat(Segment $segment): array
    {
        $cacheKey = 'segment_etat_' . $segment->getId();

        return $this->cache->get($cacheKey, function (ItemInterface $item) use ($segment) {
            $item->expiresAfter(300); // Cache for 5 minutes

            $this->segmentService->setSegmentToService($segment);
            return [
                $this->segmentService->ref(),
                $this->segmentService->remplissage(),
                $this->segmentService->flottabiliter(),
                $this->segmentService->taille(),
                $this->segmentService->totalEmplacement(),
                $this->segmentService->emplacementVide(),
                $this->segmentService->emplacementRemplit(),
                $this->segmentService->totalCorde(),
                $this->segmentService->totalCordeHuitre(),
                $this->segmentService->totalCordeMoule(),
                $this->segmentService->totalCordeLanterne(),
                $this->segmentService->totalCordePoche(),
                $this->segmentService->dateDeMAE(),
                $this->segmentService->passageChaussette(),
                $this->segmentService->poidCordes(),
                $this->segmentService->volumesTotale()
            ];
        });
    }
}
