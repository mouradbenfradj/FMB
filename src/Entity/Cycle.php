<?php

namespace App\Entity;

use App\Repository\CycleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CycleRepository::class)]
class Cycle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?FruitDeMer $fruitDeMer = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column]
    private ?float $poidsParPiece = null;

    #[ORM\Column]
    private ?float $tauxSurvie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFruitDeMer(): ?FruitDeMer
    {
        return $this->fruitDeMer;
    }

    public function setFruitDeMer(?FruitDeMer $fruitDeMer): static
    {
        $this->fruitDeMer = $fruitDeMer;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getPoidsParPiece(): ?float
    {
        return $this->poidsParPiece;
    }

    public function setPoidsParPiece(float $poidsParPiece): static
    {
        $this->poidsParPiece = $poidsParPiece;

        return $this;
    }

    public function getTauxSurvie(): ?float
    {
        return $this->tauxSurvie;
    }

    public function setTauxSurvie(float $tauxSurvie): static
    {
        $this->tauxSurvie = $tauxSurvie;

        return $this;
    }
}
