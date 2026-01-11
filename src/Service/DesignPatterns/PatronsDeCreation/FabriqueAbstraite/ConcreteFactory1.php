<?php

namespace App\Service\DesignPatterns\PatronsDeCreation\FabriqueAbstraite;

use App\Service\DesignPatterns\PatronsDeCreation\FabriqueAbstraite\AbstractFactory;
use App\Service\DesignPatterns\PatronsDeCreation\FabriqueAbstraite\AbstractProductA;
use App\Service\DesignPatterns\PatronsDeCreation\FabriqueAbstraite\AbstractProductB;
use App\Service\DesignPatterns\PatronsDeCreation\FabriqueAbstraite\ConcreteProductA1;
use App\Service\DesignPatterns\PatronsDeCreation\FabriqueAbstraite\ConcreteProductB1;

/**
 * Concrete Factories produce a family of products that belong to a single
 * variant. The factory guarantees that resulting products are compatible. Note
 * that signatures of the Concrete Factory's methods return an abstract product,
 * while inside the method a concrete product is instantiated.
 */
class ConcreteFactory1 implements AbstractFactory
{
    public function createProductA(): AbstractProductA
    {
        return new ConcreteProductA1();
    }

    public function createProductB(): AbstractProductB
    {
        return new ConcreteProductB1();
    }
}
