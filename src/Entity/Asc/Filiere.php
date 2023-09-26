<?php

namespace App\Entity\Asc;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Asc\Parc;
use App\Repository\Asc\FiliereRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Filiere 
 * @ApiResource()
 * @ORM\Entity(repositoryClass=FiliereRepository::class)
 */
class Filiere
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
    private $nomFiliere;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $observation = [];

    /**
     * @ORM\ManyToOne(targetEntity=Parc::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $parc;

    /**
     * @ORM\Column(type="boolean")
     */
    private $aireDeTravaille;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFiliere(): ?string
    {
        return $this->nomFiliere;
    }

    public function setNomFiliere(string $nomFiliere): self
    {
        $this->nomFiliere = $nomFiliere;

        return $this;
    }

    public function getObservation(): ?array
    {
        return $this->observation;
    }

    public function setObservation(?array $observation): self
    {
        $this->observation = $observation;

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

    public function isAireDeTravaille(): ?bool
    {
        return $this->aireDeTravaille;
    }

    public function setAireDeTravaille(bool $aireDeTravaille): self
    {
        $this->aireDeTravaille = $aireDeTravaille;

        return $this;
    }

}
