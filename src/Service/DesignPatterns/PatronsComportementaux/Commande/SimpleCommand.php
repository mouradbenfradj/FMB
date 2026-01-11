<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Commande;

use App\Service\DesignPatterns\PatronsComportementaux\Commande\Command;

/**
 * Some commands can implement simple operations on their own.
 */
class SimpleCommand implements Command
{
    private $payload;

    public function __construct(string $payload)
    {
        $this->payload = $payload;
    }

    public function execute(): void
    {
        dump("SimpleCommand: See, I can do simple things like printing (" . $this->payload . ")\n");
    }
}
