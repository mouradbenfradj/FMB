<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Mediateur;

use App\Service\DesignPatterns\PatronsComportementaux\Mediateur\Component1;
use App\Service\DesignPatterns\PatronsComportementaux\Mediateur\Component2;
use App\Service\DesignPatterns\PatronsComportementaux\Mediateur\MediatorInterface;


/**
 * Concrete Mediators implement cooperative behavior by coordinating several
 * components.
 */
class ConcreteMediator implements MediatorInterface
{
    private $component1;

    private $component2;

    public function __construct(Component1 $c1, Component2 $c2)
    {
        $this->component1 = $c1;
        $this->component1->setMediator($this);
        $this->component2 = $c2;
        $this->component2->setMediator($this);
    }

    public function notify(object $sender, string $event): void
    {
        if ($event == "A") {
            dump("Mediator reacts on A and triggers following operations:");
            $this->component2->doC();
        }

        if ($event == "D") {
            dump("Mediator reacts on D and triggers following operations:");
            $this->component1->doB();
            $this->component2->doC();
        }
    }
}
