<?php
// src/Service/MouleCalculator.php

namespace App\Service;

class MouleCalculator
{
    private $p14; // Ratio poids brut/poids net
    private $k15; // Taux de croissance mensuel

    public function __construct()
    {
        //$this->p14 = 2.7378991445025265; // Valeur fixe de P14
        $this->p14 = 1.8; // Valeur fixe de P14
        $this->k15 = 0.9233333333; // Calcul du taux de croissance
        //$this->k15 = (14.3 - 0.45) / 15; // Calcul du taux de croissance
    }

    /**
     * Calcule toutes les colonnes pour un âge donné
     */
    public function calculateAllColumns(int $age, int $longeur, int $quantiter): array
    {
        return [
            'col_j_u/kg' => $this->calculateColJ($age),
            'col_k_PM (g/u)' => $this->calculatePoidsParPiece($age),
            'col_l_Survie (u/m)' => $this->calculateUiniterMetre($age, $quantiter),
            'col_m' => $this->calculateTauxDeSurvie($age),
            'col_n_Survie/t0' => $this->calculateColN($age, $quantiter),
            'col_o_Net (KG)' => $this->calculatePoidsNet($age, $longeur, $quantiter),
            'col_p_Brut (KG)' => $this->calculatePoidBrute($age, $longeur, $quantiter),
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
        // Valeurs prédéfinies pour les âges spécifiques
        $poidsParAge = [
            0 => 0.45, // Moyenne de 0,002-0,005
            15 => 14.3,
            16 => 16.7,
            17 => 20,
            18 => 25,
            19 => 28.6,
            20 => 33.3,
            21 => 40,
            22 => 50,
            23 => 66.7
        ];

        if (isset($poidsParAge[$age])) {
            return $poidsParAge[$age];
        }

        // Pour les autres âges, calcul progressif
        return round(0.45 + ($age * $this->k15), 3);
    }

    /**
     * Colonne L: Unités par mètre (U/M)
     */
    public function calculateUiniterMetre(int $age, int $quantiter): float
    {
        if ($age === 0) {
            return $quantiter;
        }

        $prevAge = $age - 1;
        $prevU = $this->calculateUiniterMetre($prevAge, $quantiter);
        $prevSurvie = $this->calculateTauxDeSurvie($prevAge);

        return $prevU * $prevSurvie;
    }

    /**
     * Colonne M: Taux de survie (%)
     */
    public function calculateTauxDeSurvie(int $age): float
    {
        if ($age === 0) {
            return 0.9; // Taux de survie initial
        }

        // Pour simplifier, on garde un taux constant
        // À adapter selon vos besoins spécifiques
        return 0.9;
    }

    /**
     * Colonne N: Survie relative (RESTE)
     */
    public function calculateColN(int $age, $quantiter): float
    {
        $uActuel = $this->calculateUiniterMetre($age, $quantiter);
        $uInitial = $this->calculateUiniterMetre(0, $quantiter);

        return round(($uActuel / $uInitial) * 100);
    }

    /**
     * Colonne O: Poids net (KG/M)
     */
    public function calculatePoidsNet(int $age, int $longeur, int $quantiter): float
    {
        $uParM = $this->calculateUiniterMetre($age, $quantiter);
        $poidsUnitaire = $this->calculatePoidsParPiece($age);

        return $longeur * round(($uParM * $poidsUnitaire) / 1000, 1);
    }

    /**
     * Colonne P: Poids brut (KG/M)
     */
    public function calculatePoidBrute(int $age, int $longeur, int $quantiter): float
    {
        $poidsNet = $this->calculatePoidsNet($age, $longeur, $quantiter);
        return round($poidsNet * $this->p14, 1);
    }

    /**
     * Colonne Q: Vérification (non claire dans le fichier)
     */
    public function calculateColQ(int $age, int $longeur, int $quantiter): float
    {
        $poidsBrut2m = $this->calculateColS($age, $longeur, $quantiter);
        $poidsNet = $this->calculatePoidsNet($age, $longeur, $quantiter);

        return $poidsBrut2m - (2 * $poidsNet);
    }

    /**
     * Colonne R: Poids net pour 2m de corde (KG/2M)
     */
    public function calculateColR(int $age, int $longeur, int $quantiter): float
    {
        $poidsNet = $this->calculatePoidsNet($age, $longeur, $quantiter);
        return round($poidsNet * $longeur, 1);
    }

    /**
     * Colonne S: Poids brut pour 2m de corde (KG/2M)
     */
    public function calculateColS(int $age, int $longeur, int $quantiter): float
    {
        $poidsBrut = $this->calculateColR($age, $longeur, $quantiter);
        return round($poidsBrut * $this->p14, 1);
    }

    /**
     * Colonne T: Vérification (non claire dans le fichier)
     */
    public function calculateColT(int $age, int $longeur, int $quantiter): float
    {
        $poidsBrut2m = $this->calculateColS($age, $longeur, $quantiter);
        $poidsBrut = $this->calculatePoidBrute($age, $longeur, $quantiter);

        return $poidsBrut2m - (2 * $poidsBrut);
    }
}
