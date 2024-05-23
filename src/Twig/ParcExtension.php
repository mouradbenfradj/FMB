<?php

namespace App\Twig;

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
    public function choixParc(int $id)
    {
        $desiredParc = null;
        if ($id < 0) {
            switch ($id) {
                case -1:
                    return 'Historique des opérations';
                    break;

                default:
                    # code...
                    break;
            }
        }
        $desiredParc = $this->_parcCacheService->getOneParcCache($id);
        if ($desiredParc) {
            return $desiredParc->getAbrevParc();
        }
        return "Tous les parcs";
    }
}
