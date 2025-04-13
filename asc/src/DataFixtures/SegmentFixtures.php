<?php
// src/DataFixtures/SegmentFixtures.php

namespace App\DataFixtures;

use App\Entity\Filiere;
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
            ['id' => 1, 'filiere_id' => 1, 'nomSegment' => 'A', 'longeur' => 130.00, 'pasEmplacement' => 10.0],
            ['id' => 2, 'filiere_id' => 1, 'nomSegment' => 'B', 'longeur' => 125.00, 'pasEmplacement' => 10.0],
            ['id' => 3, 'filiere_id' => 2, 'nomSegment' => 'A', 'longeur' => 125.00, 'pasEmplacement' => 10.0],
            ['id' => 4, 'filiere_id' => 2, 'nomSegment' => 'B', 'longeur' => 125.00, 'pasEmplacement' => 10.0],
            ['id' => 5, 'filiere_id' => 3, 'nomSegment' => 'A', 'longeur' => 125.00, 'pasEmplacement' => 10.0],
            ['id' => 6, 'filiere_id' => 3, 'nomSegment' => 'B', 'longeur' => 125.00, 'pasEmplacement' => 10.0],
            ['id' => 7, 'filiere_id' => 3, 'nomSegment' => 'C', 'longeur' => 125.00, 'pasEmplacement' => 10.0],
            ['id' => 8, 'filiere_id' => 4, 'nomSegment' => 'A', 'longeur' => 125.00, 'pasEmplacement' => 10.0],
            ['id' => 9, 'filiere_id' => 4, 'nomSegment' => 'B', 'longeur' => 125.00, 'pasEmplacement' => 10.0],
            ['id' => 10, 'filiere_id' => 4, 'nomSegment' => 'C', 'longeur' => 125.00, 'pasEmplacement' => 10.0],
            ['id' => 11, 'filiere_id' => 5, 'nomSegment' => 'A', 'longeur' => 30.00, 'pasEmplacement' => 10.0],
            ['id' => 12, 'filiere_id' => 5, 'nomSegment' => 'B', 'longeur' => 30.00, 'pasEmplacement' => 10.0],
            ['id' => 13, 'filiere_id' => 5, 'nomSegment' => 'C', 'longeur' => 30.00, 'pasEmplacement' => 10.0],
            ['id' => 14, 'filiere_id' => 5, 'nomSegment' => 'D', 'longeur' => 30.00, 'pasEmplacement' => 10.0],
            ['id' => 15, 'filiere_id' => 5, 'nomSegment' => 'E', 'longeur' => 30.00, 'pasEmplacement' => 10.0],
            ['id' => 16, 'filiere_id' => 5, 'nomSegment' => 'F', 'longeur' => 30.00, 'pasEmplacement' => 10.0],
            ['id' => 17, 'filiere_id' => 5, 'nomSegment' => 'G', 'longeur' => 30.00, 'pasEmplacement' => 10.0],
            ['id' => 18, 'filiere_id' => 5, 'nomSegment' => 'H', 'longeur' => 30.00, 'pasEmplacement' => 10.0],
            ['id' => 19, 'filiere_id' => 5, 'nomSegment' => 'I', 'longeur' => 30.00, 'pasEmplacement' => 10.0],
            ['id' => 20, 'filiere_id' => 5, 'nomSegment' => 'J', 'longeur' => 30.00, 'pasEmplacement' => 10.0],
            ['id' => 21, 'filiere_id' => 5, 'nomSegment' => 'K', 'longeur' => 30.00, 'pasEmplacement' => 10.0],
            ['id' => 22, 'filiere_id' => 6, 'nomSegment' => 'A', 'longeur' => 125.00, 'pasEmplacement' => 10.0],
            ['id' => 23, 'filiere_id' => 6, 'nomSegment' => 'B', 'longeur' => 125.00, 'pasEmplacement' => 10.0],
            ['id' => 24, 'filiere_id' => 6, 'nomSegment' => 'C', 'longeur' => 125.00, 'pasEmplacement' => 10.0],
            ['id' => 25, 'filiere_id' => 7, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 26, 'filiere_id' => 7, 'nomSegment' => 'B', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 27, 'filiere_id' => 8, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 28, 'filiere_id' => 8, 'nomSegment' => 'B', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 29, 'filiere_id' => 8, 'nomSegment' => 'C', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 30, 'filiere_id' => 9, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 31, 'filiere_id' => 9, 'nomSegment' => 'B', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 32, 'filiere_id' => 10, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 33, 'filiere_id' => 10, 'nomSegment' => 'B', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 34, 'filiere_id' => 10, 'nomSegment' => 'C', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 35, 'filiere_id' => 11, 'nomSegment' => 'A', 'longeur' => 250.00, 'pasEmplacement' => 10.0],
            ['id' => 36, 'filiere_id' => 12, 'nomSegment' => 'A', 'longeur' => 125.00, 'pasEmplacement' => 10.0],
            ['id' => 37, 'filiere_id' => 12, 'nomSegment' => 'B', 'longeur' => 125.00, 'pasEmplacement' => 10.0],
            ['id' => 38, 'filiere_id' => 12, 'nomSegment' => 'C', 'longeur' => 125.00, 'pasEmplacement' => 10.0],
            ['id' => 39, 'filiere_id' => 13, 'nomSegment' => 'A', 'longeur' => 125.00, 'pasEmplacement' => 10.0],
            ['id' => 40, 'filiere_id' => 13, 'nomSegment' => 'B', 'longeur' => 125.00, 'pasEmplacement' => 10.0],
            ['id' => 41, 'filiere_id' => 14, 'nomSegment' => 'A', 'longeur' => 130.00, 'pasEmplacement' => 10.0],
            ['id' => 42, 'filiere_id' => 14, 'nomSegment' => 'B', 'longeur' => 150.00, 'pasEmplacement' => 10.0],
            ['id' => 43, 'filiere_id' => 14, 'nomSegment' => 'C', 'longeur' => 150.00, 'pasEmplacement' => 10.0],
            ['id' => 44, 'filiere_id' => 15, 'nomSegment' => 'A', 'longeur' => 200.00, 'pasEmplacement' => 10.0],
            ['id' => 45, 'filiere_id' => 15, 'nomSegment' => 'B', 'longeur' => 125.00, 'pasEmplacement' => 10.0],
            ['id' => 46, 'filiere_id' => 16, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 47, 'filiere_id' => 16, 'nomSegment' => 'B', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 48, 'filiere_id' => 16, 'nomSegment' => 'C', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 49, 'filiere_id' => 17, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 50, 'filiere_id' => 17, 'nomSegment' => 'B', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 51, 'filiere_id' => 18, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 52, 'filiere_id' => 18, 'nomSegment' => 'B', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 53, 'filiere_id' => 18, 'nomSegment' => 'C', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 54, 'filiere_id' => 19, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 55, 'filiere_id' => 19, 'nomSegment' => 'B', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 56, 'filiere_id' => 19, 'nomSegment' => 'C', 'longeur' => 125.00, 'pasEmplacement' => 10.0],
            ['id' => 57, 'filiere_id' => 20, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 58, 'filiere_id' => 20, 'nomSegment' => 'B', 'longeur' => 125.00, 'pasEmplacement' => 10.0],
            ['id' => 59, 'filiere_id' => 11, 'nomSegment' => 'B', 'longeur' => 250.00, 'pasEmplacement' => 10.0],
            ['id' => 60, 'filiere_id' => 21, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 61, 'filiere_id' => 22, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 62, 'filiere_id' => 23, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 63, 'filiere_id' => 24, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 64, 'filiere_id' => 25, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 65, 'filiere_id' => 26, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 66, 'filiere_id' => 27, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 67, 'filiere_id' => 28, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 68, 'filiere_id' => 29, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 70, 'filiere_id' => 31, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 71, 'filiere_id' => 32, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 72, 'filiere_id' => 33, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 73, 'filiere_id' => 35, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 74, 'filiere_id' => 36, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 75, 'filiere_id' => 37, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 76, 'filiere_id' => 38, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 77, 'filiere_id' => 39, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 78, 'filiere_id' => 40, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 79, 'filiere_id' => 41, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 80, 'filiere_id' => 42, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 81, 'filiere_id' => 43, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 82, 'filiere_id' => 44, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 83, 'filiere_id' => 45, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 84, 'filiere_id' => 46, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 85, 'filiere_id' => 47, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 86, 'filiere_id' => 48, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 87, 'filiere_id' => 49, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 89, 'filiere_id' => 51, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 90, 'filiere_id' => 52, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 92, 'filiere_id' => 54, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 94, 'filiere_id' => 56, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 95, 'filiere_id' => 57, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 96, 'filiere_id' => 58, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 97, 'filiere_id' => 59, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 98, 'filiere_id' => 60, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 99, 'filiere_id' => 61, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 100, 'filiere_id' => 62, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 101, 'filiere_id' => 63, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 102, 'filiere_id' => 64, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 103, 'filiere_id' => 65, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 104, 'filiere_id' => 34, 'nomSegment' => 'A', 'longeur' => 15.00, 'pasEmplacement' => 10.0],
            ['id' => 105, 'filiere_id' => 66, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 106, 'filiere_id' => 67, 'nomSegment' => 'A', 'longeur' => 70.00, 'pasEmplacement' => 10.0],
            ['id' => 107, 'filiere_id' => 67, 'nomSegment' => 'B', 'longeur' => 70.00, 'pasEmplacement' => 10.0],
            ['id' => 108, 'filiere_id' => 73, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 109, 'filiere_id' => 73, 'nomSegment' => 'B', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 110, 'filiere_id' => 74, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 111, 'filiere_id' => 74, 'nomSegment' => 'B', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 112, 'filiere_id' => 75, 'nomSegment' => 'A', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 113, 'filiere_id' => 75, 'nomSegment' => 'B', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
            ['id' => 114, 'filiere_id' => 75, 'nomSegment' => 'C', 'longeur' => 100.00, 'pasEmplacement' => 10.0],
        ];

        // Créer et persister les objets Segment
        foreach ($segmentsData as $data) {
            $segment = new Segment();
            $segment->setNomSegment($data['nomSegment']);
            $segment->setLongeur($data['longeur']);
            $segment->setPasEmplacement($data['pasEmplacement']);

            // Associer le segment à la filière correspondante
            $filiere = $this->getReference('filiere_' . $data['filiere_id'], Filiere::class);
            $segment->setFiliere($filiere);

            $manager->persist($segment);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            FiliereFixtures::class, // Dépend de FiliereFixtures pour s'assurer que les filières existent
        ];
    }
}
