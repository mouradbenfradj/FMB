<?php

namespace App\Entity;

use App\Repository\FiliereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FiliereRepository::class)]
class Filiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomFiliere = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $observation = null;

    #[ORM\ManyToOne(inversedBy: 'filieres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Parc $parc = null;

    #[ORM\Column]
    private ?bool $aireDeTravaille = null;

    /**
     * @var Collection<int, Segment>
     */
    #[ORM\OneToMany(targetEntity: Segment::class, mappedBy: 'filiere', orphanRemoval: true, cascade: ['persist'])]
    private Collection $segments;


    public function __toString(): string
    {
        return $this->parc . '->' . $this->nomFiliere;
    }

    public function getNombreEmplacements(): ?int
    {
        $nbr = 0;
        foreach ($this->segments as $segment) {
            $nbr += $segment->getNombreEmplacements();
        }
        return $nbr;
    }

    public function getTotaleCordes(): ?int
    {
        $nbr = 0;
        foreach ($this->segments as $segment) {
            $nbr += $segment->getTotaleCordes();
        }
        return $nbr;
    }


    public function getFlottabiliter(): float
    {
        $somme = 0;
        foreach ($this->segments as $segment) {
            $somme += $segment->getFlottabiliter();
        }
        if (!$somme) {
            return 1;
        }
        return $somme;
    }

    public function getPoidCordes(): int
    {
        $somme = 0;
        foreach ($this->segments as $segment)
            $somme += $segment->getPoidCordes();
        return $somme;
    }
    public function getVolumesTotale(): float
    {
        $somme = 0;
        foreach ($this->segments as $segment) {
            $somme += $segment->getVolumesTotale();
        }
        if (!$somme) {
            return 1;
        }
        return $somme;
    }
    public function getNombreEmplacementsVide(): int
    {
        $somme = 0;
        foreach ($this->segments as $segment) {
            $somme += $segment->getNombreEmplacementsVide();
        }
        return $somme;
    }
    public function getNombreEmplacementsRemplit(): int
    {
        $somme = 0;
        foreach ($this->segments as $segment) {
            $somme += $segment->getTotaleCordes();
        }
        return $somme;
    }
    public function __construct()
    {
        $this->segments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFiliere(): ?string
    {
        return $this->nomFiliere;
    }

    public function setNomFiliere(string $nomFiliere): static
    {
        $this->nomFiliere = $nomFiliere;

        return $this;
    }

    public function getObservation(): ?array
    {
        return $this->observation;
    }

    public function setObservation(?array $observation): static
    {
        $this->observation = $observation;

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

    public function isAireDeTravaille(): ?bool
    {
        return $this->aireDeTravaille;
    }

    public function setAireDeTravaille(bool $aireDeTravaille): static
    {
        $this->aireDeTravaille = $aireDeTravaille;

        return $this;
    }

    /**
     * @return Collection<int, Segment>
     */
    public function getSegments(): Collection
    {
        return $this->segments;
    }

    public function addSegment(Segment $segment): static
    {
        if (!$this->segments->contains($segment)) {
            $this->segments->add($segment);
            $segment->setFiliere($this);
        }

        return $this;
    }

    public function removeSegment(Segment $segment): static
    {
        if ($this->segments->removeElement($segment)) {
            // set the owning side to null (unless already changed)
            if ($segment->getFiliere() === $this) {
                $segment->setFiliere(null);
            }
        }

        return $this;
    }
}
