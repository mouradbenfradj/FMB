<?php

namespace App\DataFixtures;

use App\Entity\FruitDeMer;
use App\Entity\Phase;
use App\Entity\Processus;
use App\DataFixtures\FruitDeMerFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Fixtures pour les données de matrice de croissance
 * Issues du fichier Excel "Matrice croiss M&H janv 25 v6.xlsx"
 * 
 * Données HUITRES (Crassostrea gigas) - Lagune de Bizerte - TUNISIE
 * SURVIE: 97% constant
 * POIDS: 0.16g → 388g sur 20 mois
 * 
 * Données MOULES (Mytilus galloprovincialis)
 * SURVIE: 90% par étape
 * POIDS: 0.45g → 66.7g sur 23 mois
 */
class MatriceCroissanceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {


        // ============================================
        // 2. CRÉATION DES PHASES HUITRES
        // ============================================
        $phaseHuitrePreGross = new Phase();
        $phaseHuitrePreGross->setNomPhase('PRE-GROSSISSEMENT-NAISS HUITRES');
        $manager->persist($phaseHuitrePreGross);
        $this->addReference('phase_huitre_pre_gross', $phaseHuitrePreGross);

        $phaseHuitreGross = new Phase();
        $phaseHuitreGross->setNomPhase('GROSSISSEMENT-HUITRES');
        $manager->persist($phaseHuitreGross);
        $this->addReference('phase_huitre_gross', $phaseHuitreGross);

        $phaseHuitreComm = new Phase();
        $phaseHuitreComm->setNomPhase('HUITRES COMMERCIALES');
        $manager->persist($phaseHuitreComm);
        $this->addReference('phase_huitre_commerciale', $phaseHuitreComm);

        $phaseHuitreHorsNorme = new Phase();
        $phaseHuitreHorsNorme->setNomPhase('HUITRES COMMERCIALES-Hors Normes');
        $manager->persist($phaseHuitreHorsNorme);
        $this->addReference('phase_huitre_hors_norme', $phaseHuitreHorsNorme);

        // ============================================
        // 3. CRÉATION DES PHASES MOULES
        // ============================================
        $phaseMoulePreGross = new Phase();
        $phaseMoulePreGross->setNomPhase('PRE-GROSSISSEMENT-NAISS MOULES');
        $manager->persist($phaseMoulePreGross);
        $this->addReference('phase_moule_pre_gross', $phaseMoulePreGross);

        $phaseMouleGross = new Phase();
        $phaseMouleGross->setNomPhase('GROSSISSEMENT-MOULES');
        $manager->persist($phaseMouleGross);
        $this->addReference('phase_moule_gross', $phaseMouleGross);

        $phaseMouleComm = new Phase();
        $phaseMouleComm->setNomPhase('MOULES COMMERCIALES');
        $manager->persist($phaseMouleComm);
        $this->addReference('phase_moule_commerciale', $phaseMouleComm);

        $manager->flush();

        // ============================================
        // 4. CRÉATION DES PROCESSUS HUITRES
        // Données issues du CSV HUITRES
        // SURVIE: 97% | Ratio brut/net: 2.0
        // ============================================

        // Pré-grossissement (NH = Naissance Huitre)
        $processusHuitres = [
            ['nom' => 'NH+1', 'age' => 0, 'phase' => 'phase_huitre_pre_gross', 'poids_pce' => 0.16, 'survie' => 0.97, 'u_kg' => 6250],
            ['nom' => 'NH+2', 'age' => 1, 'phase' => 'phase_huitre_pre_gross', 'poids_pce' => 0.44, 'survie' => 0.97, 'u_kg' => 2273],
            ['nom' => 'NH+3', 'age' => 2, 'phase' => 'phase_huitre_pre_gross', 'poids_pce' => 1.22, 'survie' => 0.97, 'u_kg' => 820],
        ];

        // Grossissement (GH = Grossissement Huitre)
        $processusHuitres = array_merge($processusHuitres, [
            ['nom' => 'GH+1', 'age' => 3, 'phase' => 'phase_huitre_gross', 'poids_pce' => 3.34, 'survie' => 0.97, 'u_kg' => 299],
            ['nom' => 'GH+2', 'age' => 4, 'phase' => 'phase_huitre_gross', 'poids_pce' => 9.13, 'survie' => 0.97, 'u_kg' => 110],
            ['nom' => 'GH+3', 'age' => 5, 'phase' => 'phase_huitre_gross', 'poids_pce' => 25.00, 'survie' => 0.97, 'u_kg' => 40],
        ]);

