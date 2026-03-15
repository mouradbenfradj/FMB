<?php
// src/Service/HuitreCalculator.php

namespace App\Service;

use App\Repository\CycleRepository;
use App\Repository\FruitDeMerRepository;

/**
 * Calculateur pour les huîtres (Crassostrea gigas)
 * Base de données - Lagune de Bizerte - TUNISIE
 */
class HuitreCalculator
{
    private $p14; // Ratio poids brut/poids net
    private ?CycleRepository $cycleRepository;
    private ?FruitDeMerRepository $fruitDeMerRepository;

    public function __construct(?CycleRepository $cycleRepository = null, ?FruitDeMerRepository $fruitDeMerRepository = null)
    {
        // Ratio pour les huîtres (différent des moules)
        $this->p14 = 2.0; 
        $this->cycleRepository = $cycleRepository;
        $this->fruitDeMerRepository = $fruitDeMerRepository;
    }

    /**
     * Calcule toutes les colonnes pour un âge donné
     */
    public function calculateAllColumns(int $age, int $longeur, int $quantite): array
    {
        return [
            'col_j_u/kg' => $this->calculateColJ($age),
            'col_k_PM (g/u)' => $this->calculatePoidsParPiece($age),
            'col_l_Survie (u/m)' => $this->calculateUiniterMetre($age, $quantite),
            'col_m' => $this->calculateTauxDeSurvie($age),
            'col_n_Survie/t0' => $this->calculateColN($age, $quantite),
            'col_o_Net (KG)' => $this->calculatePoidsNet($age, $longeur, $quantite),
            'col_p_Brut (KG)' => $this->calculatePoidBrute($age, $longeur, $quantite),
        ];
    }

    /**
     * Colonne J: Unités par kilogramme (U/KG)
     */
    public function calculateColJ(int $age): float
    {
        $poidsUnitaire = $this->calculatePoidsParPiece($age);
        return round($poidsUnitaire > 0 ? 1000 / $poidsUnitaire : 0);
    }

    /**
     * Colonne K: Poids par pièce (g)
     */
    public function calculatePoidsParPiece(int $age): float
    {
        // 1. Essayer de récupérer depuis l'entité Cycle (donnée dynamique)
        if ($this->cycleRepository && $this->fruitDeMerRepository) {
            $huitre = $this->fruitDeMerRepository->findOneBy(['nom' => 'huitre']);
            if ($huitre) {
                $cycle = $this->cycleRepository->findOneBy(['age' => $age, 'fruitDeMer' => $huitre]);
                if ($cycle && $cycle->getPoidsParPiece() !== null) {
                    return $cycle->getPoidsParPiece();
                }
            }
        }

        // 2. Fallback: Valeurs statiques (données CSV d'origine)
        $poidsParAge = [
            0 => 0.16, 1 => 0.43, 2 => 1.15, 3 => 3.04, 4 => 8.08, 5 => 21.47,
            6 => 31.24, 7 => 44.84, 8 => 59.17, 9 => 78.30, 10 => 99.92,
            11 => 116.59, 12 => 130.44, 13 => 143.35, 14 => 155.38, 15 => 174.46,
            16 => 176.91, 17 => 186.49, 18 => 195.35, 19 => 203.50, 20 => 210.99,
        ];

        if (isset($poidsParAge[$age])) {
            return $poidsParAge[$age];
        }

        if ($age > 20) {
            return round(210.99 + (($age - 20) * 5), 2);
        }

        return round(0.16 + ($age * 10), 2);
    }

    /**
     * Colonne M: Taux de survie (%)
     */
    public function calculateTauxDeSurvie(int $age): float
    {
        // 1. Essayer de récupérer depuis l'entité Cycle
        if ($this->cycleRepository && $this->fruitDeMerRepository) {
            $huitre = $this->fruitDeMerRepository->findOneBy(['nom' => 'huitre']);
            if ($huitre) {
                $cycle = $this->cycleRepository->findOneBy(['age' => $age, 'fruitDeMer' => $huitre]);
                if ($cycle && $cycle->getTauxSurvie() !== null) {
                    return $cycle->getTauxSurvie();
                }
            }
        }

        // 2. Fallback
        return 0.97;
    }

    public function calculateUiniterMetre(int $age, int $quantite): float
    {
        if ($age === 0) {
            return $quantite;
        }
        return $this->calculateUiniterMetre($age - 1, $quantite) * $this->calculateTauxDeSurvie($age);
    }

    public function calculateColN(int $age, int $quantite): float
    {
        return $this->calculateUiniterMetre($age, $quantite);
    }

    public function calculatePoidsNet(int $age, int $longeur, int $quantite): float
    {
        $poidsUnitaire = $this->calculatePoidsParPiece($age);
        $reste = $this->calculateColN($age, $quantite);
        return round(($poidsUnitaire * $reste * $longeur) / 1000, 2);
    }

    public function calculatePoidBrute(int $age, int $longeur, int $quantite): float
    {
        return round($this->calculatePoidsNet($age, $longeur, $quantite) * $this->p14, 2);
    }

    public function getPhase(int $age): string
    {
        if ($age <= 2) return 'PRE-GROSS';
        if ($age <= 5) return 'GROSS';
        return 'COMMERCIALE';
    }

    public function getEtape(int $age): string
    {
        $etapes = [
            0 => 'NH+1', 1 => 'NH+2', 2 => 'NH+3',
            3 => 'GH+1', 4 => 'GH+2', 5 => 'GH+3',
            6 => 'H5', 7 => 'H4', 8 => 'H3', 9 => 'H2', 10 => 'H1', 11 => 'H0', 12 => 'H00', 13 => 'H000'
        ];
        return $etapes[$age] ?? 'H000+' . ($age - 13);
    }

    public function getCategorie(int $age): string
    {
        if ($age < 6) return 'NAISSIN';
        $cats = [6 => 'N°5', 7 => 'N°4', 8 => 'N°3', 9 => 'N°2', 10 => 'N°1', 11 => 'N°0', 12 => 'N°00', 13 => 'N°000'];
        return $cats[$age] ?? 'HORS NORMES';
    }
}
