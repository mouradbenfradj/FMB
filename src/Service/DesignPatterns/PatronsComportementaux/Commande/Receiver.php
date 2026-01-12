<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Commande;

use App\Service\DesignPatterns\PatronsDeCreation\Singleton\Singleton;


/**
 * The Receiver classes contain some important business logic. They know how to
 * perform all kinds of operations, associated with carrying out a request. In
 * fact, any class may serve as a Receiver.
 */
class Receiver
{
    public function doSomething(string $a): void
    {
        dump("Receiver: Working on (" . $a . ".)\n");
    }

    public function doSomethingElse(string $b): void
    {
        dump("Receiver: Also working on (" . $b . ".)\n");
    }
}
