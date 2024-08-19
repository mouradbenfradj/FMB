<?php

namespace App\Entity\Asc\FiliereComposite;


use App\Repository\Asc\FiliereComposite\FlotteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
  
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass=FlotteurRepository::class)
 */
class Flotteur
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
    private $nomFlotteur;
    /**
     * @ORM\Column(type="integer")
     */
    private $volume;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $kgf;

    /**
     * @ORM\Column(type="float")
     */
    private $taux;

    /**
     * @ORM\OneToMany(targetEntity=FlotteurSegment::class, mappedBy="flotteur")
     */
    private $flotteurSegments;

    public function __construct()
    {
        $this->flotteurSegments = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->nomFlotteur;
    }
    public function initFlotteur(string $nomFlotteur, int $volume, float $kgf, float $taux)
    {
        $this->nomFlotteur = $nomFlotteur;
        $this->volume = $volume;
        $this->taux = $taux;
        $this->kgf = $kgf;
    }
    /**
     * @ORM\PrePersist
     */
    public function calculeKfg()
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

    public function setNomFlotteur(string $nomFlotteur): self
    {
        $this->nomFlotteur = $nomFlotteur;

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

    public function setKgf(?float $kgf): self
    {
        $this->kgf = $kgf;

        return $this;
    }

    public function getTaux(): ?float
    {
        return $this->taux;
    }

    public function setTaux(float $taux): self
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

    public function addFlotteurSegment(FlotteurSegment $flotteurSegment): self
    {
        if (!$this->flotteurSegments->contains($flotteurSegment)) {
            $this->flotteurSegments[] = $flotteurSegment;
            $flotteurSegment->setFlotteur($this);
        }

        return $this;
    }

    public function removeFlotteurSegment(FlotteurSegment $flotteurSegment): self
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
