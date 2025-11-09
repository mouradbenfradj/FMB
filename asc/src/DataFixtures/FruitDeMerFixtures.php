<?php

namespace App\DataFixtures;

use App\Entity\FruitDeMer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FruitDeMerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $fruitsDeMerData = [
            ['nom' => 'Huîtres Creuses'],
            ['nom' => 'Moules de Bouchot'],
            ['nom' => 'Coquilles Saint-Jacques'],
            ['nom' => 'Bulots'],
            ['nom' => 'Crevettes Grises'],
            // Ajoutez d'autres si nécessaire
        ];

        foreach ($fruitsDeMerData as $i => $data) {
            $fruitDeMer = new FruitDeMer();
            $fruitDeMer->setNom($data['nom']);

            $manager->persist($fruitDeMer);
            $this->addReference('fruitdemer_' . ($i + 1), $fruitDeMer);
        }

        $manager->flush();
    }
}
