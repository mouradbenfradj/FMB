<?php

namespace App\Service\DesignPatterns\PatronsStructurels\Pont;

use App\Service\DesignPatterns\PatronsStructurels\Pont\Implementation;

/**
 * Each Concrete Implementation corresponds to a specific platform and
 * implements the Implementation interface using that platform's API.
 */
class ConcreteImplementationA implements Implementation
{
    public function operationImplementation(): string
    {
        return "ConcreteImplementationA: Here's the result on the platform A.\n";
    }
}
