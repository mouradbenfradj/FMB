<?php

namespace App\Entity\Asc\LifeProcess;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Asc\LifeProcess\ProcessusRepository;

/**
 * @ORM\Entity(repositoryClass=ProcessusRepository::class)
 */
class Processus
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
    private $nomProcessus;

    /**
     * @ORM\OneToMany(targetEntity=Cycle::class, mappedBy="processus")
     */
    private $cycles;

    /**
     * @ORM\ManyToOne(targetEntity=Phase::class, inversedBy="process")
     * @ORM\JoinColumn(nullable=false)
     */
    private $phase;

    public function __construct()
    {
        $this->cycles = new ArrayCollection();
    }
    public function __toString(): string
    {
        return $this->nomProcessus;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProcessus(): ?string
    {
        return $this->nomProcessus;
    }

    public function setNomProcessus(string $nomProcessus): self
    {
        $this->nomProcessus = $nomProcessus;

        return $this;
    }

    /**
     * @return Collection<int, Cycle>
     */
    public function getCycles(): Collection
    {
        return $this->cycles;
    }

    public function addCycle(Cycle $cycle): self
    {
        if (!$this->cycles->contains($cycle)) {
            $this->cycles[] = $cycle;
            $cycle->setProcessus($this);
        }

        return $this;
    }

    public function removeCycle(Cycle $cycle): self
    {
        if ($this->cycles->removeElement($cycle)) {
            // set the owning side to null (unless already changed)
            if ($cycle->getProcessus() === $this) {
                $cycle->setProcessus(null);
            }
        }

        return $this;
    }

    public function getPhase(): ?Phase
    {
        return $this->phase;
    }

    public function setPhase(?Phase $phase): self
    {
        $this->phase = $phase;

        return $this;
    }
}
