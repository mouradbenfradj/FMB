<?php

namespace App\Service\DesignPatterns\PatronsStructurels\Decorateur;

use App\Service\DesignPatterns\PatronsStructurels\Decorateur\Component;
use App\Service\DesignPatterns\PatronsStructurels\Decorateur\ConcreteComponent;
use App\Service\DesignPatterns\PatronsStructurels\Decorateur\ConcreteDecoratorA;
use App\Service\DesignPatterns\PatronsStructurels\Decorateur\ConcreteDecoratorB;


class DecorateurService
{
    /**
     * The client code works with all objects using the Component interface. This
     * way it can stay independent of the concrete classes of components it works
     * with.
     */
    function clientCode(Component $component)
    {
        // ...
        dump("RESULT: " . $component->operation());
        // ...
    }

    public function runDecorateurService()
    {
        /**
         * This way the client code can support both simple components...
         */
        $simple = new ConcreteComponent();
        dump("Client: I've got a simple component:\n");
        $this->clientCode($simple);
        dump("\n\n");

        /**
         * ...as well as decorated ones.
         *
         * Note how decorators can wrap not only simple components but the other
         * decorators as well.
         */
        $decorator1 = new ConcreteDecoratorA($simple);
        $decorator2 = new ConcreteDecoratorB($decorator1);
        dump("Client: Now I've got a decorated component:\n");
        $this->clientCode($decorator2);
    }
}
