<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Visiteur;

use App\Service\DesignPatterns\PatronsComportementaux\Visiteur\Visitor;
use App\Service\DesignPatterns\PatronsComportementaux\Visiteur\ConcreteComponentA;
use App\Service\DesignPatterns\PatronsComportementaux\Visiteur\ConcreteComponentB;

class ConcreteVisitor2 implements Visitor
{
    public function visitConcreteComponentA(ConcreteComponentA $element): void
    {
        dump($element->exclusiveMethodOfConcreteComponentA() . " + ConcreteVisitor2");
    }

    public function visitConcreteComponentB(ConcreteComponentB $element): void
    {
        dump($element->specialMethodOfConcreteComponentB() . " + ConcreteVisitor2");
    }
}
