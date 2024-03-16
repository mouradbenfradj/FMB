<?php

namespace App\Entity\Asc\FiliereComposite;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Asc\Conteneur\Corde;
use App\Entity\Asc\Conteneur\Lanterne;
use App\Entity\Asc\Conteneur\Poche;
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateRemplissage;

    /**
     * @ORM\ManyToOne(targetEntity=Segment::class, inversedBy="emplacements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $segment;

    private $flotteur;
    /**
     * Undocumented function
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->place;
    }
    /**
     * Undocumented function
     *
     * @param integer $place
     * @return void
     */
    public function initEmplacement(int $place)
    {
        $this->place = $place;
    }
    /**
     * Undocumented function
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Undocumented function
     *
     * @return integer|null
     */
    public function getPlace(): ?int
    {
        return $this->place;
    }

    /**
     * Undocumented function
     *
     * @param integer $place
     * @return self
     */
    public function setPlace(int $place): self
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param \DateTimeInterface $dateRemplissage
     * @return void
     */
    public function setDateRemplissage(\DateTimeInterface $dateRemplissage)
    {
        $this->dateRemplissage = $dateRemplissage;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getDateRemplissage()
    {
        return $this->dateRemplissage;
    }

    /**
     * Undocumented function
     *
     * @return Segment|null
     */
    public function getSegment(): ?Segment
    {
        return $this->segment;
    }

    /**
     * Undocumented function
     *
     * @param Segment|null $segment
     * @return self
     */
    public function setSegment(?Segment $segment): self
    {
        $this->segment = $segment;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return FlotteurSegment|null
     */
    public function getFlotteur(): ?FlotteurSegment
    {
        return $this->flotteur;
    }

    /**
     * Undocumented function
     *
     * @param FlotteurSegment|null $flotteur
     * @return self
     */
    public function setFlotteur(?FlotteurSegment $flotteur): self
    {
        $this->flotteur = $flotteur;

        return $this;
    }
}
