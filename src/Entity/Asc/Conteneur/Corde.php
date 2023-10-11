<?php

namespace App\Entity\Asc\Conteneur;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Asc\Parc;
use App\Repository\Asc\Conteneur\CordeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CordeRepository::class)
 */
class Corde
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Parc::class, inversedBy="cordes")
     */
    private $parc;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantiter;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomCorde;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParc(): ?Parc
    {
        return $this->parc;
    }

    public function setParc(?Parc $parc): self
    {
        $this->parc = $parc;

        return $this;
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

    public function getNomCorde(): ?string
    {
        return $this->nomCorde;
    }

    public function setNomCorde(string $nomCorde): self
    {
        $this->nomCorde = $nomCorde;

        return $this;
    }
}
