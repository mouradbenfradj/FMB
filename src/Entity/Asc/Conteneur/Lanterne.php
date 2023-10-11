<?php

namespace App\Entity\Asc\Conteneur;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Asc\Parc;
use App\Repository\Asc\Conteneur\LanterneRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=LanterneRepository::class)
 */
class Lanterne
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
    private $nomLanterne;

    /**
     * @ORM\ManyToOne(targetEntity=Parc::class, inversedBy="lanternes")
     */
    private $parc;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantiter;

    /**
     * @ORM\Column(type="smallint")
     */
    private $nbrPoche;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomLanterne(): ?string
    {
        return $this->nomLanterne;
    }

    public function setNomLanterne(string $nomLanterne): self
    {
        $this->nomLanterne = $nomLanterne;

        return $this;
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

    public function getNbrPoche(): ?int
    {
        return $this->nbrPoche;
    }

    public function setNbrPoche(int $nbrPoche): self
    {
        $this->nbrPoche = $nbrPoche;

        return $this;
    }
}
