<?php

namespace App\DataFixtures;

use App\Entity\Phase;
use App\Entity\Processus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProcessusFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $processusData = [
            ['nomProcessus' => 'Nettoyage des coquillages', 'phase_ref' => 'phase_1'],
            ['nomProcessus' => 'Tri des coquillages', 'phase_ref' => 'phase_1'],
            ['nomProcessus' => 'Implantation en mer', 'phase_ref' => 'phase_2'],
            ['nomProcessus' => 'Surveillance de croissance', 'phase_ref' => 'phase_2'],
            ['nomProcessus' => 'Récolte manuelle', 'phase_ref' => 'phase_3'],
            ['nomProcessus' => 'Transport vers l\'usine', 'phase_ref' => 'phase_3'],
            ['nomProcessus' => 'Calibration', 'phase_ref' => 'phase_4'],
            ['nomProcessus' => 'Emballage', 'phase_ref' => 'phase_4'],
        ];

        foreach ($processusData as $i => $data) {
            $processus = new Processus();
            $processus->setNomProcessus($data['nomProcessus']);

            /** @var Phase $phase */
            $phase = $this->getReference($data['phase_ref'], Phase::class);
            $processus->setPhase($phase);

            $manager->persist($processus);
            $this->addReference('processus_' . ($i + 1), $processus);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            PhaseFixtures::class,
        ];
    }
}
