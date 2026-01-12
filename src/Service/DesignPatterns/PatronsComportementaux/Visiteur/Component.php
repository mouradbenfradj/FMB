<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Visiteur;

use App\Service\DesignPatterns\PatronsComportementaux\Visiteur\Visitor;

/**
 * The Component interface declares an `accept` method that should take the base
 * visitor interface as an argument.
 */
interface Component
{
    public function accept(Visitor $visitor): void;
}
