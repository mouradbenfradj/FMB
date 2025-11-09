<?php

namespace App\DataFixtures;

use App\Entity\Flotteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FlotteurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $flotteursData = [
            [
                'nom' => 'Flotteur Standard',
                'volume' => 10.5,
                'taux' => 0.75
            ],
            [
                'nom' => 'Flotteur Lourd',
                'volume' => 15.0,
                'taux' => 1.2
            ],
            [
                'nom' => 'Flotteur Léger',
                'volume' => 8.0,
                'taux' => 0.5
            ],
            [
                'nom' => 'Flotteur Professionnel',
                'volume' => 25.5,
                'taux' => 1.5
            ],
            [
                'nom' => 'Flotteur Compact',
                'volume' => 5.5,
                'taux' => 0.3
            ]
        ];

        foreach ($flotteursData as $index => $flotteurData) {
            $flotteur = new Flotteur();
            $flotteur->setNomFlotteur($flotteurData['nom']);
            $flotteur->setVolume($flotteurData['volume']);
            $flotteur->setTaux($flotteurData['taux']);
            
            // Le KGF sera calculé automatiquement par le lifecycle callback
            // calculerKgf() déclenché par PrePersist/PreUpdate
            
            $manager->persist($flotteur);
            $this->addReference('flotteur_' . $index, $flotteur);
        }

        $manager->flush();
    }
}