<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Etat;

use App\Service\DesignPatterns\PatronsComportementaux\Etat\State;
use App\Service\DesignPatterns\PatronsComportementaux\Etat\ConcreteStateB;

/**
 * Concrete States implement various behaviors, associated with a state of the
 * Context.
 */
class ConcreteStateA extends State
{
    public function handle1(): void
    {
        dump("ConcreteStateA handles request1.");
        dump("ConcreteStateA wants to change the state of the context.");
        $this->context->transitionTo(new ConcreteStateB());
    }

    public function handle2(): void
    {
        dump("ConcreteStateA handles request2.");
    }
}
