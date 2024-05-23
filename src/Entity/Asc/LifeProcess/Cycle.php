<?php

namespace App\Entity\Asc\LifeProcess;

use App\Entity\Asc\Alerte\AlerteJaune;
use App\Entity\Asc\Alerte\AlerteRouge;
use App\Entity\Asc\Alerte\AlerteVert;
use App\Repository\Asc\LifeProcess\CycleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CycleRepository::class)
 */
class Cycle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Processus::class, inversedBy="cycles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $processus;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomCycle;

    /**
     * @ORM\ManyToOne(targetEntity=AlerteVert::class, inversedBy="cycles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $alerteVert;

    /**
     * @ORM\ManyToOne(targetEntity=AlerteJaune::class, inversedBy="cycles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $alerteJaune;

    /**
     * @ORM\ManyToOne(targetEntity=AlerteRouge::class, inversedBy="cycles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $alerteRouge;

    /**
     * @ORM\Column(type="integer")
     */
    private $numDebCycle;

    /**
     * @ORM\Column(type="integer")
     */
    private $numFinCycle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $couleurTexte;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $couleurFondText;

    public function __toString(): string
    {
        return $this->nomCycle;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProcessus(): ?Processus
    {
        return $this->processus;
    }

    public function setProcessus(?Processus $processus): self
    {
        $this->processus = $processus;

        return $this;
    }

    public function getNomCycle(): ?string
    {
        return $this->nomCycle;
    }

    public function setNomCycle(string $nomCycle): self
    {
        $this->nomCycle = $nomCycle;

        return $this;
    }

    public function getAlerteVert(): ?AlerteVert
    {
        return $this->alerteVert;
    }

    public function setAlerteVert(?AlerteVert $alerteVert): self
    {
        $this->alerteVert = $alerteVert;

        return $this;
    }

    public function getAlerteJaune(): ?AlerteJaune
    {
        return $this->alerteJaune;
    }

    public function setAlerteJaune(?AlerteJaune $alerteJaune): self
    {
        $this->alerteJaune = $alerteJaune;

        return $this;
    }

    public function getAlerteRouge(): ?AlerteRouge
    {
        return $this->alerteRouge;
    }

    public function setAlerteRouge(?AlerteRouge $alerteRouge): self
    {
        $this->alerteRouge = $alerteRouge;

        return $this;
    }

    public function getNumDebCycle(): ?int
    {
        return $this->numDebCycle;
    }

    public function setNumDebCycle(int $numDebCycle): self
    {
        $this->numDebCycle = $numDebCycle;

        return $this;
    }

    public function getNumFinCycle(): ?int
    {
        return $this->numFinCycle;
    }

    public function setNumFinCycle(int $numFinCycle): self
    {
        $this->numFinCycle = $numFinCycle;

        return $this;
    }

    public function getCouleurTexte(): ?string
    {
        return $this->couleurTexte;
    }

    public function setCouleurTexte(?string $couleurTexte): self
    {
        $this->couleurTexte = $couleurTexte;

        return $this;
    }

    public function getCouleurFondText(): ?string
    {
        return $this->couleurFondText;
    }

    public function setCouleurFondText(?string $couleurFondText): self
    {
        $this->couleurFondText = $couleurFondText;

        return $this;
    }
}