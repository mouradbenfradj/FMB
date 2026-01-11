<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Visiteur;

use App\Service\DesignPatterns\PatronsComportementaux\Visiteur\Visitor;
use App\Service\DesignPatterns\PatronsComportementaux\Visiteur\ConcreteComponentA;

use App\Service\DesignPatterns\PatronsComportementaux\Visiteur\ConcreteComponentB;

/**
 * Concrete Visitors implement several versions of the same algorithm, which can
 * work with all concrete component classes.
 *
 * You can experience the biggest benefit of the Visitor pattern when using it
 * with a complex object structure, such as a Composite tree. In this case, it
 * might be helpful to store some intermediate state of the algorithm while
 * executing visitor's methods over various objects of the structure.
 */
class ConcreteVisitor1 implements Visitor
{
    public function visitConcreteComponentA(ConcreteComponentA $element): void
    {
        dump($element->exclusiveMethodOfConcreteComponentA() . " + ConcreteVisitor1");
    }

    public function visitConcreteComponentB(ConcreteComponentB $element): void
    {
        dump($element->specialMethodOfConcreteComponentB() . " + ConcreteVisitor1");
    }
}
