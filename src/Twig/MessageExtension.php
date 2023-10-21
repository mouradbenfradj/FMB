<?php

namespace App\Twig;

use App\Service\ParcService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MessageExtension extends AbstractExtension
{
    private $_parcService;
    public function __construct(ParcService $parcService)
    {
        $this->_parcService = $parcService;
    }
    public function getFunctions()
    {
        return [
            new TwigFunction('choixParc', [$this, 'choixParc']),
        ];
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
        $desiredParc = $this->_parcService->getOneParcCache($id);
        if ($desiredParc) {
            return $desiredParc->getAbrevParc();
        }
        return "Tous les parcs";
    }
}
