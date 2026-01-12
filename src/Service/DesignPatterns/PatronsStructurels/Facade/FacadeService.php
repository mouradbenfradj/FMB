<?php

namespace App\Service\DesignPatterns\PatronsStructurels\Facade;

use App\Service\DesignPatterns\PatronsStructurels\Facade\Facade;
use App\Service\DesignPatterns\PatronsStructurels\Facade\Subsystem1;
use App\Service\DesignPatterns\PatronsStructurels\Facade\Subsystem2;

class FacadeService
{

    /**
     * The client code works with complex subsystems through a simple interface
     * provided by the Facade. When a facade manages the lifecycle of the subsystem,
     * the client might not even know about the existence of the subsystem. This
     * approach lets you keep the complexity under control.
     */
    function clientCode(Facade $facade)
    {
        // ...

        dump($facade->operation());

        // ...
    }

    public function runFacadeService()
    {
        /**
         * The client code may have some of the subsystem's objects already created. In
         * this case, it might be worthwhile to initialize the Facade with these objects
         * instead of letting the Facade create new instances.
         */
        $subsystem1 = new Subsystem1();
        $subsystem2 = new Subsystem2();
        $facade = new Facade($subsystem1, $subsystem2);
        $this->clientCode($facade);
    }
}
