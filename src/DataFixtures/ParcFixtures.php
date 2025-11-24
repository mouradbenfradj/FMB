<?php

namespace App\DataFixtures;

use App\Entity\Parc;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ParcFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Données statiques pour les parcs
        $parcsData = [
            ['id' => 1, 'libParc' => 'Ferme TAC1', 'abrevParc' => 'TAC1'],
            ['id' => 2, 'libParc' => 'Ferme TAC2', 'abrevParc' => 'TAC2'],
            ['id' => 3, 'libParc' => 'TAC STATION', 'abrevParc' => 'STATION'],
        ];

        // Créer et persister les objets Parc
        foreach ($parcsData as $data) {
            $parc = new Parc();
            $parc->setLibParc($data['libParc']);
            $parc->setAbrevParc($data['abrevParc']);

            $manager->persist($parc);
            $this->addReference('parc_' . $data['id'], $parc);
        }

        // Enregistrer les objets en base de données
        $manager->flush();
    }
}
