<?php
// src/Service/MouleCalculator.php

namespace App\Service;

use App\Repository\CycleRepository;
use App\Repository\FruitDeMerRepository;

class MouleCalculator
{
    private $p14; // Ratio poids brut/poids net
    private $k15; // Taux de croissance mensuel
    private ?CycleRepository $cycleRepository;
    private ?FruitDeMerRepository $fruitDeMerRepository;

    public function __construct(?CycleRepository $cycleRepository = null, ?FruitDeMerRepository $fruitDeMerRepository = null)
    {
        $this->p14 = 1.8; 
        $this->k15 = 0.9233333333;
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
        // 1. Essayer de récupérer depuis l'entité Cycle
        if ($this->cycleRepository && $this->fruitDeMerRepository) {
            $moule = $this->fruitDeMerRepository->findOneBy(['nom' => 'moule']);
            if ($moule) {
                $cycle = $this->cycleRepository->findOneBy(['age' => $age, 'fruitDeMer' => $moule]);
                if ($cycle && $cycle->getPoidsParPiece() !== null) {
                    return $cycle->getPoidsParPiece();
                }
            }
        }

        // 2. Fallback
        $poidsParAge = [
            0 => 0.45, 15 => 14.3, 16 => 16.7, 17 => 20, 18 => 25,
            19 => 28.6, 20 => 33.3, 21 => 40, 22 => 50, 23 => 66.7
        ];

        if (isset($poidsParAge[$age])) {
            return $poidsParAge[$age];
        }

        return round(0.45 + ($age * $this->k15), 3);
    }

    /**
     * Colonne M: Taux de survie (%)
     */
    public function calculateTauxDeSurvie(int $age): float
    {
        // 1. Essayer de récupérer depuis l'entité Cycle
        if ($this->cycleRepository && $this->fruitDeMerRepository) {
            $moule = $this->fruitDeMerRepository->findOneBy(['nom' => 'moule']);
            if ($moule) {
                $cycle = $this->cycleRepository->findOneBy(['age' => $age, 'fruitDeMer' => $moule]);
                if ($cycle && $cycle->getTauxSurvie() !== null) {
                    return $cycle->getTauxSurvie();
                }
            }
        }

        // 2. Fallback
        return 0.9;
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
}
