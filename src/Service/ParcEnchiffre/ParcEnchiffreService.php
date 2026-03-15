<?php

namespace App\Service\ParcEnchiffre;

use App\Entity\Parc;
use App\Repository\CordeRepository;
use App\Repository\ParcRepository;
use App\Repository\StockCordeRepository;
use App\Repository\StockLanterneRepository;
use App\Repository\StockArticleRepository;
use App\Service\Cache\ParcCacheService;
use App\Service\Interface\ParcEnchiffreInterface;

class ParcEnchiffreService implements ParcEnchiffreInterface
{
    private ?Parc $parc = null;
    private StockCordeRepository $stockCordeRepository;
    private CordeRepository $cordeRepository;
    private StockLanterneRepository $stockLanterneRepository;
    private ParcRepository $parcRepository;
    private StockArticleRepository $stockArticleRepository;
    private ParcCacheService $parcCache;
    private array $parcs;

    public function __construct(
        ParcRepository $parcRepository,
        StockCordeRepository $stockCordeRepository,
        CordeRepository $cordeRepository,
        StockLanterneRepository $stockLanterneRepository,
        StockArticleRepository $stockArticleRepository,
        ParcCacheService $parcCache,
    ) {
        $this->stockCordeRepository = $stockCordeRepository;
        $this->cordeRepository = $cordeRepository;
        $this->stockLanterneRepository = $stockLanterneRepository;
        $this->stockArticleRepository = $stockArticleRepository;
        $this->parcCache = $parcCache;
        $this->parcRepository = $parcRepository;
        $this->parcs = $this->parcCache->getAllParcsWithRelations();
    }

    public function setParc(Parc $parc): void
    {
        $this->parc = $parc;
    }

    public function getData($parcId): array
    {

        return  [
            // Cordes stats (existing)
            'total_parcs' => $this->totalParcs($parcId),
            'total_filieres' => $this->totalFilieres($parcId),
            'cordes_preparees_a_sec' => $this->cordePrepareesASec($parcId),
            'cordes_a_leau' => $this->stockCordeRepository->countCordesALeau($parcId),
            'cordes_vides' => $this->cordeRepository->countCordesVides($parcId),
            'total_cordes' => $this->stockCordeRepository->countTotalCordes($parcId),
            'cordes_huitres_a_leau' => $this->stockCordeRepository->countCordesHuitresALeau($parcId),
            'cordes_moules_a_leau' => $this->stockCordeRepository->countCordesMoulesALeau($parcId),
            'chaussettes_cordes_a_leau' => $this->stockCordeRepository->countChaussettesCordesALeau($parcId),
            'cordes_moules_preparees' => $this->stockCordeRepository->countCordesMoulesPreparees($parcId),
            'cordes_huitres_preparees' => $this->stockCordeRepository->countCordesHuitresPreparees($parcId),

            // Lanternes stats (new)
            'total_lanternes' => $this->stockLanterneRepository->countTotalLanternes($parcId),
            'lanternes_a_leau' => $this->stockLanterneRepository->countLanternesALeau($parcId),
            'lanternes_vides' => $this->stockLanterneRepository->countLanternesVides($parcId),
            'lanternes_preparees' => $this->stockLanterneRepository->countLanternesPreparees($parcId),
            'chaussettes_lanternes' => 0, // À activer si nécessaire avec champ chaussement

            // Poches stats (new)
            'total_poches' => $this->stockArticleRepository->countTotalPoches($parcId),
            'poches_a_leau' => $this->stockArticleRepository->countPochesALeau($parcId),
            'poches_vides' => $this->stockArticleRepository->countPochesVides($parcId),
            'poches_preparees' => $this->stockArticleRepository->countPochesPreparees($parcId),
            'poches_assemblees' => $this->stockArticleRepository->countPochesAssemblees($parcId),
            'chaussettes_poches_a_leau' => $this->stockArticleRepository->countChaussettesPochesALeau($parcId),
            'cordes_assemblees_preparees' => $this->stockCordeRepository->countCordesAssembleesPreparees($parcId),
            'cordes_assemblees_a_leau' => $this->stockCordeRepository->countCordesAssembleesALeau($parcId),
            'poches_assemblees_a_leau' => $this->stockArticleRepository->countPochesAssembleesALeau($parcId),
        ];
    }



    public function totalParcs(int $parcId): int
    {
        if ($parcId)
            return 1;
        else
            return count($this->parcs);
    }
    public function totalFilieres(int $parcId): int
    {
        //            value: isAllParcs ? parc.total_filieres() : parc.getFilieres().count(),


        if ($parcId) {
            $parc = $this->parcCache->getParcFromCache($parcId, $this->parcs);
            return $parc->getFilieres()->count();
        } else {
            $totals = 0;
            foreach ($this->parcs as $parc) {
                $totals += $parc->getFilieres()->count();
            }
            return $totals;
        }
    }
    public function cordePrepareesASec(int $parcId): int
    {
        return $this->stockCordeRepository->countCordesPreparteesASec($parcId);
    }
    public function cordeslEau(int $parcId): int
    {
        return 0;
    }
    public function cordesVides(int $parcId): int
    {
        return 0;
    }
    public function totalCordes(int $parcId): int
    {
        return 0;
    }
}
