<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * Segment
 *
 * @ORM\Table(name="segment", indexes={@ORM\Index(name="IDX_1881F565180AA129", columns={"filiere_id"})})
 * @ORM\Entity
 */
class Segment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nomSegment", type="string", length=255, nullable=false)
     */
    private $nomsegment;

    /**
     * @var string
     *
     * @ORM\Column(name="longeur", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $longeur;

    /**
     * @var \Filiere
     *
     * @ORM\ManyToOne(targetEntity="Filiere")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="filiere_id", referencedColumnName="id")
     * })
     */
    private $filiere;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomsegment(): ?string
    {
        return $this->nomsegment;
    }

    public function setNomsegment(string $nomsegment): self
    {
        $this->nomsegment = $nomsegment;

        return $this;
    }

    public function getLongeur(): ?string
    {
        return $this->longeur;
    }

    public function setLongeur(string $longeur): self
    {
        $this->longeur = $longeur;

        return $this;
    }

    public function getFiliere(): ?Filiere
    {
        return $this->filiere;
    }

    public function setFiliere(?Filiere $filiere): self
    {
        $this->filiere = $filiere;

        return $this;
    }


}
