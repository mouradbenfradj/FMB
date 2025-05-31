<?php

namespace App\Entity;

use App\Repository\ParcRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParcRepository::class)]
class Parc
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    private ?string $libParc = null;

    #[ORM\Column(length: 32)]
    private ?string $abrevParc = null;

    /**
     * @var Collection<int, Filiere>
     */
    #[ORM\OneToMany(targetEntity: Filiere::class, mappedBy: 'parc', orphanRemoval: true)]
    private Collection $filieres;

    /**
     * @var Collection<int, Corde>
     */
    #[ORM\OneToMany(targetEntity: Corde::class, mappedBy: 'parc', orphanRemoval: true)]
    private Collection $cordes;

    /**
     * @var Collection<int, Stock>
     */
    #[ORM\OneToMany(targetEntity: Stock::class, mappedBy: 'parc', orphanRemoval: true)]
    private Collection $stocks;

    /**
     * @var Collection<int, Lanterne>
     */
    #[ORM\OneToMany(targetEntity: Lanterne::class, mappedBy: 'parc', orphanRemoval: true)]
    private Collection $lanternes;

    public function __toString(): string
    {
        return $this->libParc;
    }

    public function __construct()
    {
        $this->filieres = new ArrayCollection();
        $this->cordes = new ArrayCollection();
        $this->stocks = new ArrayCollection();
        $this->lanternes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibParc(): ?string
    {
        return $this->libParc;
    }

    public function setLibParc(string $libParc): static
    {
        $this->libParc = $libParc;

        return $this;
    }

    public function getAbrevParc(): ?string
    {
        return $this->abrevParc;
    }

    public function setAbrevParc(string $abrevParc): static
    {
        $this->abrevParc = $abrevParc;

        return $this;
    }

    /**
     * @return Collection<int, Filiere>
     */
    public function getFilieres(): Collection
    {
        return $this->filieres;
    }

    public function addFiliere(Filiere $filiere): static
    {
        if (!$this->filieres->contains($filiere)) {
            $this->filieres->add($filiere);
            $filiere->setParc($this);
        }

        return $this;
    }

    public function removeFiliere(Filiere $filiere): static
    {
        if ($this->filieres->removeElement($filiere)) {
            // set the owning side to null (unless already changed)
            if ($filiere->getParc() === $this) {
                $filiere->setParc(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Corde>
     */
    public function getCordes(): Collection
    {
        return $this->cordes;
    }

    public function addCorde(Corde $corde): static
    {
        if (!$this->cordes->contains($corde)) {
            $this->cordes->add($corde);
            $corde->setParc($this);
        }

        return $this;
    }

    public function removeCorde(Corde $corde): static
    {
        if ($this->cordes->removeElement($corde)) {
            // set the owning side to null (unless already changed)
            if ($corde->getParc() === $this) {
                $corde->setParc(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Stock>
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Stock $stock): static
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks->add($stock);
            $stock->setParc($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): static
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getParc() === $this) {
                $stock->setParc(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Lanterne>
     */
    public function getLanternes(): Collection
    {
        return $this->lanternes;
    }

    public function addLanterne(Lanterne $lanterne): static
    {
        if (!$this->lanternes->contains($lanterne)) {
            $this->lanternes->add($lanterne);
            $lanterne->setParc($this);
        }

        return $this;
    }

    public function removeLanterne(Lanterne $lanterne): static
    {
        if ($this->lanternes->removeElement($lanterne)) {
            // set the owning side to null (unless already changed)
            if ($lanterne->getParc() === $this) {
                $lanterne->setParc(null);
            }
        }

        return $this;
    }
}
