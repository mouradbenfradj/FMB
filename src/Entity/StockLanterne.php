<?php

namespace App\Entity;

use App\Entity\Lanterne;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\StockMateriel;
use Doctrine\DBAL\Types\Types;
use App\Repository\StockLanterneRepository;

#[ORM\Entity(repositoryClass: StockLanterneRepository::class)]
#[ORM\DiscriminatorValue('lanterne')]
class StockLanterne extends StockMateriel
{
    #[ORM\ManyToOne(inversedBy: 'stockLanternes')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Lanterne $lanterne = null;

    public function __toString(): string
    {
        return $this->lanterne->getNomLanterne();
    }

    public function getLanterne(): ?Lanterne
    {
        return $this->lanterne;
    }

    public function setLanterne(?Lanterne $lanterne): static
    {
        $this->lanterne = $lanterne;

        return $this;
    }
}
