<?php

namespace App\Twig;

use App\Entity\Asc\Parc;
use App\Service\Cache\ParcCacheService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ParcExtension extends AbstractExtension
{
    private $_parcCacheService;
    public function __construct(ParcCacheService $parcCacheService)
    {
        $this->_parcCacheService = $parcCacheService;
    }
    public function getFunctions()
    {
        return [
            new TwigFunction('choixParc', [$this, 'choixParc']),
            new TwigFunction('listParcs', [$this, 'listParcs']),
        ];
    }

    public function listParcs()
    {
        return $this->_parcCacheService->findAllFromParcCache();
    }
    public function choixParc(Parc $parc = null)
    {
        if (!$parc) {
            switch ($parc) {
                case -1:
                    return 'Historique des opérations';
                    break;

                default:
                    # code...
                    break;
            }
        }
        if ($parc) {
            return $parc->getAbrevParc();
        }
        return "Tous.les.parcs";
    }
}
