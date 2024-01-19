<?php

namespace App\Entity\Asc\FiliereComposite;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Asc\FiliereComposite\FlotteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
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
     * @ORM\ManyToOne(targetEntity=Segment::class, inversedBy="flotteurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $segment;


    /**
     * @ORM\OneToMany(targetEntity=Emplacement::class, mappedBy="flotteur",cascade={"persist"})
     */
    private $emplacements;

    /**
     * @ORM\ManyToOne(targetEntity=Flottabiliter::class, inversedBy="flotteurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $flottabiliter;

    public function __construct()
    {
        $this->emplacements = new ArrayCollection();
    }
    public function __toString(): string
    {
        return $this->nomFlotteur;
    }
    public function initFlotteur(Segment $segment, string $nomFlotteur)
    {
        $this->segment = $segment;
        $this->nomFlotteur = $nomFlotteur;
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

    public function getSegment(): ?Segment
    {
        return $this->segment;
    }

    public function setSegment(?Segment $segment): self
    {
        $this->segment = $segment;

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
            $emplacement->setFlotteur($this);
        }

        return $this;
    }

    public function removeEmplacement(Emplacement $emplacement): self
    {
        if ($this->emplacements->removeElement($emplacement)) {
            // set the owning side to null (unless already changed)
            if ($emplacement->getFlotteur() === $this) {
                $emplacement->setFlotteur(null);
            }
        }

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function generateEmplacement()
    {
        for ($place = 1; $place <= 10; $place++) {
            $emplacement = new Emplacement();
            $emplacement->setPlace($place);
            $this->addEmplacement($emplacement);
        }
    }

    public function getFlottabiliter(): ?Flottabiliter
    {
        return $this->flottabiliter;
    }

    public function setFlottabiliter(?Flottabiliter $flottabiliter): self
    {
        $this->flottabiliter = $flottabiliter;

        return $this;
    }
}