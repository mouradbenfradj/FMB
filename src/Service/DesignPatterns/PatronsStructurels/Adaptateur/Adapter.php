<?php

namespace App\Service\DesignPatterns\PatronsStructurels\Adaptateur;

use App\Service\DesignPatterns\PatronsStructurels\Adaptateur\Target;
use App\Service\DesignPatterns\PatronsStructurels\Adaptateur\Adaptee;


/**
 * The Adapter makes the Adaptee's interface compatible with the Target's
 * interface.
 */
class Adapter extends Target
{
    private $adaptee;

    public function __construct(Adaptee $adaptee)
    {
        $this->adaptee = $adaptee;
    }

    public function request(): string
    {
        return "Adapter: (TRANSLATED) " . strrev($this->adaptee->specificRequest());
    }
}
