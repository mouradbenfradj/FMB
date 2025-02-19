<?php

namespace App\Twig;

use App\Entity\Asc\Parc;
use App\Service\FiliereService;
use App\Service\ParcService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class StatistiqueExtension extends AbstractExtension
{
    /**
     * Service ParcService
     *
     * @var ParcService $parcService
     */
    private $_parcService;
    private $_filiereService;
    /**
     * Constructeur function
     *
     * @param ParcService $parcService
     */
    public function __construct(ParcService $parcService, FiliereService $filiereService)
    {
        $this->_parcService = $parcService;
        $this->_filiereService = $filiereService;
    }
    public function getFunctions(): array
    {
        return [
            new TwigFunction('total', [$this, 'total']),
            new TwigFunction('totalEmplacements', [$this, 'totalEmplacements']),
            new TwigFunction('totalEmplacementsVide', [$this, 'totalEmplacementsVide']),
        ];
    }

    public function totalEmplacements(Parc $parc, int $idFiliere)
    {
        $somme = 0;
        $filieres = $parc->getFilieres();
        foreach ($filieres as $filiere) {
            if ($filiere->getId() === $idFiliere) {
                foreach ($filiere->getSegments() as $segment) {
                    $somme += count($segment->getEmplacements());
                }
            }
        }
        return $somme;
    }

    public function totalEmplacementsVide(Parc $parc, int $idFiliere)
    {
        $somme = 0;
        $filieres = $parc->getFilieres();
        foreach ($filieres as $filiere) {
            if ($filiere->getId() === $idFiliere) {
                foreach ($filiere->getSegments() as $segment) {
                    foreach ($segment->getEmplacements() as $emplacement) {
                        if (!empty($emplacement->getStockCordes()))
                            $somme += 1;
                    }
                }
            }
        }
        return $somme;
    }
    public function total(Parc $parc = null, string $conteneur, ?string $article = null, bool $inWater = false)
    {
        $somme = 0;
        switch ($conteneur) {
            case 'parc':
                $somme = $this->_parcService->countParcCache($parc);
                break;
            case 'filiere':
                if (!$parc)
                    foreach ($this->_parcService->findAllFromParcCache() as  $parc)
                        $somme += count($this->_filiereService->getFilieres($parc->getId()));
                else
                    $somme += count($this->_filiereService->getFilieres($parc));

                break;
            default:
                $somme = 0;
                break;
        }

        return $somme;
    }
}
