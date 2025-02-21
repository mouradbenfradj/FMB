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

    public function __construct()
    {
        $this->filieres = new ArrayCollection();
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
}
