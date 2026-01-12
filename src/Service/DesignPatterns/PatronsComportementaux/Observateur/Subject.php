<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Observateur;


/**
 * The Subject owns some important state and notifies observers when the state
 * changes.
 */
class Subject implements \SplSubject
{
    /**
     * @var int For the sake of simplicity, the Subject s state, essential to
     * all subscribers, is stored in this variable.
     */
    public $state;

    /**
     * @var \SplObjectStorage List of subscribers. In real life, the list of
     * subscribers can be stored more comprehensively (categorized by event
     * type, etc.).
     */
    private $observers;

    public function __construct()
    {
        $this->observers = new \SplObjectStorage();
    }

    /**
     * The subscription management methods.
     */
    public function attach(\SplObserver $observer): void
    {
        dump("Subject: Attached an observer.");
        $this->observers->attach($observer);
    }

    public function detach(\SplObserver $observer): void
    {
        $this->observers->detach($observer);
        dump("Subject: Detached an observer.");
    }

    /**
     * Trigger an update in each subscriber.
     */
    public function notify(): void
    {
        dump("Subject: Notifying observers...");
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    /**
     * Usually, the subscription logic is only a fraction of what a Subject can
     * really do. Subjects commonly hold some important business logic, that
     * triggers a notification method whenever something important is about to
     * happen (or after it).
     */
    public function someBusinessLogic(): void
    {
        dump("\nSubject: I'm doing something important.");
        $this->state = rand(0, 10);

        dump("Subject: My state has just changed to: {$this->state}");
        $this->notify();
    }
}
