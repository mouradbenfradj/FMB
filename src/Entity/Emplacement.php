<?php

namespace App\Entity;

use App\Entity\Segment;
use App\Entity\StockCorde;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\StockMateriel;
use App\Repository\EmplacementRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: EmplacementRepository::class)]
class Emplacement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $place = null;

    #[ORM\ManyToOne(inversedBy: 'emplacements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Segment $segment = null;

    #[ORM\OneToOne(targetEntity: StockMateriel::class, mappedBy: 'emplacement')]
    private ?StockMateriel $stockMateriel = null;



    public function __toString(): string
    {
        return $this->place;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlace(): ?int
    {
        return $this->place;
    }

    public function setPlace(int $place): static
    {
        $this->place = $place;

        return $this;
    }

    public function getSegment(): ?Segment
    {
        return $this->segment;
    }

    public function setSegment(?Segment $segment): static
    {
        $this->segment = $segment;

        return $this;
    }

    public function getStockMateriel(): ?StockMateriel
    {
        return $this->stockMateriel;
    }

    public function setStockMateriel(?StockMateriel $stockMateriel): static
    {
        $this->stockMateriel = $stockMateriel;

        return $this;
    }

    public function getMateriels(): string
    {
        return $this->stockMateriel ? $this->stockMateriel->__toString() : '';
    }

    public function getStockCordes(): array
    {
        if ($this->stockMateriel instanceof StockCorde) {
            return [$this->stockMateriel];
        }
        return [];
    }
}
