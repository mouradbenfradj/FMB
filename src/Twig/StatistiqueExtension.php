<?php

namespace App\Twig;

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
        ];
    }

    public function totalEmplacements(int $parcId, int $idFiliere)
    {
        $somme = 0;
        /* $filieres = $this->_filiereService->getFilieres($parcId);
        foreach ($filieres as $filiere) {
            if ($filiere->getId() === $idFiliere) {
                foreach ($filiere->getSegments() as $segment) {
                    foreach ($segment->getFlotteurs() as $flotteur) {
                        $somme += count($flotteur->getEmplacements());
                    }
                }
            }
        } */
        return $somme;
    }
    public function total(int $parcId = 0, string $conteneur, ?string $article = null, bool $inWater = false)
    {
        $somme = 0;
        switch ($conteneur) {
            case 'parc':
                $somme = $this->_parcService->countParcCache($parcId);
                break;
            case 'filiere':
                if ($parcId == 0)
                    foreach ($this->_parcService->findAllFromParcCache() as  $parc)
                        $somme += count($this->_filiereService->getFilieres($parc->getId()));
                else
                    $somme += count($this->_filiereService->getFilieres($parcId));

                break;
            default:
                $somme = 0;
                break;
        }

        return $somme;
    }
}
