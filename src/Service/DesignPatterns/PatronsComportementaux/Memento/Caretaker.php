<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Memento;

use App\Service\DesignPatterns\PatronsComportementaux\Memento\Originator;

/**
 * The Caretaker doesn't depend on the Concrete Memento class. Therefore, it
 * doesn't have access to the originator's state, stored inside the memento. It
 * works with all mementos via the base Memento interface.
 */
class Caretaker
{
    /**
     * @var Memento[]
     */
    private $mementos = [];

    /**
     * @var Originator
     */
    private $originator;

    public function __construct(Originator $originator)
    {
        $this->originator = $originator;
    }

    public function backup(): void
    {
        dump("\nCaretaker: Saving Originator's state...\n");
        $this->mementos[] = $this->originator->save();
    }

    public function undo(): void
    {
        if (!count($this->mementos)) {
            return;
        }
        $memento = array_pop($this->mementos);

        dump("Caretaker: Restoring state to: " . $memento->getName() . "\n");
        try {
            $this->originator->restore($memento);
        } catch (\Exception $e) {
            $this->undo();
        }
    }

    public function showHistory(): void
    {
        dump("Caretaker: Here's the list of mementos:\n");
        foreach ($this->mementos as $memento) {
            dump($memento->getName() . "\n");
        }
    }
}
