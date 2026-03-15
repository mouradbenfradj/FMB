<?php
// src/Twig/MouleExtension.php

namespace App\Twig;

use App\Service\MouleCalculator;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class MouleExtension extends AbstractExtension
{
    private MouleCalculator $calculator;

    public function __construct(MouleCalculator $calculator)
    {
        $this->calculator = $calculator;
    }
    public function getFilters(): array
    {
        return [
            new TwigFilter('age_en_mois', [$this, 'calculateAgeEnMois']),
        ];
    }
    public function getFunctions(): array
    {
        return [
            new TwigFunction('moule_col_j', [$this, 'calculateColJ']),
            new TwigFunction('moule_col_k', [$this, 'calculatePoidsParPiece']),
            new TwigFunction('moule_col_l', [$this, 'calculateUiniterMetre']),
            new TwigFunction('moule_col_m', [$this, 'calculateTauxDeSurvie']),
            new TwigFunction('moule_col_n', [$this, 'calculateColN']),
            new TwigFunction('moule_col_o', [$this, 'calculatePoidsNet']),
            new TwigFunction('moule_col_p', [$this, 'calculatePoidBrute']),
            new TwigFunction('moule_col_q', [$this, 'calculateColQ']),
            new TwigFunction('moule_col_r', [$this, 'calculateColR']),
            new TwigFunction('moule_col_s', [$this, 'calculateColS']),
            new TwigFunction('moule_col_t', [$this, 'calculateColT']),
            new TwigFunction('moule_all_columns', [$this, 'calculateAllColumns']),
        ];
    }

    public function calculateAgeEnMois(?\DateTimeInterface $date): int
    {
        if (!$date) {
            return 0;
        }

        $now = new \DateTime();
        $interval = $date->diff($now);

        return ($interval->y * 12) + $interval->m;
    }

    /**
     * Colonne J: Unités par kilogramme (U/KG)
     */
    public function calculateColJ(int $age): float
    {
        return $this->calculator->calculateColJ($age);
    }

    /**
     * Colonne K: Poids par pièce (g)
     */
    public function calculatePoidsParPiece(int $age): float
    {
        return $this->calculator->calculatePoidsParPiece($age);
    }

    /**
     * Colonne L: Unités par mètre (U/M)
     */
    public function calculateUiniterMetre(int $age, int $quantite): float
    {
        return $this->calculator->calculateUiniterMetre($age, $quantite);
    }

    /**
     * Colonne M: Taux de survie (%)
     */
    public function calculateTauxDeSurvie(int $age): float
    {
        return $this->calculator->calculateTauxDeSurvie($age);
    }

    /**
     * Colonne N: Survie relative (RESTE)
     */
    public function calculateColN(int $age, int $quantite): float
    {
        return $this->calculator->calculateColN($age, $quantite);
    }

    /**
     * Colonne O: Poids net (KG/M)
     */
    public function calculatePoidsNet(int $age, int $longeur, int $quantite): float
    {
        return $this->calculator->calculatePoidsNet($age, $longeur, $quantite);
    }

    /**
     * Colonne P: Poids brut (KG/M)
     */
    public function calculatePoidBrute(int $age, int $longeur, int $quantite): float
    {
        return $this->calculator->calculatePoidBrute($age, $longeur, $quantite);
    }

    /**
     * Colonne Q: Vérification
     */
    public function calculateColQ(int $age, int $longeur, int $quantite): float
    {
        return $this->calculator->calculateColQ($age, $longeur, $quantite);
    }

    /**
     * Colonne R: Poids net pour 2m de corde (KG/2M)
     */
    public function calculateColR(int $age, int $longeur, int $quantite): float
    {
        return $this->calculator->calculateColR($age, $longeur, $quantite);
    }

    /**
     * Colonne S: Poids brut pour 2m de corde (KG/2M)
     */
    public function calculateColS(int $age, int $longeur, int $quantite): float
    {
        return $this->calculator->calculateColS($age, $longeur, $quantite);
    }

    /**
     * Colonne T: Vérification
     */
    public function calculateColT(int $age, int $longeur, int $quantite): float
    {
        return $this->calculator->calculateColT($age, $longeur, $quantite);
    }

    /**
     * Toutes les colonnes
     */
    public function calculateAllColumns(int $age, int $longeur, int $quantite): array
    {
        return $this->calculator->calculateAllColumns($age, $longeur, $quantite);
    }
}
