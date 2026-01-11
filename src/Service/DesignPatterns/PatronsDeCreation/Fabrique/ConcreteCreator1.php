<?php

namespace App\Service\DesignPatterns\PatronsDeCreation\Fabrique;

use App\Service\DesignPatterns\PatronsDeCreation\Fabrique\Product;
use App\Service\DesignPatterns\PatronsDeCreation\Fabrique\ConcreteProduct1;
use App\Service\DesignPatterns\PatronsDeCreation\Fabrique\Creator;

/**
 * Concrete Creators override the factory method in order to change the
 * resulting product's type.
 */
class ConcreteCreator1 extends Creator
{
    /**
     * Note that the signature of the method still uses the abstract product
     * type, even though the concrete product is actually returned from the
     * method. This way the Creator can stay independent of concrete product
     * classes.
     */
    public function factoryMethod(): Product
    {
        return new ConcreteProduct1();
    }
}
