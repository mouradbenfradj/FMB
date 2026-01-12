<?php

namespace App\Twig;

use Twig\TwigFunction;
use App\Entity\Filiere;
use App\Entity\Segment;
use Twig\Extension\AbstractExtension;
use App\Service\EtatActuelProd\EtatActuelProdService;

class EtatActuelProdExtension extends AbstractExtension
{
    private EtatActuelProdService $etatActuelProdService;

    public function __construct(EtatActuelProdService $etatActuelProdService)
    {
        $this->etatActuelProdService = $etatActuelProdService;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('etat_actuel_prod', [$this, 'getEtatActuelProd']),
            new TwigFunction('etat_actuel_prod_segment', [$this, 'getEtatActuelProdSegment']),
        ];
    }

    public function getEtatActuelProd(Filiere $filiere): array
    {
        $stats = $this->etatActuelProdService->getFiliereArrayStat($filiere);

        return [
            'ref' => $stats[0],
            'remplissage' => $stats[1],
            'flottabiliter' => $stats[2],
            'taille' => $stats[3],
            'totalEmplacement' => $stats[4],
            'emplacementVide' => $stats[5],
            'emplacementRemplit' => $stats[6],
            'totalCorde' => $stats[7],
            'totalCordeHuitre' => $stats[8],
            'totalCordeMoule' => $stats[9],
            'totalCordeLanterne' => $stats[10],
            'totalCordePoche' => $stats[11],
            'dateDeMAE' => $stats[12],
            'passageChaussette' => $stats[13],
            'poidCordes' => $stats[14],
            'volumesTotale' => $stats[15],
        ];
    }

    public function getEtatActuelProdSegment(Segment $segment): array
    {
        $stats = $this->etatActuelProdService->getSegmentArrayStat($segment);

        return [
            'ref' => $stats[0],
            'remplissage' => $stats[1],
            'flottabiliter' => $stats[2],
            'taille' => $stats[3],
            'totalEmplacement' => $stats[4],
            'emplacementVide' => $stats[5],
            'emplacementRemplit' => $stats[6],
            'totalCorde' => $stats[7],
            'totalCordeHuitre' => $stats[8],
            'totalCordeMoule' => $stats[9],
            'totalCordeLanterne' => $stats[10],
            'totalCordePoche' => $stats[11],
            'dateDeMAE' => $stats[12],
            'passageChaussette' => $stats[13],
            'poidCordes' => $stats[14],
            'volumesTotale' => $stats[15],
        ];
    }
}