        // Commerciales (H = Huitre commerciale)
        $processusHuitres = array_merge($processusHuitres, [
            ['nom' => 'H5', 'age' => 6, 'phase' => 'phase_huitre_commerciale', 'poids_pce' => 37.50, 'survie' => 0.97, 'u_kg' => 27],
            ['nom' => 'H4', 'age' => 7, 'phase' => 'phase_huitre_commerciale', 'poids_pce' => 55.50, 'survie' => 0.97, 'u_kg' => 18],
            ['nom' => 'H3', 'age' => 8, 'phase' => 'phase_huitre_commerciale', 'poids_pce' => 75.50, 'survie' => 0.97, 'u_kg' => 13],
            ['nom' => 'H2', 'age' => 9, 'phase' => 'phase_huitre_commerciale', 'poids_pce' => 103.00, 'survie' => 0.97, 'u_kg' => 10],
            ['nom' => 'H1', 'age' => 10, 'phase' => 'phase_huitre_commerciale', 'poids_pce' => 135.50, 'survie' => 0.97, 'u_kg' => 7],
            ['nom' => 'H0', 'age' => 11, 'phase' => 'phase_huitre_commerciale', 'poids_pce' => 163.00, 'survie' => 0.97, 'u_kg' => 6],
            ['nom' => 'H00', 'age' => 12, 'phase' => 'phase_huitre_commerciale', 'poids_pce' => 188.00, 'survie' => 0.97, 'u_kg' => 5],
            ['nom' => 'H000', 'age' => 13, 'phase' => 'phase_huitre_commerciale', 'poids_pce' => 213.00, 'survie' => 0.97, 'u_kg' => 5],
        ]);

        // Hors Normes
        $processusHuitres = array_merge($processusHuitres, [
            ['nom' => 'H000+1', 'age' => 14, 'phase' => 'phase_huitre_hors_norme', 'poids_pce' => 238.00, 'survie' => 0.97, 'u_kg' => 4],
            ['nom' => 'H000+2', 'age' => 15, 'phase' => 'phase_huitre_hors_norme', 'poids_pce' => 275.50, 'survie' => 0.97, 'u_kg' => 4],
            ['nom' => 'H000+3', 'age' => 16, 'phase' => 'phase_huitre_hors_norme', 'poids_pce' => 288.00, 'survie' => 0.97, 'u_kg' => 3],
            ['nom' => 'H000+4', 'age' => 17, 'phase' => 'phase_huitre_hors_norme', 'poids_pce' => 313.00, 'survie' => 0.97, 'u_kg' => 3],
            ['nom' => 'H000+5', 'age' => 18, 'phase' => 'phase_huitre_hors_norme', 'poids_pce' => 338.00, 'survie' => 0.97, 'u_kg' => 3],
            ['nom' => 'H000+6', 'age' => 19, 'phase' => 'phase_huitre_hors_norme', 'poids_pce' => 363.00, 'survie' => 0.97, 'u_kg' => 3],
            ['nom' => 'H000+7', 'age' => 20, 'phase' => 'phase_huitre_hors_norme', 'poids_pce' => 388.00, 'survie' => 0.97, 'u_kg' => 3],
        ]);

        // Sauvegarde des processus huitres
        foreach ($processusHuitres as $data) {
            $processus = new Processus();
            $processus->setNomProcessus($data['nom']);
            $processus->setAge($data['age']);
            $processus->setPhase($this->getReference($data['phase'], Phase::class));

            $manager->persist($processus);
            $this->addReference('processus_huitre_' . $data['nom'], $processus);
        }

        $manager->flush();

        // ============================================
        // 5. CRÉATION DES PROCESSUS MOULES
        // Données issues du CSV MOULES
        // SURVIE: 90% par étape | Ratio brut/net: 1.8
        // ============================================

        // Pré-grossissement (CNM = Croissance Naissance Moule)
        $processusMoules = [
            ['nom' => 'CNM-M0', 'age' => 0, 'phase' => 'phase_moule_pre_gross', 'poids_pce' => 0.45, 'survie' => 0.90, 'u_kg' => 2222],
            ['nom' => 'CNM+1', 'age' => 1, 'phase' => 'phase_moule_pre_gross', 'poids_pce' => 1.40, 'survie' => 0.90, 'u_kg' => 714],
            ['nom' => 'CNM+2', 'age' => 2, 'phase' => 'phase_moule_pre_gross', 'poids_pce' => 2.30, 'survie' => 0.90, 'u_kg' => 435],
            ['nom' => 'CNM+3', 'age' => 3, 'phase' => 'phase_moule_pre_gross', 'poids_pce' => 3.20, 'survie' => 0.90, 'u_kg' => 313],
            ['nom' => 'CNM+4', 'age' => 4, 'phase' => 'phase_moule_pre_gross', 'poids_pce' => 4.10, 'survie' => 0.90, 'u_kg' => 244],
        ];

