<?php

namespace App\Service;

use App\Entity\Segment;
use App\Service\EmplacementService;
use App\Service\FlotteurSegmentService;
use App\Service\Interface\EtatActualProdInterface;

class SegmentService implements EtatActualProdInterface
{
    private Segment $segment;
    private EmplacementService $emplacementService;
    private FlotteurSegmentService $flotteurSegmentService;

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
    private float $poidCordes = 0.0;

    public function __construct(EmplacementService $emplacementService, FlotteurSegmentService $flotteurSegmentService)
    {
        $this->emplacementService = $emplacementService;
        $this->flotteurSegmentService = $flotteurSegmentService;
    }

    public function setSegmentToService(Segment $segment): void
    {
        $this->segment = $segment;
        $this->calculateAllValues(); // Calcul direct lors du set
    }

    /**
     * Calcule toutes les valeurs
     */
    private function calculateAllValues(): void
    {
        // Initialiser toutes les valeurs
        $totalEmplacements = $this->segment->getEmplacements()->count();
        $emplacementsRemplis = 0;
        $totalCordes = 0;
        $totalCordesHuitre = 0;
        $totalCordesMoule = 0;
        $totalCordesLanterne = 0;
        $totalCordesPoche = 0;
        $flottabiliterTotale = 0;
        $derniereDateMAE = null;

        // Calculer la flottabilité
        foreach ($this->segment->getFlotteurSegments() as $flotteurSegment) {
            $this->flotteurSegmentService->setFlotteurSegmentToService($flotteurSegment);
            $flottabiliterTotale += $this->flotteurSegmentService->getFlottabiliter();
        }

        // Parcourir tous les emplacements une seule fois
        foreach ($this->segment->getEmplacements() as $emplacement) {
            $this->emplacementService->setEmplacementToService($emplacement);
            $isEmpty = $this->emplacementService->isEmpty();

            if (!$isEmpty) {
                $emplacementsRemplis++;
            }

            // Vérifier les cordes
            if ($this->emplacementService->haseCorde()) {
                $totalCordes++;
            }

            if ($this->emplacementService->haseCordeHuitre()) {
                $totalCordesHuitre++;
            }

            if ($this->emplacementService->haseCordeMoule()) {
                $totalCordesMoule++;
            }

            if ($this->emplacementService->haseLanterne()) {
                $totalCordesLanterne++;
            }

            if ($this->emplacementService->hasePoche()) {
                $totalCordesPoche++;
            }
            $this->poidCordes = $this->emplacementService->getPoidPlace();

            if ($emplacement->getStockMateriel()) {
                // Calculer la dernière date de MAE
                $stockMateriel = $emplacement->getStockMateriel();
                $dateMiseAEau = $stockMateriel->getDateDeMiseAEau();
                if ($dateMiseAEau && ($derniereDateMAE === null || $dateMiseAEau > $derniereDateMAE)) {
                    $derniereDateMAE = $dateMiseAEau;
                }
            }
        }

        // Calculer le pourcentage de remplissage
        $remplissagePourcentage = ($totalEmplacements > 0)
            ? ($emplacementsRemplis / $totalEmplacements) * 100
            : 0.0;

        // Stocker toutes les valeurs calculées dans les propriétés
        $this->ref = $this->segment->getNomsegment();
        $this->remplissage = $remplissagePourcentage;
        $this->flottabiliter = $flottabiliterTotale;
        $this->taille = $this->segment->getLongeur();
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
        return $this->poidCordes;
    }

    public function volumesTotale(): float
    {
        // TODO: implement calculation
        return 0.0;
    }
}
