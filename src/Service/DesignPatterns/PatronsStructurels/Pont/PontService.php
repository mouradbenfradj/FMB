<?php

namespace App\Service\DesignPatterns\PatronsStructurels\Pont;

use App\Service\DesignPatterns\PatronsStructurels\Pont\Abstraction;
use App\Service\DesignPatterns\PatronsStructurels\Pont\ExtendedAbstraction;
use App\Service\DesignPatterns\PatronsStructurels\Pont\ConcreteImplementationA;
use App\Service\DesignPatterns\PatronsStructurels\Pont\ConcreteImplementationB;

class PontService
{

    /**
     * Except for the initialization phase, where an Abstraction object gets linked
     * with a specific Implementation object, the client code should only depend on
     * the Abstraction class. This way the client code can support any abstraction-
     * implementation combination.
     */
    function clientCode(Abstraction $abstraction)
    {
        // ...
        dump($abstraction->operation());
        // ...
    }


    public function runPontService()
    {
        /**
         * The client code should be able to work with any pre-configured abstraction-
         * implementation combination.
         */
        $implementation = new ConcreteImplementationA();
        $abstraction = new Abstraction($implementation);
        $this->clientCode($abstraction);

        dump("\n");

        $implementation = new ConcreteImplementationB();
        $abstraction = new ExtendedAbstraction($implementation);
        $this->clientCode($abstraction);
    }
}