        // Grossissement (GM = Grossissement Moule)
        $processusMoules = array_merge($processusMoules, [
            ['nom' => 'GM1', 'age' => 5, 'phase' => 'phase_moule_gross', 'poids_pce' => 5.10, 'survie' => 0.90, 'u_kg' => 196],
            ['nom' => 'GM2', 'age' => 6, 'phase' => 'phase_moule_gross', 'poids_pce' => 6.00, 'survie' => 0.90, 'u_kg' => 167],
            ['nom' => 'GM3', 'age' => 7, 'phase' => 'phase_moule_gross', 'poids_pce' => 6.90, 'survie' => 0.90, 'u_kg' => 145],
            ['nom' => 'GM4', 'age' => 8, 'phase' => 'phase_moule_gross', 'poids_pce' => 7.80, 'survie' => 0.90, 'u_kg' => 128],
            ['nom' => 'GM5', 'age' => 9, 'phase' => 'phase_moule_gross', 'poids_pce' => 8.80, 'survie' => 0.90, 'u_kg' => 114],
            ['nom' => 'GM6', 'age' => 10, 'phase' => 'phase_moule_gross', 'poids_pce' => 9.70, 'survie' => 0.90, 'u_kg' => 103],
            ['nom' => 'GM7', 'age' => 11, 'phase' => 'phase_moule_gross', 'poids_pce' => 10.60, 'survie' => 0.90, 'u_kg' => 94],
            ['nom' => 'GM8', 'age' => 12, 'phase' => 'phase_moule_gross', 'poids_pce' => 11.50, 'survie' => 0.90, 'u_kg' => 87],
            ['nom' => 'GM9', 'age' => 13, 'phase' => 'phase_moule_gross', 'poids_pce' => 12.50, 'survie' => 0.90, 'u_kg' => 80],
            ['nom' => 'GM10', 'age' => 14, 'phase' => 'phase_moule_gross', 'poids_pce' => 13.40, 'survie' => 0.90, 'u_kg' => 75],
        ]);

        // Commerciales (MS = Moule Super, ME = Moule Extra, MR = Moule Royale)
        $processusMoules = array_merge($processusMoules, [
            ['nom' => 'MS+1', 'age' => 15, 'phase' => 'phase_moule_commerciale', 'poids_pce' => 14.30, 'survie' => 0.90, 'u_kg' => 70],
            ['nom' => 'MS+2', 'age' => 16, 'phase' => 'phase_moule_commerciale', 'poids_pce' => 16.70, 'survie' => 0.90, 'u_kg' => 60],
            ['nom' => 'MS+3', 'age' => 17, 'phase' => 'phase_moule_commerciale', 'poids_pce' => 20.00, 'survie' => 0.90, 'u_kg' => 50],
            ['nom' => 'ME+1', 'age' => 18, 'phase' => 'phase_moule_commerciale', 'poids_pce' => 25.00, 'survie' => 0.90, 'u_kg' => 40],
            ['nom' => 'ME+2', 'age' => 19, 'phase' => 'phase_moule_commerciale', 'poids_pce' => 28.60, 'survie' => 0.90, 'u_kg' => 35],
            ['nom' => 'ME+3', 'age' => 20, 'phase' => 'phase_moule_commerciale', 'poids_pce' => 33.30, 'survie' => 0.90, 'u_kg' => 30],
            ['nom' => 'MR+1', 'age' => 21, 'phase' => 'phase_moule_commerciale', 'poids_pce' => 40.00, 'survie' => 0.90, 'u_kg' => 25],
            ['nom' => 'MR+2', 'age' => 22, 'phase' => 'phase_moule_commerciale', 'poids_pce' => 50.00, 'survie' => 0.90, 'u_kg' => 20],
            ['nom' => 'MR+3+', 'age' => 23, 'phase' => 'phase_moule_commerciale', 'poids_pce' => 66.70, 'survie' => 0.90, 'u_kg' => 15],
        ]);

        // Sauvegarde des processus moules
        foreach ($processusMoules as $data) {
            $processus = new Processus();
            $processus->setNomProcessus($data['nom']);
            $processus->setAge($data['age']);
            $processus->setPhase($this->getReference($data['phase'], Phase::class));

            $manager->persist($processus);
            $this->addReference('processus_moule_' . str_replace('+', '_', $data['nom']), $processus);
        }

        $manager->flush();
    }

    /**
     * Cette fixture dépend de FruitDeMerFixtures
     */
    public function getDependencies(): array
    {
        return [
            FruitDeMerFixtures::class,
        ];
    }
}
