<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Observateur;

/**
 * Concrete Observers react to the updates issued by the Subject they had been
 * attached to.
 */
class ConcreteObserverA implements \SplObserver
{
    public function update(\SplSubject $subject): void
    {
        if ($subject->state < 3) {
            dump("ConcreteObserverA: Reacted to the event.");
        }
    }
}
