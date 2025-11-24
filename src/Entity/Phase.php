<?php

namespace App\Entity;

use App\Repository\PhaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhaseRepository::class)]
class Phase
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomPhase = null;

    public function __toString(): string
    {
        return $this->nomPhase;
    }
    /**
     * @var Collection<int, Processus>
     */
    #[ORM\OneToMany(targetEntity: Processus::class, mappedBy: 'phase', orphanRemoval: true)]
    private Collection $processuses;

    public function __construct()
    {
        $this->processuses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPhase(): ?string
    {
        return $this->nomPhase;
    }

    public function setNomPhase(string $nomPhase): static
    {
        $this->nomPhase = $nomPhase;

        return $this;
    }

    /**
     * @return Collection<int, Processus>
     */
    public function getProcessuses(): Collection
    {
        return $this->processuses;
    }

    public function addProcessus(Processus $processus): static
    {
        if (!$this->processuses->contains($processus)) {
            $this->processuses->add($processus);
            $processus->setPhase($this);
        }

        return $this;
    }

    public function removeProcessus(Processus $processus): static
    {
        if ($this->processuses->removeElement($processus)) {
            // set the owning side to null (unless already changed)
            if ($processus->getPhase() === $this) {
                $processus->setPhase(null);
            }
        }

        return $this;
    }
}
