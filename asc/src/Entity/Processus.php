<?php

namespace App\Entity;

use App\Repository\ProcessusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProcessusRepository::class)]
class Processus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomProcessus = null;

    #[ORM\ManyToOne(inversedBy: 'processuses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Phase $phase = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProcessus(): ?string
    {
        return $this->nomProcessus;
    }

    public function setNomProcessus(string $nomProcessus): static
    {
        $this->nomProcessus = $nomProcessus;

        return $this;
    }

    public function getPhase(): ?Phase
    {
        return $this->phase;
    }

    public function setPhase(?Phase $phase): static
    {
        $this->phase = $phase;

        return $this;
    }
}
