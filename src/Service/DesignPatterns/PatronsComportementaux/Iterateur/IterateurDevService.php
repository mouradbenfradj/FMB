<?php

namespace App\Service\DesignPatterns\PatronsComportementaux\Iterateur;

use App\Service\DesignPatterns\PatronsComportementaux\Iterateur\WordsCollection;

class IterateurDevService
{
    public function runIterateur()
    {
        $collection = new WordsCollection();
        $collection->addItem("First");
        $collection->addItem("Second");
        $collection->addItem("Third");

        dump("Straight traversal:\n");
        foreach ($collection->getIterator() as $item) {
            dump($item . "\n");
        }

        dump("\n");
        dump("Reverse traversal:\n");
        foreach ($collection->getReverseIterator() as $item) {
            dump($item . "\n");
            /*      // Création d'une collection via le service
        $collection = $collectionService->createCollection([
            "First",
            "Second",
            "Third",
            "Apple",
            "Banana",
            "Cherry"
        ]);

        // Traitement de la collection
        $result = $collectionService->processCollection($collection);
        $formattedOutput = $collectionService->getFormattedOutput($collection); */
        }
    }
}
