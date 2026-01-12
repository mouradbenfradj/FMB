<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Observateur;


class ConcreteObserverB implements \SplObserver
{
    public function update(\SplSubject $subject): void
    {
        if ($subject->state == 0 || $subject->state >= 2) {
            dump("ConcreteObserverB: Reacted to the event.");
        }
    }
}
