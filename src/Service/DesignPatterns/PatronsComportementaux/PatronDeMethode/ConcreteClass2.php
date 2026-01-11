<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\PatronDeMethode;

use App\Service\DesignPatterns\PatronsComportementaux\PatronDeMethode\AbstractClass;

/**
 * Usually, concrete classes override only a fraction of base class' operations.
 */
class ConcreteClass2 extends AbstractClass
{
    protected function requiredOperations1(): void
    {
        dump("ConcreteClass2 says: Implemented Operation1");
    }

    protected function requiredOperation2(): void
    {
        dump("ConcreteClass2 says: Implemented Operation2");
    }

    protected function hook1(): void
    {
        dump("ConcreteClass2 says: Overridden Hook1");
    }
}
