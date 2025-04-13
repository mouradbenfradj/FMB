<?php

namespace App\DataFixtures;
// src/DataFixtures/StockFixtures.php

namespace App\DataFixtures;

use App\Entity\Parc;
use App\Entity\Stock;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class StockFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Données des stocks
        $stocksData = [
            ['id' => 1, 'libStock' => 'Stock Parc FMB', 'abrevStock' => 'SFMB', 'actif' => true, 'parc_id' => 1],
            ['id' => 2, 'libStock' => 'Stock Parc MARINOR', 'abrevStock' => 'SMAR', 'actif' => true, 'parc_id' => 2],
            ['id' => 3, 'libStock' => 'Stock FMB Station', 'abrevStock' => 'SFMBST', 'actif' => true, 'parc_id' => 3],
        ];

        // Créer et persister les objets Stock
        foreach ($stocksData as $data) {
            $stock = new Stock();
            $stock->setLibStock($data['libStock']);
            $stock->setAbrevStock($data['abrevStock']);
            $stock->setActif($data['actif']);

            // Associer le stock au parc correspondant
            $parc = $this->getReference('parc_' . $data['parc_id'], Parc::class);
            $stock->setParc($parc);

            $manager->persist($stock);

            // Ajouter une référence pour pouvoir récupérer ce stock dans d'autres fixtures
            $this->addReference('stock_' . $data['id'], $stock);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ParcFixtures::class, // Dépend de ParcFixtures pour s'assurer que les parcs existent
        ];
    }
}
