<?php

namespace App\Service\DesignPattern\Strategy\Exemple1;



class ConcreteStrategyB implements Strategy
{
    public function doAlgorithm(array $data): array
    {
        rsort($data);

        return $data;
    }
}
