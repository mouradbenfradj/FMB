<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Etat;

use App\Service\DesignPatterns\PatronsComportementaux\Etat\State;
use App\Service\DesignPatterns\PatronsComportementaux\Etat\ConcreteStateA;

class ConcreteStateB extends State
{
    public function handle1(): void
    {
        dump("ConcreteStateB handles request1.");
    }

    public function handle2(): void
    {
        dump("ConcreteStateB handles request2.");
        dump("ConcreteStateB wants to change the state of the context.");
        $this->context->transitionTo(new ConcreteStateA());
    }
}
