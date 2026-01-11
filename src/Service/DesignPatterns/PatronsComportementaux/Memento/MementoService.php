<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Memento;

use App\Service\DesignPatterns\PatronsComportementaux\Memento\Caretaker;
use App\Service\DesignPatterns\PatronsComportementaux\Memento\Originator;

class MementoService
{
    public function runMementoService(): void
    {
        /**
         * Client code.
         */
        $originator = new Originator("Super-duper-super-puper-super.");
        $caretaker = new Caretaker($originator);

        $caretaker->backup();
        $originator->doSomething();

        $caretaker->backup();
        $originator->doSomething();

        $caretaker->backup();
        $originator->doSomething();

        dump("\n");
        $caretaker->showHistory();

        dump("\nClient: Now, let's rollback!\n\n");
        $caretaker->undo();

        dump("\nClient: Once more!\n\n");
        $caretaker->undo();
    }
}
