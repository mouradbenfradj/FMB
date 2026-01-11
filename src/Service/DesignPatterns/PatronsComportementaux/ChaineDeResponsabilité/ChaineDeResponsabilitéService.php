<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\ChaineDeResponsabilité;

use App\Service\DesignPatterns\PatronsComportementaux\ChaineDeResponsabilité\Handler;
use App\Service\DesignPatterns\PatronsComportementaux\ChaineDeResponsabilité\DogHandler;
use App\Service\DesignPatterns\PatronsComportementaux\ChaineDeResponsabilité\MonkeyHandler;
use App\Service\DesignPatterns\PatronsComportementaux\ChaineDeResponsabilité\SquirrelHandler;

/**
 * All Concrete Handlers either handle a request or pass it to the next handler
 * in the chain.
 */
class ChaineDeResponsabilitéService
{


    /**
     * The client code is usually suited to work with a single handler. In most
     * cases, it is not even aware that the handler is part of a chain.
     */
    function clientCode(Handler $handler)
    {
        foreach (["Nut", "Banana", "Cup of coffee"] as $food) {
            dump("Client: Who wants a " . $food . "?");
            $result = $handler->handle($food);
            if ($result) {
                dump("  " . $result);
            } else {
                dump("  " . $food . " was left untouched.");
            }
        }
    }

    public function chaineDeResponsabilitéService()
    {


        $monkey = new MonkeyHandler();
        $squirrel = new SquirrelHandler();
        $dog = new DogHandler();

        $monkey->setNext($squirrel)->setNext($dog);

        /**
         * The client should be able to send a request to any handler, not just the
         * first one in the chain.
         */
        dump("Chain: Monkey > Squirrel > Dog");
        $this->clientCode($monkey);
        dump("");

        dump("Subchain: Squirrel > Dog");
        $this->clientCode($squirrel);
    }
}
