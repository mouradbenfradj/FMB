<?php

namespace App\Service\DesignPatterns\PatronsDeCreation\FabriqueAbstraite;

use App\Service\DesignPatterns\PatronsDeCreation\FabriqueAbstraite\AbstractFactory;
use App\Service\DesignPatterns\PatronsDeCreation\FabriqueAbstraite\AbstractProductA;
use App\Service\DesignPatterns\PatronsDeCreation\FabriqueAbstraite\AbstractProductB;
use App\Service\DesignPatterns\PatronsDeCreation\FabriqueAbstraite\ConcreteProductA2;
use App\Service\DesignPatterns\PatronsDeCreation\FabriqueAbstraite\ConcreteProductB2;

/**
 * Each Concrete Factory has a corresponding product variant.
 */
class ConcreteFactory2 implements AbstractFactory
{
    public function createProductA(): AbstractProductA
    {
        return new ConcreteProductA2();
    }

    public function createProductB(): AbstractProductB
    {
        return new ConcreteProductB2();
    }
}
