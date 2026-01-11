<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Mediateur;

use App\Service\DesignPatterns\PatronsComportementaux\Mediateur\MediatorInterface;


abstract class BaseComponent
{
    protected ?MediatorInterface $mediator = null;

    public function setMediator(MediatorInterface $mediator): void
    {
        $this->mediator = $mediator;
    }
}
