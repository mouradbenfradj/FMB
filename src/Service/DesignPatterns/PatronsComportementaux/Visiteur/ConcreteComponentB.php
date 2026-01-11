<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Visiteur;

use App\Service\DesignPatterns\PatronsComportementaux\Visiteur\Visitor;
use App\Service\DesignPatterns\PatronsComportementaux\Visiteur\Component;


class ConcreteComponentB implements Component
{
    /**
     * Same here: visitConcreteComponentB => ConcreteComponentB
     */
    public function accept(Visitor $visitor): void
    {
        $visitor->visitConcreteComponentB($this);
    }

    public function specialMethodOfConcreteComponentB(): string
    {
        return "B";
    }
}
