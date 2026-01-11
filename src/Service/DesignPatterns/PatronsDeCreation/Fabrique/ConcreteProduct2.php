<?php

namespace App\Service\DesignPatterns\PatronsDeCreation\Fabrique;

use App\Service\DesignPatterns\PatronsDeCreation\Fabrique\Product;

class ConcreteProduct2 implements Product
{
    public function operation(): string
    {
        return "{Result of the ConcreteProduct2}";
    }
}
