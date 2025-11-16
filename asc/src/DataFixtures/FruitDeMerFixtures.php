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
            ['nom' => 'Huître', 'ref' => 'huitre'],
            ['nom' => 'Moule', 'ref' => 'moule'],
            ['nom' => 'Coquille Saint-Jacques', 'ref' => 'coquille'],
            ['nom' => 'Bulot', 'ref' => 'bulot'],
            ['nom' => 'Crevette Grise', 'ref' => 'crevette'],
        ];

        foreach ($fruitsDeMerData as $i => $data) {
            $fruitDeMer = new FruitDeMer();
            $fruitDeMer->setNom($data['nom']);

            $manager->persist($fruitDeMer);
            $manager->flush(); // Flush immédiatement pour avoir un ID
            
            // Référence avec numéro pour compatibilité
            $this->addReference('fruitdemer_' . ($i + 1), $fruitDeMer);
            
            // Référence avec nom pour facilité d'utilisation
            if (isset($data['ref'])) {
                $this->addReference('fruitdemer_' . $data['ref'], $fruitDeMer);
            }
        }
    }
}
