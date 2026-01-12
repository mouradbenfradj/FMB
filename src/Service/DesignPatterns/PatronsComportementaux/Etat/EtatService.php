<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Etat;

use App\Service\DesignPatterns\PatronsComportementaux\Etat\Context;
use App\Service\DesignPatterns\PatronsComportementaux\Etat\ConcreteStateA;

class EtatService
{
    public function run(): void
    {

        /**
         * The client code.
         */
        $context = new Context(new ConcreteStateA());
        $context->request1();
        $context->request2();
    }
}
