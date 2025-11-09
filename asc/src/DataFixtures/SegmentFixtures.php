<?php
// src/DataFixtures/SegmentFixtures.php

namespace App\DataFixtures;

use App\Entity\Filiere;
use App\Entity\Flotteur;
use App\Entity\FlotteurSegment;
use App\Entity\Segment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SegmentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Données des segments (toutes les données fournies)
        $segmentsData = [
            ['filiere_id' => 1, 'nomSegment' => 'A', 'longeur' => 130.00, 'pasEmplacement' => 1],
            ['filiere_id' => 1, 'nomSegment' => 'B', 'longeur' => 125.00, 'pasEmplacement' => 1],
            ['filiere_id' => 2, 'nomSegment' => 'A', 'longeur' => 125.00, 'pasEmplacement' => 1],
            ['filiere_id' => 2, 'nomSegment' => 'B', 'longeur' => 125.00, 'pasEmplacement' => 1],
            ['filiere_id' => 3, 'nomSegment' => 'A', 'longeur' => 125.00, 'pasEmplacement' => 1],
            ['filiere_id' => 3, 'nomSegment' => 'B', 'longeur' => 125.00, 'pasEmplacement' => 1],
            ['filiere_id' => 3, 'nomSegment' => 'C', 'longeur' => 125.00, 'pasEmplacement' => 1],
            ['filiere_id' => 4, 'nomSegment' => 'A', 'longeur' => 125.00, 'pasEmplacement' => 1],
            ['filiere_id' => 4, 'nomSegment' => 'B', 'longeur' => 125.00, 'pasEmplacement' => 1],
            ['filiere_id' => 4, 'nomSegment' => 'C', 'longeur' => 125.00, 'pasEmplacement' => 1],
            ['filiere_id' => 5, 'nomSegment' => 'A', 'longeur' => 30.00, 'pasEmplacement' => 1],
            ['filiere_id' => 5, 'nomSegment' => 'B', 'longeur' => 30.00, 'pasEmplacement' => 1],
            ['filiere_id' => 5, 'nomSegment' => 'C', 'longeur' => 30.00, 'pasEmplacement' => 1],
            ['filiere_id' => 5, 'nomSegment' => 'D', 'longeur' => 30.00, 'pasEmplacement' => 1],
            ['filiere_id' => 5, 'nomSegment' => 'E', 'longeur' => 30.00, 'pasEmplacement' => 1],
            ['filiere_id' => 5, 'nomSegment' => 'F', 'longeur' => 30.00, 'pasEmplacement' => 1],
            ['filiere_id' => 5, 'nomSegment' => 'G', 'longeur' => 30.00, 'pasEmplacement' => 1],
            ['filiere_id' => 5, 'nomSegment' => 'H', 'longeur' => 30.00, 'pasEmplacement' => 1],
            ['filiere_id' => 5, 'nomSegment' => 'I', 'longeur' => 30.00, 'pasEmplacement' => 1],
            ['filiere_id' => 5, 'nomSegment' => 'J', 'longeur' => 30.00, 'pasEmplacement' => 1],
            ['filiere_id' => 5, 'nomSegment' => 'K', 'longeur' => 30.00, 'pasEmplacement' => 1],
            ['filiere_id' => 6, 'nomSegment' => 'A', 'longeur' => 125.00, 'pasEmplacement' => 1],
            ['filiere_id' => 6, 'nomSegment' => 'B', 'longeur' => 125.00, 'pasEmplacement' => 1],
            ['filiere_id' => 6, 'nomSegment' => 'C', 'longeur' => 125.00, 'pasEmplacement' => 1],
            ['filiere_id' => 7, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 7, 'nomSegment' => 'B', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 8, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 8, 'nomSegment' => 'B', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 8, 'nomSegment' => 'C', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 9, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 9, 'nomSegment' => 'B', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 10, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 10, 'nomSegment' => 'B', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 10, 'nomSegment' => 'C', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 11, 'nomSegment' => 'A', 'longeur' => 250.00, 'pasEmplacement' => 1],
            ['filiere_id' => 12, 'nomSegment' => 'A', 'longeur' => 125.00, 'pasEmplacement' => 1],
            ['filiere_id' => 12, 'nomSegment' => 'B', 'longeur' => 125.00, 'pasEmplacement' => 1],
            ['filiere_id' => 12, 'nomSegment' => 'C', 'longeur' => 125.00, 'pasEmplacement' => 1],
            ['filiere_id' => 13, 'nomSegment' => 'A', 'longeur' => 125.00, 'pasEmplacement' => 1],
            ['filiere_id' => 13, 'nomSegment' => 'B', 'longeur' => 125.00, 'pasEmplacement' => 1],
            ['filiere_id' => 14, 'nomSegment' => 'A', 'longeur' => 130.00, 'pasEmplacement' => 1],
            ['filiere_id' => 14, 'nomSegment' => 'B', 'longeur' => 150.00, 'pasEmplacement' => 1],
            ['filiere_id' => 14, 'nomSegment' => 'C', 'longeur' => 150.00, 'pasEmplacement' => 1],
            ['filiere_id' => 15, 'nomSegment' => 'A', 'longeur' => 200.00, 'pasEmplacement' => 1],
            ['filiere_id' => 15, 'nomSegment' => 'B', 'longeur' => 125.00, 'pasEmplacement' => 1],
            ['filiere_id' => 16, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 16, 'nomSegment' => 'B', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 16, 'nomSegment' => 'C', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 17, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 17, 'nomSegment' => 'B', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 18, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 18, 'nomSegment' => 'B', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 18, 'nomSegment' => 'C', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 19, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 19, 'nomSegment' => 'B', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 19, 'nomSegment' => 'C', 'longeur' => 125.00, 'pasEmplacement' => 1],
            ['filiere_id' => 20, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 20, 'nomSegment' => 'B', 'longeur' => 125.00, 'pasEmplacement' => 1],
            ['filiere_id' => 11, 'nomSegment' => 'B', 'longeur' => 250.00, 'pasEmplacement' => 1],
            ['filiere_id' => 21, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 22, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 23, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 24, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 25, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 26, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 27, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 28, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 29, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 31, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 32, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 33, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 35, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 36, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 37, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 38, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 39, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 40, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 41, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 42, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 43, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 44, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 45, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 46, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 47, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 48, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 49, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 51, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 52, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 54, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 56, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 57, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 58, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 59, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 60, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 61, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 62, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 63, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 64, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 65, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 34, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 1],
            ['filiere_id' => 66, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 67, 'nomSegment' => 'A', 'longeur' => 70.00, 'pasEmplacement' => 1],
            ['filiere_id' => 67, 'nomSegment' => 'B', 'longeur' => 70.00, 'pasEmplacement' => 1],
            ['filiere_id' => 73, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 73, 'nomSegment' => 'B', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 74, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 74, 'nomSegment' => 'B', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 75, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 75, 'nomSegment' => 'B', 'longeur' => 100.00, 'pasEmplacement' => 1],
            ['filiere_id' => 75, 'nomSegment' => 'C', 'longeur' => 100.00, 'pasEmplacement' => 1],
        ];

        // Configuration des flotteurs par segment
        $flotteursConfig = [
            // Pour les segments courts (15m) - MTH
            'short' => ['flotteur_index' => 2, 'nombre' => 5, 'distanceDeDepart' => 1.0, 'pasFlotteur' => 3.0],
            // Pour les segments moyens (30-100m)
            'medium' => ['flotteur_index' => 0, 'nombre' => 10, 'distanceDeDepart' => 2.0, 'pasFlotteur' => 10.0],
            // Pour les segments longs (125-150m)
            'long' => ['flotteur_index' => 1, 'nombre' => 15, 'distanceDeDepart' => 3.0, 'pasFlotteur' => 8.0],
            // Pour les segments très longs (200-250m)
            'xlong' => ['flotteur_index' => 3, 'nombre' => 25, 'distanceDeDepart' => 5.0, 'pasFlotteur' => 10.0],
        ];

        // Créer et persister les objets Segment
        foreach ($segmentsData as $index => $data) {
            $segment = new Segment();
            $segment->setNomSegment($data['nomSegment']);
            $segment->setLongeur($data['longeur']);
            $segment->setPasEmplacement($data['pasEmplacement']);

            // Associer le segment à la filière correspondante
            $filiere = $this->getReference('filiere_' . $data['filiere_id'], Filiere::class);
            $segment->setFiliere($filiere);

            $manager->persist($segment);

            // Flush pour déclencher le PrePersist et générer les emplacements
            $manager->flush();

            // Déterminer le type de segment basé sur la longueur
            if ($data['longeur'] <= 15) {
                $config = $flotteursConfig['short'];
            } elseif ($data['longeur'] <= 100) {
                $config = $flotteursConfig['medium'];
            } elseif ($data['longeur'] <= 150) {
                $config = $flotteursConfig['long'];
            } else {
                $config = $flotteursConfig['xlong'];
            }

            // Créer l'association FlotteurSegment
            $flotteurSegment = new FlotteurSegment();
            $flotteur = $this->getReference('flotteur_' . $config['flotteur_index'], Flotteur::class);
            $flotteurSegment->setFlotteur($flotteur);
            $flotteurSegment->setSegment($segment);
            $flotteurSegment->setNombre($config['nombre']);
            $flotteurSegment->setDistanceDeDepart($config['distanceDeDepart']);
            $flotteurSegment->setPasFlotteur($config['pasFlotteur']);

            $manager->persist($flotteurSegment);

            $this->addReference('segment_' . $index, $segment);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            FiliereFixtures::class,
            FlotteurFixtures::class,
        ];
    }
}
