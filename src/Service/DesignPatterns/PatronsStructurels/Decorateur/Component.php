<?php

namespace App\Service\DesignPatterns\PatronsStructurels\Decorateur;

/**
 * The base Component interface defines operations that can be altered by
 * decorators.
 */
interface Component
{
    public function operation(): string;
}
