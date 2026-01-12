<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\PatronDeMethode;

use App\Service\DesignPatterns\PatronsComportementaux\PatronDeMethode\AbstractClass;
use App\Service\DesignPatterns\PatronsComportementaux\PatronDeMethode\ConcreteClass1;
use App\Service\DesignPatterns\PatronsComportementaux\PatronDeMethode\ConcreteClass2;

/**
 * Usually, concrete classes override only a fraction of base class' operations.
 */
class PatronDeMethodeService
{

    /**
     * The client code calls the template method to execute the algorithm. Client
     * code does not have to know the concrete class of an object it works with, as
     * long as it works with objects through the interface of their base class.
     */
    private function clientCode(AbstractClass $class)
    {
        // ...
        $class->templateMethod();
        // ...
    }
    public function runPatronDeMethodeService(): void
    {
        dump("Same client code can work with different subclasses:");
        $this->clientCode(new ConcreteClass1());

        dump("Same client code can work with different subclasses:");
        $this->clientCode(new ConcreteClass2());
    }
}
