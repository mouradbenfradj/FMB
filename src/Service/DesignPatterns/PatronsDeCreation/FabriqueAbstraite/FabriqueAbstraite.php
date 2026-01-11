<?php

namespace App\Service\DesignPatterns\PatronsDeCreation\FabriqueAbstraite;

use App\Service\DesignPatterns\PatronsDeCreation\FabriqueAbstraite\AbstractFactory;
use App\Service\DesignPatterns\PatronsDeCreation\FabriqueAbstraite\ConcreteFactory1;
use App\Service\DesignPatterns\PatronsDeCreation\FabriqueAbstraite\ConcreteFactory2;

class FabriqueAbstraite
{

    /**
     * The client code works with factories and products only through abstract
     * types: AbstractFactory and AbstractProduct. This lets you pass any factory or
     * product subclass to the client code without breaking it.
     */
    function clientCode(AbstractFactory $factory)
    {
        $productA = $factory->createProductA();
        $productB = $factory->createProductB();

        dump($productB->usefulFunctionB());
        dump($productB->anotherUsefulFunctionB($productA));
    }

    function affiche()
    {

        /**
         * The Application picks a creator's type depending on the configuration or
         * environment.
         */
        dump("App: Launched with the ConcreteCreator1.");
        $this->clientCode(new ConcreteFactory1());

        dump("App: Launched with the ConcreteCreator2.");
        $this->clientCode(new ConcreteFactory2());
    }
}
/* 
echo "Client: Testing client code with the first factory type:\n";
clientCode(new ConcreteFactory1());

echo "\n";

echo "Client: Testing the same client code with the second factory type:\n";
clientCode(new ConcreteFactory2());
 */