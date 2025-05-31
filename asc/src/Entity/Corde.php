<?php

namespace App\Entity;

use App\Repository\CordeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CordeRepository::class)]
class Corde
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'cordes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Parc $parc = null;

    #[ORM\Column]
    private ?float $longeur = null;

    /**
     * @var Collection<int, StockCorde>
     */
    #[ORM\OneToMany(targetEntity: StockCorde::class, mappedBy: 'corde', orphanRemoval: true)]
    private Collection $stockCordes;

    #[ORM\Column]
    private ?int $quantiter = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    public function __toString(): string
    {
        return $this->nom ?? 'Corde';
    }

    public function __construct()
    {
        $this->stockCordes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParc(): ?Parc
    {
        return $this->parc;
    }

    public function setParc(?Parc $parc): static
    {
        $this->parc = $parc;

        return $this;
    }

    public function getLongeur(): ?float
    {
        return $this->longeur;
    }

    public function setLongeur(float $longeur): static
    {
        $this->longeur = $longeur;

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
            $stockCorde->setCorde($this);
        }

        return $this;
    }

    public function removeStockCorde(StockCorde $stockCorde): static
    {
        if ($this->stockCordes->removeElement($stockCorde)) {
            // set the owning side to null (unless already changed)
            if ($stockCorde->getCorde() === $this) {
                $stockCorde->setCorde(null);
            }
        }

        return $this;
    }

    public function getQuantiter(): ?int
    {
        return $this->quantiter;
    }

    public function setQuantiter(int $quantiter): static
    {
        $this->quantiter = $quantiter;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }
}
