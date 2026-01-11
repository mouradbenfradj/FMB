<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Commande;

/**
 * The Command interface declares a method for executing a command.
 */
interface Command
{
    public function execute(): void;
}
