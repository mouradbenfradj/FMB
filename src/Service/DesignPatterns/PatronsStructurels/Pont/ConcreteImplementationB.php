<?php

namespace App\Service\DesignPatterns\PatronsStructurels\Pont;

use App\Service\DesignPatterns\PatronsStructurels\Pont\Implementation;

class ConcreteImplementationB implements Implementation
{
    public function operationImplementation(): string
    {
        return "ConcreteImplementationB: Here's the result on the platform B.\n";
    }
}
