<?php

namespace App\Entity\Asc;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Asc\FlotteurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=FlotteurRepository::class)
 */
class Flotteur
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
    private $nomFlotteur;

    /**
     * @ORM\ManyToOne(targetEntity=Segment::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $segment;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFlotteur(): ?string
    {
        return $this->nomFlotteur;
    }

    public function setNomFlotteur(string $nomFlotteur): self
    {
        $this->nomFlotteur = $nomFlotteur;

        return $this;
    }

    public function getSegment(): ?Segment
    {
        return $this->segment;
    }

    public function setSegment(?Segment $segment): self
    {
        $this->segment = $segment;

        return $this;
    }
}
