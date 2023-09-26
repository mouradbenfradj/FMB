<?php

namespace App\Entity\Asc;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Asc\EmplacementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=EmplacementRepository::class)
 */
class Emplacement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $place;

    /**
     * @ORM\ManyToOne(targetEntity=Flotteur::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $flotteur;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDeRemplissage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlace(): ?int
    {
        return $this->place;
    }

    public function setPlace(int $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getFlotteur(): ?Flotteur
    {
        return $this->flotteur;
    }

    public function setFlotteur(?Flotteur $flotteur): self
    {
        $this->flotteur = $flotteur;

        return $this;
    }

    public function getDateDeRemplissage(): ?\DateTimeInterface
    {
        return $this->dateDeRemplissage;
    }

    public function setDateDeRemplissage(?\DateTimeInterface $dateDeRemplissage): self
    {
        $this->dateDeRemplissage = $dateDeRemplissage;

        return $this;
    }
}
