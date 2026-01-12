<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\PatronDeMethode;

use App\Service\DesignPatterns\PatronsComportementaux\PatronDeMethode\AbstractClass;


/**
 * Concrete classes have to implement all abstract operations of the base class.
 * They can also override some operations with a default implementation.
 */
class ConcreteClass1 extends AbstractClass
{
    protected function requiredOperations1(): void
    {
        dump("ConcreteClass1 says: Implemented Operation1");
    }

    protected function requiredOperation2(): void
    {
        dump("ConcreteClass1 says: Implemented Operation2");
    }
}
