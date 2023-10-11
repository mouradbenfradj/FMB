<?php

namespace App\Service\DesignPattern\Composite\FiliereV1;

class Leaf extends Component
{
    public function operation(): string
    {
        return "F1";
    }
}
