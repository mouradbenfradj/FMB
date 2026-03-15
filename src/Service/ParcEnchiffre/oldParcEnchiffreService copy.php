<?php

namespace App\Service\ParcEnchiffre;

use App\Entity\Parc;
use App\Repository\ParcRepository;
use App\Service\Interface\ParcEnchiffreInterface;

class OldParcEnchiffreService implements ParcEnchiffreInterface
{
    private ?Parc $parc = null;
    private ParcRepository $parcRepository;

    public function __construct(ParcRepository $parcRepository)
    {
        $this->parcRepository = $parcRepository;
    }

    public function setParc(Parc $parc): void
    {
        $this->parc = $parc;
    }

    public function getData($parcId): array
    {
        $result = $this->parcRepository->getParcStats($parcId);

        return [
            'cordes_preparees_a_sec' => (int) ($result['cordes_preparees_a_sec'] ?? 0),
            'cordes_a_leau' => (int) ($result['cordes_a_leau'] ?? 0),
            'cordes_vides' => (int) ($result['cordes_vides'] ?? 0),
            'total_cordes' => (int) ($result['total_cordes'] ?? 0),
            'cordes_huitres_a_leau' => (int) ($result['cordes_huitres_a_leau'] ?? 0),
            'cordes_moules_a_leau' => (int) ($result['cordes_moules_a_leau'] ?? 0),
            'chaussettes_cordes_a_leau' => (int) ($result['chaussettes_cordes_a_leau'] ?? 0),
            'cordes_moules_preparees' => (int) ($result['cordes_moules_preparees'] ?? 0),
            'cordes_huitres_preparees' => (int) ($result['cordes_huitres_preparees'] ?? 0),
            'cordes_assemblees_preparees' => (int) ($result['cordes_assemblees_preparees'] ?? 0),
            'cordes_assemblees_a_leau' => (int) ($result['cordes_assemblees_a_leau'] ?? 0),

            'total_lanternes' => (int) ($result['total_lanternes'] ?? 0),
            'lanternes_a_leau' => (int) ($result['lanternes_a_leau'] ?? 0),
            'lanternes_vides' => (int) ($result['lanternes_vides'] ?? 0),
            'lanternes_preparees' => (int) ($result['lanternes_preparees'] ?? 0),
            'chaussettes_lanternes' => 0,

            'total_poches' => (int) ($result['total_poches'] ?? 0),
            'poches_a_leau' => (int) ($result['poches_a_leau'] ?? 0),
            'poches_vides' => (int) ($result['poches_vides'] ?? 0),
            'poches_preparees' => (int) ($result['poches_preparees'] ?? 0),
            'poches_assemblees' => (int) ($result['poches_assemblees'] ?? 0),
            'poches_assemblees_a_leau' => (int) ($result['poches_assemblees_a_leau'] ?? 0),
            'chaussettes_poches_a_leau' => (int) ($result['chaussettes_poches_a_leau'] ?? 0),
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
