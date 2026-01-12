<?php

namespace App\Service\DesignPatterns\PatronsDeCreation\Fabrique;

use App\Service\DesignPatterns\PatronsDeCreation\Fabrique\Creator;
use App\Service\DesignPatterns\PatronsDeCreation\Fabrique\Product;
use App\Service\DesignPatterns\PatronsDeCreation\Fabrique\ConcreteProduct2;


class ConcreteCreator2 extends Creator
{
    public function factoryMethod(): Product
    {
        return new ConcreteProduct2();
    }
}
