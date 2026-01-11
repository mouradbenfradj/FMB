<?php

namespace App\Service\DesignPatterns\PatronsStructurels\Decorateur;

use App\Service\DesignPatterns\PatronsStructurels\Decorateur\Component;

/**
 * Concrete Components provide default implementations of the operations. There
 * might be several variations of these classes.
 */
class ConcreteComponent implements Component
{
    public function operation(): string
    {
        return "ConcreteComponent";
    }
}
