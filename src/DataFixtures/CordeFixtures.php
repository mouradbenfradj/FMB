<?php

namespace App\DataFixtures;

use App\Entity\Corde;
use App\Entity\FruitDeMer;
use App\Entity\Parc;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CordeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Données statiques pour les cordes
        $cordesData = [
            // Cordes pour TAC1
            [
                'parc_ref' => 'parc_1',
                'nom' => 'Corde Moules - Polyéthylène',
                'longueur' => 25.50,
                'quantite' => 15,
                'fruit_ref' => 'fruitdemer_2' // Moule est le 2ème dans FruitDeMerFixtures
            ],
            [
                'parc_ref' => 'parc_1',
                'nom' => 'Corde Huîtres - Nylon',
                'longueur' => 18.75,
                'quantite' => 8,
                'fruit_ref' => 'fruitdemer_1' // Huître est le 1er dans FruitDeMerFixtures
            ],
            // Cordes pour TAC2
            [
                'parc_ref' => 'parc_2',
                'nom' => 'Corde Moules - Polyéthylène',
                'longueur' => 28.25,
                'quantite' => 20,
                'fruit_ref' => 'fruitdemer_2'
            ],
            [
                'parc_ref' => 'parc_2',
                'nom' => 'Corde Huîtres - Acier galvanisé',
                'longueur' => 15.50,
                'quantite' => 6,
                'fruit_ref' => 'fruitdemer_1'
            ],
            // Cordes pour STATION
            [
                'parc_ref' => 'parc_3',
                'nom' => 'Corde Moules - Nylon',
                'longueur' => 35.75,
                'quantite' => 18,
                'fruit_ref' => 'fruitdemer_2'
            ],
        ];

        foreach ($cordesData as $i => $data) {
            $corde = new Corde();

            $corde->setNom($data['nom']);
            $corde->setLongeur($data['longueur']);
            $corde->setquantite($data['quantite']);

            // Association avec le parc
            $parc = $this->getReference($data['parc_ref'], Parc::class);
            $corde->setParc($parc);

            // Association avec FruitDeMer
            if (isset($data['fruit_ref'])) {
                /** @var FruitDeMer $fruitDeMer */
                $fruitDeMer = $this->getReference($data['fruit_ref'], FruitDeMer::class);
                $corde->setFruitDeMer($fruitDeMer);
            }

            $manager->persist($corde);
            $this->addReference("corde_" . ($i + 1), $corde);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ParcFixtures::class,
            FruitDeMerFixtures::class,
        ];
    }
}
