<?php

namespace App\Service;

use App\Entity\Filiere;
use App\Service\SegmentService;
use App\Service\Interface\EtatActualProdInterface;

class FiliereService implements EtatActualProdInterface
{
    private Filiere $filiere;
    private SegmentService $segmentService;

    // Variables locales privées pour stocker les valeurs calculées
    private string $ref;
    private float $remplissage;
    private float $flottabiliter;
    private float $taille;
    private int $totalEmplacement;
    private int $emplacementVide;
    private int $emplacementRemplit;
    private int $totalCorde;
    private int $totalCordeHuitre;
    private int $totalCordeMoule;
    private int $totalCordeLanterne;
    private int $totalCordePoche;
    private ?\DateTimeInterface $dateDeMAE;
    private int $passageChaussette = 0;

    public function __construct(SegmentService $segmentService)
    {
        $this->segmentService = $segmentService;
    }

    public function setFiliereToService(Filiere $filiere): void
    {
        $this->filiere = $filiere;
        $this->calculateAllValues(); // Calcul direct lors du set
    }

    /**
     * Calcule toutes les valeurs
     */
    private function calculateAllValues(): void
    {
        // Initialiser toutes les valeurs
        $totalEmplacements = 0;
        $emplacementsRemplis = 0;
        $totalCordes = 0;
        $totalCordesHuitre = 0;
        $totalCordesMoule = 0;
        $totalCordesLanterne = 0;
        $totalCordesPoche = 0;
        $flottabiliterTotale = 0;
        $derniereDateMAE = null;
        $tailleTotale = 0;

        // Parcourir tous les segments
        foreach ($this->filiere->getSegments() as $segment) {
            $this->segmentService->setSegmentToService($segment);

            // Accumuler les valeurs
            $totalEmplacements += $this->segmentService->totalEmplacement();
            $emplacementsRemplis += $this->segmentService->emplacementRemplit();
            $totalCordes += $this->segmentService->totalCorde();
            $totalCordesHuitre += $this->segmentService->totalCordeHuitre();
            $totalCordesMoule += $this->segmentService->totalCordeMoule();
            $totalCordesLanterne += $this->segmentService->totalCordeLanterne();
            $totalCordesPoche += $this->segmentService->totalCordePoche();
            $flottabiliterTotale += $this->segmentService->flottabiliter();
            $tailleTotale += $this->segmentService->taille();

            // Calculer la dernière date de MAE parmi tous les segments
            $segmentDateMAE = $this->segmentService->dateDeMAE();
            if ($segmentDateMAE && ($derniereDateMAE === null || $segmentDateMAE > $derniereDateMAE)) {
                $derniereDateMAE = $segmentDateMAE;
            }
        }

        // Calculer le pourcentage de remplissage
        $remplissagePourcentage = ($totalEmplacements > 0)
            ? ($emplacementsRemplis / $totalEmplacements) * 100
            : 0.0;

        // Stocker toutes les valeurs calculées dans les propriétés
        $this->ref = $this->filiere->getNomFiliere();
        $this->remplissage = $remplissagePourcentage;
        $this->flottabiliter = $flottabiliterTotale;
        $this->taille = $tailleTotale;
        $this->totalEmplacement = $totalEmplacements;
        $this->emplacementVide = $totalEmplacements - $emplacementsRemplis;
        $this->emplacementRemplit = $emplacementsRemplis;
        $this->totalCorde = $totalCordes;
        $this->totalCordeHuitre = $totalCordesHuitre;
        $this->totalCordeMoule = $totalCordesMoule;
        $this->totalCordeLanterne = $totalCordesLanterne;
        $this->totalCordePoche = $totalCordesPoche;
        $this->dateDeMAE = $derniereDateMAE;
        // $this->passageChaussette reste à 0 (valeur fixe)
    }

    public function ref(): string
    {
        return $this->ref;
    }

    public function remplissage(): float
    {
        return $this->remplissage;
    }

    public function flottabiliter(): float
    {
        return $this->flottabiliter;
    }

    public function taille(): float
    {
        return $this->taille;
    }

    public function totalEmplacement(): int
    {
        return $this->totalEmplacement;
    }

    public function emplacementVide(): int
    {
        return $this->emplacementVide;
    }

    public function emplacementRemplit(): int
    {
        return $this->emplacementRemplit;
    }

    public function totalCorde(): int
    {
        return $this->totalCorde;
    }

    public function totalCordeHuitre(): int
    {
        return $this->totalCordeHuitre;
    }

    public function totalCordeMoule(): int
    {
        return $this->totalCordeMoule;
    }

    public function totalCordeLanterne(): int
    {
        return $this->totalCordeLanterne;
    }

    public function totalCordePoche(): int
    {
        return $this->totalCordePoche;
    }

    public function dateDeMAE(): ?\DateTimeInterface
    {
        return $this->dateDeMAE;
    }

    public function passageChaussette(): int
    {
        return $this->passageChaussette;
    }

    public function poidCordes(): float
    {
        // TODO: implement calculation
        return 0.0;
    }

    public function volumesTotale(): float
    {
        // TODO: implement calculation
        return 0.0;
    }
}
