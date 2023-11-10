<?php

namespace App\Entity\Asc\Conteneur;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 */
abstract class Conteneur
{

    /**
     * @ORM\Column(type="integer")
     */
    private $quantiter;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    public function init(string $nom, int $quantiter)
    {
        $this->nom = $nom;
        $this->quantiter = $quantiter;
    }
    public function getQuantiter(): ?int
    {
        return $this->quantiter;
    }

    public function setQuantiter(int $quantiter): self
    {
        $this->quantiter = $quantiter;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
}