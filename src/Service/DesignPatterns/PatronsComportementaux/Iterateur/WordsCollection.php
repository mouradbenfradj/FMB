<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Iterateur;

use App\Service\DesignPatterns\PatronsComportementaux\Iterateur\AlphabeticalOrderIterator;

class WordsCollection implements \IteratorAggregate
{
    private array $items = [];

    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(string $item): void
    {
        $this->items[] = $item;
    }

    public function addItems(array $items): void
    {
        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    public function clear(): void
    {
        $this->items = [];
    }

    public function getIterator(): \Iterator
    {
        return new AlphabeticalOrderIterator($this);
    }

    public function getReverseIterator(): \Iterator
    {
        return new AlphabeticalOrderIterator($this, true);
    }
}
