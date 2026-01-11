<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\ChaineDeResponsabilité;

/**
 * The Handler interface declares a method for building the chain of handlers.
 * It also declares a method for executing a request.
 */
interface Handler
{
    public function setNext(self $handler): self;

    public function handle(string $request): ?string;
}
