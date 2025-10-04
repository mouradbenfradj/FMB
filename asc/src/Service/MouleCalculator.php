<?php
// src/Service/MouleCalculator.php

namespace App\Service;

class MouleCalculator
{
    private $p14; // Ratio poids brut/poids net
    private $s14; // Facteur pour calcul par corde de 2m (poids brut)
    private $k15; // Taux de croissance mensuel

    public function __construct()
    {
        //$this->p14 = 2.7378991445025265; // Valeur fixe de P14
        $this->p14 = 1.8; // Valeur fixe de P14
        $this->s14 = 1.8; // Valeur de S14 (à ajuster selon votre fichier)
        $this->k15 = 0.9233333333; // Calcul du taux de croissance
        //$this->k15 = (14.3 - 0.45) / 15; // Calcul du taux de croissance
    }

    /**
     * Calcule toutes les colonnes pour un âge donné
     */
    public function calculateAllColumns(int $age, int $longeur): array
    {
        return [
            'col_j_u/kg' => $this->calculateColJ($age),
            'col_k_PM (g/u)' => $this->calculateColK($age),
            'col_l_Survie (u/m)' => $this->calculateColL($age),
            'col_m' => $this->calculateColM($age),
            'col_n_Survie/t0' => $this->calculateColN($age),
            'col_o_Net (KG)' => $this->calculateColO($age, $longeur),
            'col_p_Brut (KG)' => $this->calculateColP($age, $longeur),
        ];
    }

    /**
     * Colonne J: Unités par kilogramme (U/KG)
     */
    public function calculateColJ(int $age): float
    {
        $poidsUnitaire = $this->calculateColK($age);
        return round($poidsUnitaire > 0 ? 1000 / $poidsUnitaire : 0);
    }

    /**
     * Colonne K: Poids par pièce (g)
     */
    public function calculateColK(int $age): float
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
    public function calculateColL(int $age): float
    {
        if ($age === 0) {
            return 1500; // Valeur initiale
        }

        // Calcul récursif basé sur l'âge précédent
        $prevAge = $age - 1;
        $prevU = $this->calculateColL($prevAge);
        $prevSurvie = $this->calculateColM($prevAge);

        return $prevU * $prevSurvie;
    }

    /**
     * Colonne M: Taux de survie (%)
     */
    public function calculateColM(int $age): float
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
    public function calculateColN(int $age): float
    {
        $uActuel = $this->calculateColL($age);
        $uInitial = $this->calculateColL(0);

        return round(($uActuel / $uInitial) * 100);
    }

    /**
     * Colonne O: Poids net (KG/M)
     */
    public function calculateColO(int $age, int $longeur): float
    {
        $uParM = $this->calculateColL($age);
        $poidsUnitaire = $this->calculateColK($age);

        return $longeur * round(($uParM * $poidsUnitaire) / 1000, 1);
    }

    /**
     * Colonne P: Poids brut (KG/M)
     */
    public function calculateColP(int $age, int $longeur): float
    {
        $poidsNet = $this->calculateColO($age, $longeur);
        return round($poidsNet * $this->p14, 1);
    }

    /**
     * Colonne Q: Vérification (non claire dans le fichier)
     */
    public function calculateColQ(int $age, int $longeur): float
    {
        $poidsBrut2m = $this->calculateColS($age, $longeur);
        $poidsNet = $this->calculateColO($age, $longeur);

        return $poidsBrut2m - (2 * $poidsNet);
    }

    /**
     * Colonne R: Poids net pour 2m de corde (KG/2M)
     */
    public function calculateColR(int $age, int $longeur): float
    {
        $poidsNet = $this->calculateColO($age, $longeur);
        return round($poidsNet * $longeur, 1);
    }

    /**
     * Colonne S: Poids brut pour 2m de corde (KG/2M)
     */
    public function calculateColS(int $age, int $longeur): float
    {
        $poidsBrut = $this->calculateColR($age, $longeur);
        return round($poidsBrut * $this->s14, 1);
    }

    /**
     * Colonne T: Vérification (non claire dans le fichier)
     */
    public function calculateColT(int $age, int $longeur): float
    {
        $poidsBrut2m = $this->calculateColS($age, $longeur);
        $poidsBrut = $this->calculateColP($age, $longeur);

        return $poidsBrut2m - (2 * $poidsBrut);
    }
}
