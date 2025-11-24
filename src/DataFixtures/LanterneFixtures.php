<?php

namespace App\DataFixtures;

use App\Entity\Lanterne;
use App\Entity\Parc;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LanterneFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $lanternesData = [
            ['nomLanterne' => 'Lanterne A1', 'nbrPoche' => 50, 'nbrEnStock' => 10, 'parc_ref' => 'parc_1'],
            ['nomLanterne' => 'Lanterne A2', 'nbrPoche' => 50, 'nbrEnStock' => 8, 'parc_ref' => 'parc_1'],
            ['nomLanterne' => 'Lanterne B1', 'nbrPoche' => 40, 'nbrEnStock' => 12, 'parc_ref' => 'parc_2'],
            ['nomLanterne' => 'Lanterne B2', 'nbrPoche' => 40, 'nbrEnStock' => 15, 'parc_ref' => 'parc_2'],
            ['nomLanterne' => 'Lanterne C1', 'nbrPoche' => 60, 'nbrEnStock' => 5, 'parc_ref' => 'parc_3'],
        ];

        foreach ($lanternesData as $i => $data) {
            $lanterne = new Lanterne();
            $lanterne->setNomLanterne($data['nomLanterne']);
            $lanterne->setNbrPoche($data['nbrPoche']);
            $lanterne->setNbrEnStock($data['nbrEnStock']);

            /** @var Parc $parc */
            $parc = $this->getReference($data['parc_ref'], Parc::class);
            $lanterne->setParc($parc);

            $manager->persist($lanterne);
            $this->addReference('lanterne_' . ($i + 1), $lanterne);
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
