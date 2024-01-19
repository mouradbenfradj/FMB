<?php

namespace App\Entity\Asc\FiliereComposite;

use App\Repository\Asc\FiliereComposite\FlottabiliterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FlottabiliterRepository::class)
 */
class Flottabiliter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomFlottabiliter;

    /**
     * @ORM\Column(type="integer")
     */
    private $volume;

    /**
     * @ORM\Column(type="float")
     */
    private $kgf;

    /**
     * @ORM\OneToMany(targetEntity=Flotteur::class, mappedBy="flottabiliter")
     */
    private $flotteurs;

    /**
     * @ORM\OneToMany(targetEntity=Segment::class, mappedBy="flottabiliter")
     */
    private $segments;

    public function __construct()
    {
        $this->flotteurs = new ArrayCollection();
        $this->segments = new ArrayCollection();
    }
    public function __toString(): string
    {
        return $this->nomFlottabiliter;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFlottabiliter(): ?string
    {
        return $this->nomFlottabiliter;
    }

    public function setNomFlottabiliter(string $nomFlottabiliter): self
    {
        $this->nomFlottabiliter = $nomFlottabiliter;

        return $this;
    }

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(int $volume): self
    {
        $this->volume = $volume;

        return $this;
    }

    public function getKgf(): ?float
    {
        return $this->kgf;
    }

    public function setKgf(float $kgf): self
    {
        $this->kgf = $kgf;

        return $this;
    }

    /**
     * @return Collection<int, Flotteur>
     */
    public function getFlotteurs(): Collection
    {
        return $this->flotteurs;
    }

    public function addFlotteur(Flotteur $flotteur): self
    {
        if (!$this->flotteurs->contains($flotteur)) {
            $this->flotteurs[] = $flotteur;
            $flotteur->setFlottabiliter($this);
        }

        return $this;
    }

    public function removeFlotteur(Flotteur $flotteur): self
    {
        if ($this->flotteurs->removeElement($flotteur)) {
            // set the owning side to null (unless already changed)
            if ($flotteur->getFlottabiliter() === $this) {
                $flotteur->setFlottabiliter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Segment>
     */
    public function getSegments(): Collection
    {
        return $this->segments;
    }

    public function addSegment(Segment $segment): self
    {
        if (!$this->segments->contains($segment)) {
            $this->segments[] = $segment;
            $segment->setFlottabiliter($this);
        }

        return $this;
    }

    public function removeSegment(Segment $segment): self
    {
        if ($this->segments->removeElement($segment)) {
            // set the owning side to null (unless already changed)
            if ($segment->getFlottabiliter() === $this) {
                $segment->setFlottabiliter(null);
            }
        }

        return $this;
    }
}