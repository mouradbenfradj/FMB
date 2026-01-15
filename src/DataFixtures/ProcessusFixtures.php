<?php

namespace App\DataFixtures;

use App\Entity\Phase;
use App\Entity\Processus;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProcessusFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Data from Excel file "Matrice croiss M&H janv 25 v6.xlsx" - HUITRES and MOULES sheets
        $processusData = [
            // HUITRES
            ['nomProcessus' => 'NH+1', 'age' => 0, 'phase_ref' => 'phase_pre_gross_huitres'],
            ['nomProcessus' => 'NH+2', 'age' => 1, 'phase_ref' => 'phase_pre_gross_huitres'],
            ['nomProcessus' => 'NH+3', 'age' => 2, 'phase_ref' => 'phase_pre_gross_huitres'],
            ['nomProcessus' => 'GH+1', 'age' => 3, 'phase_ref' => 'phase_grossissement_huitres'],
            ['nomProcessus' => 'GH+2', 'age' => 4, 'phase_ref' => 'phase_grossissement_huitres'],
            ['nomProcessus' => 'GH+3', 'age' => 5, 'phase_ref' => 'phase_grossissement_huitres'],
            ['nomProcessus' => 'H5', 'age' => 6, 'phase_ref' => 'phase_commerciales_huitres'],
            ['nomProcessus' => 'H4', 'age' => 7, 'phase_ref' => 'phase_commerciales_huitres'],
            ['nomProcessus' => 'H3', 'age' => 8, 'phase_ref' => 'phase_commerciales_huitres'],
            ['nomProcessus' => 'H2', 'age' => 9, 'phase_ref' => 'phase_commerciales_huitres'],
            ['nomProcessus' => 'H1', 'age' => 10, 'phase_ref' => 'phase_commerciales_huitres'],
            ['nomProcessus' => 'H0', 'age' => 11, 'phase_ref' => 'phase_commerciales_huitres'],
            ['nomProcessus' => 'H00', 'age' => 12, 'phase_ref' => 'phase_commerciales_huitres'],
            ['nomProcessus' => 'H000', 'age' => 13, 'phase_ref' => 'phase_commerciales_huitres'],
            ['nomProcessus' => 'H000+1', 'age' => 14, 'phase_ref' => 'phase_commerciales_hors_normes'],
            ['nomProcessus' => 'H000+2', 'age' => 15, 'phase_ref' => 'phase_commerciales_hors_normes'],
            ['nomProcessus' => 'H000+3', 'age' => 16, 'phase_ref' => 'phase_commerciales_hors_normes'],
            ['nomProcessus' => 'H000+4', 'age' => 17, 'phase_ref' => 'phase_commerciales_hors_normes'],
            ['nomProcessus' => 'H000+5', 'age' => 18, 'phase_ref' => 'phase_commerciales_hors_normes'],
            ['nomProcessus' => 'H000+6', 'age' => 19, 'phase_ref' => 'phase_commerciales_hors_normes'],
            ['nomProcessus' => 'H000+7', 'age' => 20, 'phase_ref' => 'phase_commerciales_hors_normes'],
            // MOULES
            ['nomProcessus' => 'CNM-M0', 'age' => 0, 'phase_ref' => 'phase_pre_gross_moules'],
            ['nomProcessus' => 'CNM+1', 'age' => 1, 'phase_ref' => 'phase_pre_gross_moules'],
            ['nomProcessus' => 'CNM+2', 'age' => 2, 'phase_ref' => 'phase_pre_gross_moules'],
            ['nomProcessus' => 'CNM+3', 'age' => 3, 'phase_ref' => 'phase_pre_gross_moules'],
            ['nomProcessus' => 'CNM+4', 'age' => 4, 'phase_ref' => 'phase_pre_gross_moules'],
            ['nomProcessus' => 'GM1', 'age' => 5, 'phase_ref' => 'phase_grossissement_moules'],
            ['nomProcessus' => 'GM2', 'age' => 6, 'phase_ref' => 'phase_grossissement_moules'],
            ['nomProcessus' => 'GM3', 'age' => 7, 'phase_ref' => 'phase_grossissement_moules'],
            ['nomProcessus' => 'GM4', 'age' => 8, 'phase_ref' => 'phase_grossissement_moules'],
            ['nomProcessus' => 'GM5', 'age' => 9, 'phase_ref' => 'phase_grossissement_moules'],
            ['nomProcessus' => 'GM6', 'age' => 10, 'phase_ref' => 'phase_grossissement_moules'],
            ['nomProcessus' => 'GM7', 'age' => 11, 'phase_ref' => 'phase_grossissement_moules'],
            ['nomProcessus' => 'GM8', 'age' => 12, 'phase_ref' => 'phase_grossissement_moules'],
            ['nomProcessus' => 'GM9', 'age' => 13, 'phase_ref' => 'phase_grossissement_moules'],
            ['nomProcessus' => 'GM10', 'age' => 14, 'phase_ref' => 'phase_grossissement_moules'],
            ['nomProcessus' => 'MS +1', 'age' => 15, 'phase_ref' => 'phase_commerciales_moules'],
            ['nomProcessus' => 'MS +2', 'age' => 16, 'phase_ref' => 'phase_commerciales_moules'],
            ['nomProcessus' => 'MS +3', 'age' => 17, 'phase_ref' => 'phase_commerciales_moules'],
            ['nomProcessus' => 'ME+1', 'age' => 18, 'phase_ref' => 'phase_commerciales_moules'],
            ['nomProcessus' => 'ME+2', 'age' => 19, 'phase_ref' => 'phase_commerciales_moules'],
            ['nomProcessus' => 'ME+3', 'age' => 20, 'phase_ref' => 'phase_commerciales_moules'],
            ['nomProcessus' => 'MR+1', 'age' => 21, 'phase_ref' => 'phase_commerciales_moules'],
            ['nomProcessus' => 'MR+2', 'age' => 22, 'phase_ref' => 'phase_commerciales_moules'],
            ['nomProcessus' => 'MR+3+', 'age' => 23, 'phase_ref' => 'phase_commerciales_moules'],
        ];

        foreach ($processusData as $i => $data) {
            $processus = new Processus();
            $processus->setNomProcessus($data['nomProcessus']);
            $processus->setAge($data['age']);

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
