<?php

namespace App\Service\DesignPatterns\PatronsDeCreation\Singleton;

use App\Service\DesignPatterns\PatronsDeCreation\Singleton\Singleton;

/**
 * The Singleton class defines the `GetInstance` method that serves as an
 * alternative to constructor and lets clients access the same instance of this
 * class over and over.
 */
class SingletonService
{
    /**
     * The client code.
     */
    function run()
    {
        $s1 = Singleton::getInstance();
        $s2 = Singleton::getInstance();
        if ($s1 === $s2) {
            dump("Singleton works, both variables contain the same instance.");
        } else {
            dump("Singleton failed, variables contain different instances.");
        }
    }

    //clientCode();
}
