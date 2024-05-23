<?php

namespace App\Service\DesignPattern\FabriqueAbstraite\Exemple1;


/**
 * Each distinct product of a product family should have a base interface. All
 * variants of the product must implement this interface.
 */
interface AbstractProductA
{
    public function usefulFunctionA(): string;
}
