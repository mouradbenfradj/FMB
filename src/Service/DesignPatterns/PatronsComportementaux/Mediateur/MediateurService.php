<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Mediateur;

use App\Service\DesignPatterns\PatronsComportementaux\Mediateur\Component1;
use App\Service\DesignPatterns\PatronsComportementaux\Mediateur\Component2;
use App\Service\DesignPatterns\PatronsComportementaux\Mediateur\ConcreteMediator;

class MediateurService
{

    public function run()
    {

        $c1 = new Component1();
        $c2 = new Component2();
        $mediator = new ConcreteMediator($c1, $c2);

        dump("Client triggers operation A.");
        $c1->doA();

        dump("Client triggers operation D.");
        $c2->doD();
    }
}
