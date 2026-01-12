<?php

namespace App\Service\DesignPatterns\PatronsStructurels\Pont;

use App\Service\DesignPatterns\PatronsStructurels\Pont\Abstraction;

/**
 * You can extend the Abstraction without changing the Implementation classes.
 */
class ExtendedAbstraction extends Abstraction
{
    public function operation(): string
    {
        return "ExtendedAbstraction: Extended operation with:\n" .
            $this->implementation->operationImplementation();
    }
}
