<?php

namespace App\Service\DesignPattern\Visiteur\Exemple1;


/**
 * The Component interface declares an `accept` method that should take the base
 * visitor interface as an argument.
 */
interface Component
{
    public function accept(Visitor $visitor): void;
}
