<?php

namespace App\Entity\Asc\FiliereComposite;

 
use App\Repository\Asc\FiliereComposite\EmplacementRepository;
use App\Repository\Asc\FiliereComposite\FlotteurSegmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
  
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass=FlotteurSegmentRepository::class)
 */
class FlotteurSegment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Segment::class, inversedBy="flotteurSegments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $segment;

    /**
     * @ORM\ManyToOne(targetEntity=Flotteur::class, inversedBy="flotteurSegments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $flotteur;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre;

    /**
     * @ORM\Column(type="float")
     */
    private $distanceDeDepart = 0;

    /**
     * @ORM\Column(type="float")
     */
    private $pas = 1;


    public function initFlotteurSegment(Segment $segment, Flotteur $flotteur, int $nombre, float $distanceDeDepart , float $pas)
    {
        $this->segment = $segment;
        $this->flotteur = $flotteur;
        $this->nombre = $nombre;
        $this->distanceDeDepart = $distanceDeDepart;
        $this->pas = $pas;
    }
    public function getId(): ?int
    {
        return $this->id;
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

    public function getFlotteur(): ?Flotteur
    {
        return $this->flotteur;
    }

    public function setFlotteur(?Flotteur $flotteur): self
    {
        $this->flotteur = $flotteur;

        return $this;
    }

    public function getNombre(): ?int
    {
        return $this->nombre;
    }

    public function setNombre(int $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDistanceDeDepart(): ?float
    {
        return $this->distanceDeDepart;
    }

    public function setDistanceDeDepart(float $distanceDeDepart): self
    {
        $this->distanceDeDepart = $distanceDeDepart;

        return $this;
    }

    public function getPas(): ?float
    {
        return $this->pas;
    }

    public function setPas(float $pas): self
    {
        $this->pas = $pas;

        return $this;
    }
}
