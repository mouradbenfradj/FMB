<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProcessusRepository;

#[ORM\Entity(repositoryClass: ProcessusRepository::class)]
class Processus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomProcessus = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $age = null;

    #[ORM\ManyToOne(inversedBy: 'processuses')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Phase $phase;


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

    public function setNomProcessus(string $nomProcessus): static
    {
        $this->nomProcessus = $nomProcessus;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): static
    {
        $this->age = $age;

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
