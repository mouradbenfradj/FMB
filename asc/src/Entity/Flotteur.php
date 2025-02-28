<?php

namespace App\Entity;

use App\Repository\FlotteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FlotteurRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Flotteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomFlotteur = null;

    #[ORM\Column]
    private ?float $volume = null;

    #[ORM\Column]
    private ?float $kgf = null;

    #[ORM\Column]
    private ?float $taux = null;

    /**
     * @var Collection<int, FlotteurSegment>
     */
    #[ORM\OneToMany(targetEntity: FlotteurSegment::class, mappedBy: 'flotteur')]
    private Collection $flotteurSegments;

    public function __construct()
    {
        $this->flotteurSegments = new ArrayCollection();
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function calculerKgf()
    {
        $this->kgf = $this->volume * $this->taux;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFlotteur(): ?string
    {
        return $this->nomFlotteur;
    }

    public function setNomFlotteur(string $nomFlotteur): static
    {
        $this->nomFlotteur = $nomFlotteur;

        return $this;
    }

    public function getVolume(): ?float
    {
        return $this->volume;
    }

    public function setVolume(float $volume): static
    {
        $this->volume = $volume;

        return $this;
    }

    public function getKgf(): ?float
    {
        return $this->kgf;
    }

    public function setKgf(float $kgf): static
    {
        $this->kgf = $kgf;

        return $this;
    }

    public function getTaux(): ?float
    {
        return $this->taux;
    }

    public function setTaux(float $taux): static
    {
        $this->taux = $taux;

        return $this;
    }

    /**
     * @return Collection<int, FlotteurSegment>
     */
    public function getFlotteurSegments(): Collection
    {
        return $this->flotteurSegments;
    }

    public function addFlotteurSegment(FlotteurSegment $flotteurSegment): static
    {
        if (!$this->flotteurSegments->contains($flotteurSegment)) {
            $this->flotteurSegments->add($flotteurSegment);
            $flotteurSegment->setFlotteur($this);
        }

        return $this;
    }

    public function removeFlotteurSegment(FlotteurSegment $flotteurSegment): static
    {
        if ($this->flotteurSegments->removeElement($flotteurSegment)) {
            // set the owning side to null (unless already changed)
            if ($flotteurSegment->getFlotteur() === $this) {
                $flotteurSegment->setFlotteur(null);
            }
        }

        return $this;
    }
}
