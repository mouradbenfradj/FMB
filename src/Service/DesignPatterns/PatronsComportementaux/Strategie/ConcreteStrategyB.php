<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Strategie;

use App\Service\DesignPatterns\PatronsComportementaux\Strategie\Strategy;

class ConcreteStrategyB implements Strategy
{
    public function doAlgorithm(array $data): array
    {
        rsort($data);

        return $data;
    }
}
