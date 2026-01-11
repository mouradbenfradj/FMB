<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Strategie;

use App\Service\DesignPatterns\PatronsComportementaux\Strategie\Strategy;

/**
 * Concrete Strategies implement the algorithm while following the base Strategy
 * interface. The interface makes them interchangeable in the Context.
 */
class ConcreteStrategyA implements Strategy
{
    public function doAlgorithm(array $data): array
    {
        sort($data);

        return $data;
    }
}
