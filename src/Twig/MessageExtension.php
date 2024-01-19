<?php

namespace App\Twig;

use App\Service\Cache\ParcCacheService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MessageExtension extends AbstractExtension
{
    private $_parcCacheService;
    public function __construct(ParcCacheService $parcCacheService)
    {
        $this->_parcCacheService = $parcCacheService;
    }
    public function getFunctions()
    {
        return [];
    }
}
