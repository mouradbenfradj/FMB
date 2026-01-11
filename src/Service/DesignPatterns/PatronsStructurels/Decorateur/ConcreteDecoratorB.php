<?php

namespace App\Service\DesignPatterns\PatronsStructurels\Decorateur;

use App\Service\DesignPatterns\PatronsStructurels\Decorateur\Decorator;

/**
 * Decorators can execute their behavior either before or after the call to a
 * wrapped object.
 */
class ConcreteDecoratorB extends Decorator
{
    public function operation(): string
    {
        return "ConcreteDecoratorB(" . parent::operation() . ")";
    }
}
