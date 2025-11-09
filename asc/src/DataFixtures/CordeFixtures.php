<?php

namespace App\DataFixtures;

use App\Entity\Corde;
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
                'nom' => 'Corde principale - Polyéthylène',
                'longueur' => 25.50,
                'quantite' => 15
            ],
            [
                'parc_ref' => 'parc_1',
                'nom' => 'Corde de suspension - Nylon',
                'longueur' => 18.75,
                'quantite' => 8
            ],
            // Cordes pour TAC2
            [
                'parc_ref' => 'parc_2',
                'nom' => 'Corde principale - Polyéthylène',
                'longueur' => 28.25,
                'quantite' => 20
            ],
            [
                'parc_ref' => 'parc_2',
                'nom' => 'Corde de fixation - Acier galvanisé',
                'longueur' => 15.50,
                'quantite' => 6
            ],
            // Cordes pour STATION
            [
                'parc_ref' => 'parc_3',
                'nom' => 'Corde porteuse - Nylon',
                'longueur' => 35.75,
                'quantite' => 18
            ],
        ];

        foreach ($cordesData as $i => $data) {
            $corde = new Corde();

            $corde->setNom($data['nom']);
            $corde->setLongeur($data['longueur']);
            $corde->setQuantiter($data['quantite']);

            // Association avec le parc
            $parc = $this->getReference($data['parc_ref'], Parc::class);
            $corde->setParc($parc);

            $manager->persist($corde);
            $this->addReference("corde_" . ($i + 1), $corde);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ParcFixtures::class,
        ];
    }
}
