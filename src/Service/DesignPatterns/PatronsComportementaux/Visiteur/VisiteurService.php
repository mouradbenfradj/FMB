<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Visiteur;

use App\Service\DesignPatterns\PatronsComportementaux\Visiteur\Visitor;
use App\Service\DesignPatterns\PatronsComportementaux\Visiteur\ConcreteVisitor1;
use App\Service\DesignPatterns\PatronsComportementaux\Visiteur\ConcreteVisitor2;
use App\Service\DesignPatterns\PatronsComportementaux\Visiteur\ConcreteComponentA;
use App\Service\DesignPatterns\PatronsComportementaux\Visiteur\ConcreteComponentB;

/**
 * Each Concrete Component must implement the `accept` method in such a way that
 * it calls the visitor's method corresponding to the component's class.
 */
class VisiteurService
{

    /**
     * The client code can run visitor operations over any set of elements without
     * figuring out their concrete classes. The accept operation directs a call to
     * the appropriate operation in the visitor object.
     */
    function clientCode(array $components, Visitor $visitor)
    {
        // ...
        foreach ($components as $component) {
            $component->accept($visitor);
        }
        // ...
    }

    public function runVisiteurService()
    {
        $components = [
            new ConcreteComponentA(),
            new ConcreteComponentB(),
        ];

        dump("The client code works with all visitors via the base Visitor interface:");
        $visitor1 = new ConcreteVisitor1();
        $this->clientCode($components, $visitor1);
        dump("");

        dump("It allows the same client code to work with different types of visitors:");
        $visitor2 = new ConcreteVisitor2();
        $this->clientCode($components, $visitor2);
    }
}
