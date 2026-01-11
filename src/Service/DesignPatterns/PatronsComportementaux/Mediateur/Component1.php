<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Mediateur;

use App\Service\DesignPatterns\PatronsComportementaux\Mediateur\BaseComponent;

/**
 * Concrete Components implement various functionality. They don't depend on
 * other components. They also don't depend on any concrete mediator classes.
 */
class Component1 extends BaseComponent
{
    public function doA(): void
    {
        dump("Component 1 does A.");
        $this->mediator->notify($this, "A");
    }

    public function doB(): void
    {
        dump("Component 1 does B.");
        $this->mediator->notify($this, "B");
    }
}
