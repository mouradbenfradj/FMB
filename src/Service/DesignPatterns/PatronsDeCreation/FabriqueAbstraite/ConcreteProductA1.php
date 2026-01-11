<?php

namespace App\Service\DesignPatterns\PatronsDeCreation\FabriqueAbstraite;

use App\Service\DesignPatterns\PatronsDeCreation\FabriqueAbstraite\AbstractProductA;

/**
 * Concrete Products are created by corresponding Concrete Factories.
 */
class ConcreteProductA1 implements AbstractProductA
{
    public function usefulFunctionA(): string
    {
        return "The result of the product A1.";
    }
}
