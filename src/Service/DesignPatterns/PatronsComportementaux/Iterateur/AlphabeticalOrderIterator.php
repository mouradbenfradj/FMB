<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Iterateur;

use App\Service\DesignPatterns\PatronsComportementaux\Iterateur\WordsCollection;

class AlphabeticalOrderIterator implements \Iterator
{
    private WordsCollection $collection;
    private int $position = 0;
    private bool $reverse = false;

    public function __construct(WordsCollection $collection, bool $reverse = false)
    {
        $this->collection = $collection;
        $this->reverse = $reverse;
    }

    public function rewind(): void
    {
        $this->position = $this->reverse ?
            count($this->collection->getItems()) - 1 : 0;
    }

    public function current(): string
    {
        return $this->collection->getItems()[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        $this->position = $this->position + ($this->reverse ? -1 : 1);
    }

    public function valid(): bool
    {
        return isset($this->collection->getItems()[$this->position]);
    }
}
