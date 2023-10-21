<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * Civilites
 *
 * @ORM\Table(name="civilites", indexes={@ORM\Index(name="lib_civ_court", columns={"lib_civ_court"}), @ORM\Index(name="lib_civ_long", columns={"lib_civ_long"})})
 * @ORM\Entity
 */
class Civilites
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_civilite", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCivilite;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_civ_court", type="string", length=16, nullable=false)
     */
    private $libCivCourt;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_civ_long", type="string", length=64, nullable=false)
     */
    private $libCivLong;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255, nullable=false)
     */
    private $categorie;

    public function getIdCivilite(): ?int
    {
        return $this->idCivilite;
    }

    public function getLibCivCourt(): ?string
    {
        return $this->libCivCourt;
    }

    public function setLibCivCourt(string $libCivCourt): self
    {
        $this->libCivCourt = $libCivCourt;

        return $this;
    }

    public function getLibCivLong(): ?string
    {
        return $this->libCivLong;
    }

    public function setLibCivLong(string $libCivLong): self
    {
        $this->libCivLong = $libCivLong;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }


}
