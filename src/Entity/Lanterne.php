<?php

namespace App\Entity;

use App\Repository\LanterneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LanterneRepository::class)]
class Lanterne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomLanterne = null;

    #[ORM\Column]
    private ?int $nbrPoche = null;

    #[ORM\Column]
    private ?int $nbrEnStock = null;

    #[ORM\ManyToOne(inversedBy: 'lanternes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Parc $parc = null;

    /**
     * @var Collection<int, StockLanterne>
     */
    #[ORM\OneToMany(targetEntity: StockLanterne::class, mappedBy: 'lanterne', orphanRemoval: true)]
    private Collection $stockLanternes;

    public function __construct()
    {
        $this->stockLanternes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomLanterne(): ?string
    {
        return $this->nomLanterne;
    }

    public function setNomLanterne(string $nomLanterne): static
    {
        $this->nomLanterne = $nomLanterne;

        return $this;
    }

    public function getNbrPoche(): ?int
    {
        return $this->nbrPoche;
    }

    public function setNbrPoche(int $nbrPoche): static
    {
        $this->nbrPoche = $nbrPoche;

        return $this;
    }

    public function getNbrEnStock(): ?int
    {
        return $this->nbrEnStock;
    }

    public function setNbrEnStock(int $nbrEnStock): static
    {
        $this->nbrEnStock = $nbrEnStock;

        return $this;
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

    /**
     * @return Collection<int, StockLanterne>
     */
    public function getStockLanternes(): Collection
    {
        return $this->stockLanternes;
    }

    public function addStockLanterne(StockLanterne $stockLanterne): static
    {
        if (!$this->stockLanternes->contains($stockLanterne)) {
            $this->stockLanternes->add($stockLanterne);
            $stockLanterne->setLanterne($this);
        }

        return $this;
    }

    public function removeStockLanterne(StockLanterne $stockLanterne): static
    {
        if ($this->stockLanternes->removeElement($stockLanterne)) {
            // set the owning side to null (unless already changed)
            if ($stockLanterne->getLanterne() === $this) {
                $stockLanterne->setLanterne(null);
            }
        }

        return $this;
    }
}
