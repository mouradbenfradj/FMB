<?php

namespace App\Service\DesignPattern\FabriqueAbstraite\Exemple1;


class ConcreteProductA2 implements AbstractProductA
{
    public function usefulFunctionA(): string
    {
        return "The result of the product A2.";
    }
}

