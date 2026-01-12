<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Strategie;

use App\Service\DesignPatterns\PatronsComportementaux\Strategie\Context;
use App\Service\DesignPatterns\PatronsComportementaux\Strategie\ConcreteStrategyA;
use App\Service\DesignPatterns\PatronsComportementaux\Strategie\ConcreteStrategyB;

/**
 * The client code picks a concrete strategy and passes it to the context. The
 * client should be aware of the differences between strategies in order to make
 * the right choice.
 */
class StrategieService
{
    public function runStrategieService()
    {

        $context = new Context(new ConcreteStrategyA());
        dump("Client: Strategy is set to normal sorting.\n");
        $context->doSomeBusinessLogic();


        dump("Client: Strategy is set to reverse sorting.\n");
        $context->setStrategy(new ConcreteStrategyB());
        $context->doSomeBusinessLogic();
    }
}
