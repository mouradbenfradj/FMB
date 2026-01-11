<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Mediateur;

use App\Service\DesignPatterns\PatronsComportementaux\Mediateur\BaseComponent;

class Component2 extends BaseComponent
{
    public function doC(): void
    {
        dump("Component 2 does C.");
        $this->mediator->notify($this, "C");
    }

    public function doD(): void
    {
        dump("Component 2 does D.");
        $this->mediator->notify($this, "D");
    }
}
