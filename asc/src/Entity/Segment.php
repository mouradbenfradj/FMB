<?php

namespace App\Entity;

use App\Repository\SegmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SegmentRepository::class)]
class Segment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomSegment = null;

    #[ORM\Column]
    private ?float $pasEmplacement = null;

    #[ORM\Column]
    private ?float $longeur = null;

    #[ORM\ManyToOne(inversedBy: 'segments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Filiere $filiere = null;

    /**
     * @var Collection<int, FlotteurSegment>
     */
    #[ORM\OneToMany(targetEntity: FlotteurSegment::class, mappedBy: 'segment')]
    private Collection $flotteurSegments;

    /**
     * @var Collection<int, Emplacement>
     */
    #[ORM\OneToMany(targetEntity: Emplacement::class, mappedBy: 'segment')]
    private Collection $emplacements;

    public function __construct()
    {
        $this->flotteurSegments = new ArrayCollection();
        $this->emplacements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSegment(): ?string
    {
        return $this->nomSegment;
    }

    public function setNomSegment(string $nomSegment): static
    {
        $this->nomSegment = $nomSegment;

        return $this;
    }

    public function getPasEmplacement(): ?float
    {
        return $this->pasEmplacement;
    }

    public function setPasEmplacement(float $pasEmplacement): static
    {
        $this->pasEmplacement = $pasEmplacement;

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

    public function getFiliere(): ?Filiere
    {
        return $this->filiere;
    }

    public function setFiliere(?Filiere $filiere): static
    {
        $this->filiere = $filiere;

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
            $flotteurSegment->setSegment($this);
        }

        return $this;
    }

    public function removeFlotteurSegment(FlotteurSegment $flotteurSegment): static
    {
        if ($this->flotteurSegments->removeElement($flotteurSegment)) {
            // set the owning side to null (unless already changed)
            if ($flotteurSegment->getSegment() === $this) {
                $flotteurSegment->setSegment(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Emplacement>
     */
    public function getEmplacements(): Collection
    {
        return $this->emplacements;
    }

    public function addEmplacement(Emplacement $emplacement): static
    {
        if (!$this->emplacements->contains($emplacement)) {
            $this->emplacements->add($emplacement);
            $emplacement->setSegment($this);
        }

        return $this;
    }

    public function removeEmplacement(Emplacement $emplacement): static
    {
        if ($this->emplacements->removeElement($emplacement)) {
            // set the owning side to null (unless already changed)
            if ($emplacement->getSegment() === $this) {
                $emplacement->setSegment(null);
            }
        }

        return $this;
    }
}
