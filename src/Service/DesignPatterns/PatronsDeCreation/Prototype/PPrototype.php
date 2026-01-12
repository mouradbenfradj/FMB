<?php

namespace App\Service\DesignPatterns\PatronsDeCreation\Prototype;

use App\Service\DesignPatterns\PatronsDeCreation\Prototype\Prototype;
use App\Service\DesignPatterns\PatronsDeCreation\Prototype\ComponentWithBackReference;

class PPrototype
{

    /**
     * The client code.
     */
    function run()
    {
        $p1 = new Prototype();
        $p1->primitive = 245;
        $p1->component = new \DateTime();
        $p1->circularReference = new ComponentWithBackReference($p1);

        $p2 = clone $p1;
        if ($p1->primitive === $p2->primitive) {
            dump("Primitive field values have been carried over to a clone. Yay!");
        } else {
            dump("Primitive field values have not been copied. Booo!");
        }
        if ($p1->component === $p2->component) {
            dump("Simple component has not been cloned. Booo!");
        } else {
            dump("Simple component has been cloned. Yay!");
        }

        if ($p1->circularReference === $p2->circularReference) {
            dump("Component with back reference has not been cloned. Booo!");
        } else {
            dump("Component with back reference has been cloned. Yay!");
        }

        if ($p1->circularReference->prototype === $p2->circularReference->prototype) {
            dump("Component with back reference is linked to original object. Booo!");
        } else {
            dump("Component with back reference is linked to the clone. Yay!");
        }
    }
}
