<?php

namespace App\Entity;

use App\Repository\EmplacementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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

    /**
     * @var Collection<int, StockCorde>
     */
    #[ORM\OneToMany(targetEntity: StockCorde::class, mappedBy: 'emplacement')]
    private Collection $stockCordes;

    public function __construct()
    {
        $this->stockCordes = new ArrayCollection();
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

    /**
     * @return Collection<int, StockCorde>
     */
    public function getStockCordes(): Collection
    {
        return $this->stockCordes;
    }

    public function addStockCorde(StockCorde $stockCorde): static
    {
        if (!$this->stockCordes->contains($stockCorde)) {
            $this->stockCordes->add($stockCorde);
            $stockCorde->setEmplacement($this);
        }

        return $this;
    }

    public function removeStockCorde(StockCorde $stockCorde): static
    {
        if ($this->stockCordes->removeElement($stockCorde)) {
            // set the owning side to null (unless already changed)
            if ($stockCorde->getEmplacement() === $this) {
                $stockCorde->setEmplacement(null);
            }
        }

        return $this;
    }
}
