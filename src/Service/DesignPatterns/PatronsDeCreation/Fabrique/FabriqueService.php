<?php

namespace App\Service\DesignPatterns\PatronsDeCreation\Fabrique;

use App\Service\DesignPatterns\PatronsDeCreation\Fabrique\Creator;
use App\Service\DesignPatterns\PatronsDeCreation\Fabrique\ConcreteCreator1;
use App\Service\DesignPatterns\PatronsDeCreation\Fabrique\ConcreteCreator2;

class FabriqueService
{
    /**
     * The client code works with an instance of a concrete creator, albeit through
     * its base interface. As long as the client keeps working with the creator via
     * the base interface, you can pass it any creator's subclass.
     */
    public function clientCode(Creator $creator)
    {
        // ...
        dump("Client: I'm not aware of the creator's class, but it still works. "
            . $creator->someOperation());
        // ...
    }

    public function affiche()
    {

        /**
         * The Application picks a creator's type depending on the configuration or
         * environment.
         */
        dump("App: Launched with the ConcreteCreator1.");
        $this->clientCode(new ConcreteCreator1());

        dump("App: Launched with the ConcreteCreator2.");
        $this->clientCode(new ConcreteCreator2());
    }
}
