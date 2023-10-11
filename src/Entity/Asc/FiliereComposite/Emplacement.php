<?php

namespace App\Entity\Asc\FiliereComposite;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Asc\FiliereComposite\EmplacementRepository;
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
     * @ORM\ManyToOne(targetEntity=Flotteur::class, inversedBy="emplacements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $flotteur;


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
}
