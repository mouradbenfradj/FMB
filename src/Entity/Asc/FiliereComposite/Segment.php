<?php

namespace App\Entity\Asc\FiliereComposite;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Asc\FiliereComposite\SegmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SegmentRepository::class)
 */
class Segment
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
    private $nomSegment;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=false)
     */
    private $longeur;

    /**
     * @ORM\ManyToOne(targetEntity=Filiere::class, inversedBy="segments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $filiere;

    /**
     * @ORM\OneToMany(targetEntity=Flotteur::class, mappedBy="segment")
     */
    private $flotteurs;

    public function __construct()
    {
        $this->flotteurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSegment(): ?string
    {
        return $this->nomSegment;
    }

    public function setNomSegment(string $nomSegment): self
    {
        $this->nomSegment = $nomSegment;

        return $this;
    }

    public function getLongeur(): ?string
    {
        return $this->longeur;
    }

    public function setLongeur(string $longeur): self
    {
        $this->longeur = $longeur;

        return $this;
    }

    public function getFiliere(): ?Filiere
    {
        return $this->filiere;
    }

    public function setFiliere(?Filiere $filiere): self
    {
        $this->filiere = $filiere;

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
            $flotteur->setSegment($this);
        }

        return $this;
    }

    public function removeFlotteur(Flotteur $flotteur): self
    {
        if ($this->flotteurs->removeElement($flotteur)) {
            // set the owning side to null (unless already changed)
            if ($flotteur->getSegment() === $this) {
                $flotteur->setSegment(null);
            }
        }

        return $this;
    }
}