<?php
// src/DataFixtures/FiliereFixtures.php

namespace App\DataFixtures;

use App\Entity\Filiere;
use App\Entity\Parc;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FiliereFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Données des filières
        $filieresData = [
            ['id' => 1, 'parc_id' => 1, 'nomFiliere' => 'F01', 'aireDeTravaille' => false, 'observation' => ['2017-05-01 17:50:58' => 'F14 & F1 : CH cimentage spécial']],
            ['id' => 2, 'parc_id' => 1, 'nomFiliere' => 'F02', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 3, 'parc_id' => 1, 'nomFiliere' => 'F03', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 4, 'parc_id' => 1, 'nomFiliere' => 'F07', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 5, 'parc_id' => 2, 'nomFiliere' => 'M01', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 6, 'parc_id' => 1, 'nomFiliere' => 'F09', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 7, 'parc_id' => 1, 'nomFiliere' => 'F14', 'aireDeTravaille' => false, 'observation' => ['2017-05-01 17:50:28' => 'F14 & F1 : CH cimentage spécial']],
            ['id' => 8, 'parc_id' => 1, 'nomFiliere' => 'F20', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 9, 'parc_id' => 1, 'nomFiliere' => 'F41', 'aireDeTravaille' => false, 'observation' => ['2017-07-31 15:56:46' => "Saisie en Segm1&2 mais segm2 n'existe pas"]],
            ['id' => 10, 'parc_id' => 1, 'nomFiliere' => 'F57', 'aireDeTravaille' => false, 'observation' => ['2016-12-26 20:38:19' => 'F57 ; cdes M / C: cdes CTA']],
            ['id' => 11, 'parc_id' => 1, 'nomFiliere' => 'AW', 'aireDeTravaille' => true, 'observation' => ['2017-12-28 09:55:00' => 'test']],
            ['id' => 12, 'parc_id' => 1, 'nomFiliere' => 'F04', 'aireDeTravaille' => false, 'observation' => ['2017-01-01 10:14:51' => 'Fin Segm.2 en B18']],
            ['id' => 13, 'parc_id' => 1, 'nomFiliere' => 'F08', 'aireDeTravaille' => false, 'observation' => ['2017-09-01 09:28:43' => 'F8/A = 28 BIDONS']],
            ['id' => 14, 'parc_id' => 1, 'nomFiliere' => 'F10', 'aireDeTravaille' => false, 'observation' => ['2017-05-15 19:22:25' => 'YOUSSEF 15mai17 : A16+B11+C31']],
            ['id' => 15, 'parc_id' => 1, 'nomFiliere' => 'F40', 'aireDeTravaille' => false, 'observation' => ['2017-07-11 12:32:02' => 'SEGT B : remplissage sens inverse (B0=fin segment)']],
            ['id' => 16, 'parc_id' => 1, 'nomFiliere' => 'F18', 'aireDeTravaille' => false, 'observation' => ['2017-10-19 21:00:56' => 'Htres cimentage spécial']],
            ['id' => 17, 'parc_id' => 1, 'nomFiliere' => 'F21', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 18, 'parc_id' => 1, 'nomFiliere' => 'F22', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 19, 'parc_id' => 1, 'nomFiliere' => 'F19', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 20, 'parc_id' => 1, 'nomFiliere' => 'F23', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 21, 'parc_id' => 1, 'nomFiliere' => 'MTH 1', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 22, 'parc_id' => 1, 'nomFiliere' => 'MTH 2', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 23, 'parc_id' => 1, 'nomFiliere' => 'MTH 3', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 24, 'parc_id' => 1, 'nomFiliere' => 'MTH 4', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 25, 'parc_id' => 1, 'nomFiliere' => 'MTH 5', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 26, 'parc_id' => 1, 'nomFiliere' => 'MTH 6', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 27, 'parc_id' => 1, 'nomFiliere' => 'MTH 7', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 28, 'parc_id' => 1, 'nomFiliere' => 'MTH 8', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 29, 'parc_id' => 1, 'nomFiliere' => 'MTH 9', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 31, 'parc_id' => 1, 'nomFiliere' => 'MTH 10', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 32, 'parc_id' => 1, 'nomFiliere' => 'MTH 11', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 33, 'parc_id' => 1, 'nomFiliere' => 'MTH 12', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 34, 'parc_id' => 1, 'nomFiliere' => 'MTH 13', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 35, 'parc_id' => 1, 'nomFiliere' => 'MTH 14', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 36, 'parc_id' => 1, 'nomFiliere' => 'MTH 15', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 37, 'parc_id' => 1, 'nomFiliere' => 'MTH 16', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 38, 'parc_id' => 1, 'nomFiliere' => 'MTH 17', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 39, 'parc_id' => 1, 'nomFiliere' => 'MTH 18', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 40, 'parc_id' => 1, 'nomFiliere' => 'MTH 19', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 41, 'parc_id' => 1, 'nomFiliere' => 'MTH 20', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 42, 'parc_id' => 1, 'nomFiliere' => 'MTH 21', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 43, 'parc_id' => 1, 'nomFiliere' => 'MTH 22', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 44, 'parc_id' => 1, 'nomFiliere' => 'MTH 23', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 45, 'parc_id' => 1, 'nomFiliere' => 'MTH 25', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 46, 'parc_id' => 1, 'nomFiliere' => 'MTH 26', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 47, 'parc_id' => 1, 'nomFiliere' => 'MTH 27', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 48, 'parc_id' => 1, 'nomFiliere' => 'MTH 28', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 49, 'parc_id' => 1, 'nomFiliere' => 'MTH 29', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 51, 'parc_id' => 1, 'nomFiliere' => 'MTH 30', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 52, 'parc_id' => 1, 'nomFiliere' => 'MTH 31', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 54, 'parc_id' => 1, 'nomFiliere' => 'MTH 24', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 56, 'parc_id' => 1, 'nomFiliere' => 'MTH 32', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 57, 'parc_id' => 1, 'nomFiliere' => 'MTH 33', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 58, 'parc_id' => 1, 'nomFiliere' => 'MTH 34', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 59, 'parc_id' => 1, 'nomFiliere' => 'MTH 35', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 60, 'parc_id' => 1, 'nomFiliere' => 'MTH 36', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 61, 'parc_id' => 1, 'nomFiliere' => 'MTH 37', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 62, 'parc_id' => 1, 'nomFiliere' => 'MTH 38', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 63, 'parc_id' => 1, 'nomFiliere' => 'MTH 39', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 64, 'parc_id' => 1, 'nomFiliere' => 'MTH 40', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 65, 'parc_id' => 1, 'nomFiliere' => 'MTH 41', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 66, 'parc_id' => 1, 'nomFiliere' => 'F58', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 67, 'parc_id' => 1, 'nomFiliere' => 'F17', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 68, 'parc_id' => 1, 'nomFiliere' => 'F14', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 69, 'parc_id' => 1, 'nomFiliere' => 'F14', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 70, 'parc_id' => 1, 'nomFiliere' => 'F14', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 71, 'parc_id' => 1, 'nomFiliere' => 'F14', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 72, 'parc_id' => 1, 'nomFiliere' => 'F14', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 73, 'parc_id' => 1, 'nomFiliere' => 'F88Garage', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 74, 'parc_id' => 1, 'nomFiliere' => 'F0', 'aireDeTravaille' => false, 'observation' => []],
            ['id' => 75, 'parc_id' => 1, 'nomFiliere' => 'F12', 'aireDeTravaille' => false, 'observation' => []],
        ];

        // Créer et persister les objets Filiere
        foreach ($filieresData as $data) {
            $filiere = new Filiere();
            $filiere->setNomFiliere($data['nomFiliere']);
            $filiere->setAireDeTravaille($data['aireDeTravaille']);
            $filiere->setObservation($data['observation']);

            // Associer la filière au parc correspondant
            $parc = $this->getReference('parc_' . $data['parc_id'], Parc::class);
            $filiere->setParc($parc);

            $manager->persist($filiere);

            // Ajouter une référence pour pouvoir récupérer cette filière dans d'autres fixtures
            $this->addReference('filiere_' . $data['id'], $filiere);
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
