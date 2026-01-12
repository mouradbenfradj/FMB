<?php

namespace App\Service\ParcEnchiffre;

use App\Entity\Parc;
use App\Repository\CordeRepository;
use App\Repository\StockCordeRepository;
use App\Service\Interface\ParcEnchiffreInterface;

class ParcEnchiffreService implements ParcEnchiffreInterface
{
    private Parc $parc;
    private StockCordeRepository $stockCordeRepository;
    private CordeRepository $cordeRepository;
    public function __construct(StockCordeRepository $stockCordeRepository, CordeRepository $cordeRepository)
    {
        $this->stockCordeRepository = $stockCordeRepository;
        $this->cordeRepository = $cordeRepository;
    }
    public function setParc(Parc $parc): void
    {
        $this->parc = $parc;
    }
    public function getData($parcId): array
    {
        return  [
            'cordes_preparees_a_sec' => $this->stockCordeRepository->countCordesPreparteesASec($parcId),
            'cordes_a_leau' => $this->stockCordeRepository->countCordesALeau($parcId),
            'cordes_vides' => $this->cordeRepository->countCordesVides($parcId),
            'total_cordes' => $this->stockCordeRepository->countTotalCordes($parcId),
            'cordes_huitres_a_leau' => $this->stockCordeRepository->countCordesHuitresALeau($parcId),
            'cordes_moules_a_leau' => $this->stockCordeRepository->countCordesMoulesALeau($parcId),
            'chaussettes_cordes_a_leau' => $this->stockCordeRepository->countChaussettesCordesALeau($parcId),
            'cordes_moules_preparees' => $this->stockCordeRepository->countCordesMoulesPreparees($parcId),
            'cordes_huitres_preparees' => $this->stockCordeRepository->countCordesHuitresPreparees($parcId),
        ];
    }



    public function totalParcs(Parc $parc): int
    {
        return 0;
    }
    public function totalFilieres(Parc $parc): int
    {
        return 0;
    }
    public function cordePrepareesASec(Parc $parc): int
    {
        return 0;
    }
    public function cordeslEau(Parc $parc): int
    {
        return 0;
    }
    public function cordesVides(Parc $parc): int
    {
        return 0;
    }
    public function totalCordes(Parc $parc): int
    {
        return 0;
    }
}
