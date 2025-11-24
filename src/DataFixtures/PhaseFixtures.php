<?php

namespace App\DataFixtures;

use App\Entity\Phase;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PhaseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $phasesData = [
            ['nomPhase' => 'Préparation'],
            ['nomPhase' => 'Culture'],
            ['nomPhase' => 'Récolte'],
            ['nomPhase' => 'Conditionnement'],
        ];

        foreach ($phasesData as $i => $data) {
            $phase = new Phase();
            $phase->setNomPhase($data['nomPhase']);

            $manager->persist($phase);
            $this->addReference('phase_' . ($i + 1), $phase);
        }

        $manager->flush();
    }
}
