<?php

namespace App\DataFixtures;

use App\Entity\Phase;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PhaseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $phasesData = [
            ['nomPhase' => 'PRE-GROSSISSEMENT-NAISS HUITRES', 'ref' => 'phase_pre_gross_huitres'],
            ['nomPhase' => 'GROSSISSEMENT-HUITRES', 'ref' => 'phase_grossissement_huitres'],
            ['nomPhase' => 'HUITRES COMMERCIALES', 'ref' => 'phase_commerciales_huitres'],
            ['nomPhase' => 'HUITRES COMMERCIALES-Hors Normes', 'ref' => 'phase_commerciales_hors_normes'],
            ['nomPhase' => 'PRE-GROSSISSEMENT-NAISS MOULES', 'ref' => 'phase_pre_gross_moules'],
            ['nomPhase' => 'GROSSISSEMENT-MOULES', 'ref' => 'phase_grossissement_moules'],
            ['nomPhase' => 'MOULES COMMERCIALES', 'ref' => 'phase_commerciales_moules'],
        ];

        foreach ($phasesData as $data) {
            $phase = new Phase();
            $phase->setNomPhase($data['nomPhase']);

            $manager->persist($phase);
            $this->addReference($data['ref'], $phase);
        }

        $manager->flush();
    }
}
