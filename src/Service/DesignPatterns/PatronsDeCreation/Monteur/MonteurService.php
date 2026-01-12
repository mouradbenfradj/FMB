<?php

namespace App\Service\DesignPatterns\PatronsDeCreation\Monteur;

use App\Service\DesignPatterns\PatronsDeCreation\Monteur\Director;
use App\Service\DesignPatterns\PatronsDeCreation\Monteur\ConcreteBuilder1;

class MonteurService
{
    /**
     * The client code creates a builder object, passes it to the director and then
     * initiates the construction process. The end result is retrieved from the
     * builder object.
     */
    function clientCode(Director $director)
    {
        $builder = new ConcreteBuilder1();
        $director->setBuilder($builder);

        dump("Standard basic product:");
        $director->buildMinimalViableProduct();
        $builder->getProduct()->listParts();

        dump("Standard full featured product:");
        $director->buildFullFeaturedProduct();
        $builder->getProduct()->listParts();

        // Remember, the Builder pattern can be used without a Director class.
        dump("Custom product:");
        $builder->producePartA();
        $builder->producePartC();
        $builder->getProduct()->listParts();
    }


    function affiche()
    {
        $director = new Director();
        $this->clientCode($director);
    }
}
