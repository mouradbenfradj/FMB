<?php

namespace App\Entity\Asc\LifeProcess;

use App\Repository\Asc\LifeProcess\PhaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PhaseRepository::class)
 */
class Phase
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
    private $nomPhase;

    /**
     * @ORM\Column(type="integer")
     */
    private $ordreAffichage;

    /**
     * @ORM\OneToMany(targetEntity=Processus::class, mappedBy="phase")
     */
    private $process;

    public function __construct()
    {
        $this->process = new ArrayCollection();
    }
    public function __toString(): string
    {
        return $this->nomPhase;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPhase(): ?string
    {
        return $this->nomPhase;
    }

    public function setNomPhase(string $nomPhase): self
    {
        $this->nomPhase = $nomPhase;

        return $this;
    }

    public function getOrdreAffichage(): ?int
    {
        return $this->ordreAffichage;
    }

    public function setOrdreAffichage(int $ordreAffichage): self
    {
        $this->ordreAffichage = $ordreAffichage;

        return $this;
    }

    /**
     * @return Collection<int, Processus>
     */
    public function getProcess(): Collection
    {
        return $this->process;
    }

    public function addProcess(Processus $process): self
    {
        if (!$this->process->contains($process)) {
            $this->process[] = $process;
            $process->setPhase($this);
        }

        return $this;
    }

    public function removeProcess(Processus $process): self
    {
        if ($this->process->removeElement($process)) {
            // set the owning side to null (unless already changed)
            if ($process->getPhase() === $this) {
                $process->setPhase(null);
            }
        }

        return $this;
    }
}