<?php

namespace App\Service\DesignPatterns\PatronsDeCreation\Prototype;

use App\Service\DesignPatterns\PatronsDeCreation\Prototype\Prototype;

class ComponentWithBackReference
{
    public $prototype;

    /**
     * Note that the constructor won't be executed during cloning. If you have
     * complex logic inside the constructor, you may need to execute it in the
     * `__clone` method as well.
     */
    public function __construct(Prototype $prototype)
    {
        $this->prototype = $prototype;
    }
}
