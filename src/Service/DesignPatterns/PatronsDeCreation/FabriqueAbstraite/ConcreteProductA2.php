<?php

namespace App\Service\DesignPatterns\PatronsDeCreation\FabriqueAbstraite;

use App\Service\DesignPatterns\PatronsDeCreation\FabriqueAbstraite\AbstractProductA;

class ConcreteProductA2 implements AbstractProductA
{
    public function usefulFunctionA(): string
    {
        return "The result of the product A2.";
    }
}
