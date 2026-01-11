<?php

namespace App\Service\DesignPatterns\PatronsStructurels\Composite;

use App\Service\DesignPatterns\PatronsStructurels\Composite\Leaf;
use App\Service\DesignPatterns\PatronsStructurels\Composite\Component;
use App\Service\DesignPatterns\PatronsStructurels\Composite\Composite;

/**
 * The Leaf class represents the end objects of a composition. A leaf can't have
 * any children.
 *
 * Usually, it's the Leaf objects that do the actual work, whereas Composite
 * objects only delegate to their sub-components.
 */
class CompositeService
{
    public function runCompositeService()
    {
        /**
         * This way the client code can support the simple leaf components...
         */
        $simple = new Leaf();
        dump("Client: I've got a simple component:\n");
        $this->clientCode($simple);
        dump("\n\n");

        /**
         * ...as well as the complex composites.
         */
        $tree = new Composite();
        $branch1 = new Composite();
        $branch1->add(new Leaf());
        $branch1->add(new Leaf());
        $branch2 = new Composite();
        $branch2->add(new Leaf());
        $tree->add($branch1);
        $tree->add($branch2);
        dump("Client: Now I've got a composite tree:\n");
        $this->clientCode($tree);
        dump("\n\n");

        dump("Client: I don't need to check the components classes even when managing the tree:\n");
        $this->clientCode2($tree, $simple);
    }

    /**
     * The client code works with all of the components via the base interface.
     */
    function clientCode(Component $component)
    {
        // ...

        dump("RESULT: " . $component->operation());

        // ...
    }

    /**
     * Thanks to the fact that the child-management operations are declared in the
     * base Component class, the client code can work with any component, simple or
     * complex, without depending on their concrete classes.
     */
    function clientCode2(Component $component1, Component $component2)
    {
        // ...

        if ($component1->isComposite()) {
            $component1->add($component2);
        }
        dump("RESULT: " . $component1->operation());

        // ...
    }
}
