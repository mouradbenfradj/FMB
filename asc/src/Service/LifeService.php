<?php

namespace App\Service;

class LifeService
{
    public function calculerAgeEnMois(string $dateNaissance): int
    {
        $dateNaissance = new \DateTime($dateNaissance);
        $aujourdHui = new \DateTime();

        $difference = $dateNaissance->diff($aujourdHui);
        return ($difference->y * 12) + $difference->m;
    }

    public function calculerUnitesRestantesMoules(
        float $distanceMetres,
        float $nbUnitesMoisPrecedent,
        int $ageCibleMois,
        float $taux
    ): float {
        $unitesRestantes = $nbUnitesMoisPrecedent * pow($taux, $ageCibleMois);
        return $distanceMetres * round(max(0, $unitesRestantes), 1);
    }


    /**
     * Calcule 1000/[poids_unité] pour les mois >= 15 avec les poids définis
     * Retourne null pour les mois < 15
     * 
     * @param int $ageMois Âge en mois
     * @return float|null Résultat du calcul ou null si mois < 15
     */
    public function calculerRatio1000SurPoidsUnite(int $ageMois): ?float
    {
        // Retourne null pour les mois < 15
        if ($ageMois < 15 || $ageMois > 23) {
            return null;
        }
        // Mapping des poids par mois (à partir de 15 mois)
        $poidsParMois = [
            15 => 70,
            16 => 60,
            17 => 50,
            18 => 40,
            19 => 35,
            20 => 30,
            21 => 25,
            22 => 20,
            23 => 15
        ];

        $poidsUnite = $poidsParMois[$ageMois];


        return  round(1000 / $poidsUnite, 1);
    }



    /**
     * Calcule la valeur décroissante mois par mois en appliquant un pourcentage de réduction
     * 
     * @param int $mois Le mois demandé (0 pour le premier mois)
     * @param float $valeurInitiale Valeur du mois 0 (par défaut: 1.00)
     * @param float $tauxReductionMensuel Taux de réduction (ex: 0.97 pour 3% de réduction)
     * @return float Valeur arrondie à 2 décimales
     */
    public function calculerValeurDecroissante(
        int $mois,
        float $valeurInitiale = 1.00,
        float $tauxReductionMensuel = 0.97
    ): float {
        if ($mois < 0) {
            return 0;
        }

        // Calcul de la valeur décroissante exponentielle
        $valeur = $valeurInitiale * pow($tauxReductionMensuel, $mois);

        return round($valeur, 2); // Arrondi à 2 décimales
    }
}
