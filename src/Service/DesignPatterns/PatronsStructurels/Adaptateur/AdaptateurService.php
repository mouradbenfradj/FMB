<?php

namespace App\Service\DesignPatterns\PatronsStructurels\Adaptateur;

use App\Service\DesignPatterns\PatronsStructurels\Adaptateur\Target;
use App\Service\DesignPatterns\PatronsStructurels\Adaptateur\Adaptee;
use App\Service\DesignPatterns\PatronsStructurels\Adaptateur\Adapter;

class AdaptateurService
{
    /**
     * The client code supports all classes that follow the Target interface.
     */
    function clientCode(Target $target)
    {
        dump($target->request());
    }

    public function runAdaptateurService()
    {

        dump("Client: I can work just fine with the Target objects:");
        $target = new Target();
        $this->clientCode($target);

        $adaptee = new Adaptee();
        dump("Client: The Adaptee class has a weird interface. See, I don't understand it:");
        dump("Adaptee: " . $adaptee->specificRequest());
        dump("Client: But I can work with it via the Adapter:");
        $adapter = new Adapter($adaptee);
        $this->clientCode($adapter);
    }
}
