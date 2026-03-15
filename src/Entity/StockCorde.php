<?php

namespace App\Entity;

use App\Entity\Corde;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use App\Service\MouleCalculator;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\StockCordeRepository;

#[ORM\Entity(repositoryClass: StockCordeRepository::class)]
#[ORM\DiscriminatorValue('corde')]
//#[ApiResource]
class StockCorde extends StockMateriel
{
    #[ORM\Column]
    private ?float $longeur = null;

    #[ORM\ManyToOne(inversedBy: 'stockCordes')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Corde $corde = null;

    #[ORM\Column]
    private ?bool $chaussement = false;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateassemblage = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $datechaussement = null;

    public function __toString()
    {
        return $this->corde->getNom();
    }

    public function getLongeur(): ?float
    {
        return $this->longeur;
    }

    public function setLongeur(float $longeur): static
    {
        $this->longeur = $longeur;

        return $this;
    }

    public function getCorde(): ?Corde
    {
        return $this->corde;
    }

    public function setCorde(?Corde $corde): static
    {
        $this->corde = $corde;

        return $this;
    }

    public function isChaussement(): ?bool
    {
        return $this->chaussement;
    }

    public function setChaussement(bool $chaussement): static
    {
        $this->chaussement = $chaussement;

        return $this;
    }

    public function getDateassemblage(): ?\DateTimeInterface
    {
        return $this->dateassemblage;
    }

    public function setDateassemblage(?\DateTimeInterface $dateassemblage): static
    {
        $this->dateassemblage = $dateassemblage;

        return $this;
    }

    public function getDatechaussement(): ?\DateTimeInterface
    {
        return $this->datechaussement;
    }

    public function setDatechaussement(?\DateTimeInterface $datechaussement): static
    {
        $this->datechaussement = $datechaussement;

        return $this;
    }
}