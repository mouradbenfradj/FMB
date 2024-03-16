<?php

namespace App\Entity\Asc\FiliereComposite;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Asc\FiliereComposite\SegmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\HasLifecycleCallbacks()
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
     * @ORM\Column(type="float")
     */
    private $pas = 1;

    /**
     * @ORM\Column(type="float")
     */
    private $longeur = 1;

    /**
     * @ORM\ManyToOne(targetEntity=Filiere::class, inversedBy="segments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $filiere;

    /**
     * @ORM\OneToMany(targetEntity=Emplacement::class, mappedBy="segment",cascade={"persist"},fetch="EAGER")
     */
    private $emplacements;

    /**
     * @ORM\OneToMany(targetEntity=FlotteurSegment::class, mappedBy="segment",cascade={"persist"},fetch="EAGER")
     */
    private $flotteurSegments;

    public function __construct()
    {
        $this->emplacements = new ArrayCollection();
        $this->flotteurSegments = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->nomSegment;
    }

    /**
     * @ORM\PrePersist
     */
    public function generateEmplacement()
    {
        for ($place = 1; $place <= ($this->longeur / $this->pas); $place++) {
            $emplacement = new Emplacement();
            $emplacement->setPlace($place);
            $this->addEmplacement($emplacement);
        }
    }



    public function initSegment(Filiere $filiere, string $nomSegment, float $pas, float $longeur)
    {
        $this->filiere = $filiere;
        $this->nomSegment = $nomSegment;
        $this->longeur = $longeur;
        $this->pas = $pas;
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
     * @return Collection<int, Emplacement>
     */
    public function getEmplacements(): Collection
    {
        return $this->emplacements;
    }

    public function addEmplacement(Emplacement $emplacement): self
    {
        if (!$this->emplacements->contains($emplacement)) {
            $this->emplacements[] = $emplacement;
            $emplacement->setSegment($this);
        }

        return $this;
    }

    public function removeEmplacement(Emplacement $emplacement): self
    {
        if ($this->emplacements->removeElement($emplacement)) {
            // set the owning side to null (unless already changed)
            if ($emplacement->getSegment() === $this) {
                $emplacement->setSegment(null);
            }
        }

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return float|null
     */
    public function getPas(): ?float
    {
        return $this->pas;
    }

    public function setPas(float $pas): self
    {
        $this->pas = $pas;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return float|null
     */
    public function getLongeur(): ?float
    {
        return $this->longeur;
    }

    public function setLongeur(float $longeur): self
    {
        $this->longeur = $longeur;

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
            $flotteurSegment->setSegment($this);
        }

        return $this;
    }

    public function removeFlotteurSegment(FlotteurSegment $flotteurSegment): self
    {
        if ($this->flotteurSegments->removeElement($flotteurSegment)) {
            // set the owning side to null (unless already changed)
            if ($flotteurSegment->getSegment() === $this) {
                $flotteurSegment->setSegment(null);
            }
        }

        return $this;
    }
}
