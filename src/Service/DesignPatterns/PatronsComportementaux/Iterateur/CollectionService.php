<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Iterateur;

use App\Service\DesignPatterns\PatronsComportementaux\Iterateur\WordsCollection;

class CollectionService
{
    private WordsCollection $collection;

    public function __construct()
    {
        $this->collection = new WordsCollection();
    }

    public function createCollection(array $items = []): WordsCollection
    {
        $collection = new WordsCollection();
        $collection->addItems($items);

        return $collection;
    }

    public function processCollection(WordsCollection $collection): array
    {
        $result = [
            'straight' => [],
            'reverse' => []
        ];

        // Traversal droit
        foreach ($collection->getIterator() as $item) {
            $result['straight'][] = $item;
        }

        // Traversal inverse
        foreach ($collection->getReverseIterator() as $item) {
            $result['reverse'][] = $item;
        }

        return $result;
    }

    public function getFormattedOutput(WordsCollection $collection): string
    {
        $output = "Straight traversal:\n";
        foreach ($collection->getIterator() as $item) {
            $output .= $item . "\n";
        }

        $output .= "\nReverse traversal:\n";
        foreach ($collection->getReverseIterator() as $item) {
            $output .= $item . "\n";
        }

        return $output;
    }
}
