<?php

namespace App\Entity;

use App\Repository\FlotteurSegmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FlotteurSegmentRepository::class)]
class FlotteurSegment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'flotteurSegments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Segment $segment = null;

    #[ORM\ManyToOne(inversedBy: 'flotteurSegments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Flotteur $flotteur = null;

    #[ORM\Column]
    private ?int $nombre = null;

    #[ORM\Column]
    private ?float $distanceDeDepart = null;

    #[ORM\Column]
    private ?float $pasFlotteur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSegment(): ?Segment
    {
        return $this->segment;
    }

    public function setSegment(?Segment $segment): static
    {
        $this->segment = $segment;

        return $this;
    }

    public function getFlotteur(): ?Flotteur
    {
        return $this->flotteur;
    }

    public function setFlotteur(?Flotteur $flotteur): static
    {
        $this->flotteur = $flotteur;

        return $this;
    }

    public function getNombre(): ?int
    {
        return $this->nombre;
    }

    public function setNombre(int $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDistanceDeDepart(): ?float
    {
        return $this->distanceDeDepart;
    }

    public function setDistanceDeDepart(float $distanceDeDepart): static
    {
        $this->distanceDeDepart = $distanceDeDepart;

        return $this;
    }

    public function getPasFlotteur(): ?float
    {
        return $this->pasFlotteur;
    }

    public function setPasFlotteur(float $pasFlotteur): static
    {
        $this->pasFlotteur = $pasFlotteur;

        return $this;
    }
}
