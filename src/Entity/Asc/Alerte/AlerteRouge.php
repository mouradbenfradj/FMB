<?php

namespace App\Entity\Asc\Alerte;

use App\Entity\Asc\LifeProcess\Cycle;
use App\Repository\Asc\Alerte\AlerteRougeRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=AlerteRougeRepository::class)
 */
class AlerteRouge  extends Alerte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Cycle::class, mappedBy="alerteRouge")
     */
    private $cycles;

    public function __construct()
    {
        $this->cycles = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
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
            $cycle->setAlerteRouge($this);
        }

        return $this;
    }

    public function removeCycle(Cycle $cycle): self
    {
        if ($this->cycles->removeElement($cycle)) {
            // set the owning side to null (unless already changed)
            if ($cycle->getAlerteRouge() === $this) {
                $cycle->setAlerteRouge(null);
            }
        }

        return $this;
    }
}
