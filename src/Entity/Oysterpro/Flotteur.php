<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * Flotteur
 *
 * @ORM\Table(name="flotteur", indexes={@ORM\Index(name="IDX_8C4208E7DB296AAD", columns={"segment_id"})})
 * @ORM\Entity
 */
class Flotteur
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
     * @ORM\Column(name="nomFlotteur", type="string", length=255, nullable=false)
     */
    private $nomflotteur;

    /**
     * @var \Segment
     *
     * @ORM\ManyToOne(targetEntity="Segment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="segment_id", referencedColumnName="id")
     * })
     */
    private $segment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomflotteur(): ?string
    {
        return $this->nomflotteur;
    }

    public function setNomflotteur(string $nomflotteur): self
    {
        $this->nomflotteur = $nomflotteur;

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
