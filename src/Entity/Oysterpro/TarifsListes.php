<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * TarifsListes
 *
 * @ORM\Table(name="tarifs_listes")
 * @ORM\Entity
 */
class TarifsListes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_tarif", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTarif;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_tarif", type="string", length=32, nullable=false)
     */
    private $libTarif;

    /**
     * @var string
     *
     * @ORM\Column(name="desc_tarif", type="text", length=16777215, nullable=false)
     */
    private $descTarif;

    /**
     * @var string
     *
     * @ORM\Column(name="marge_moyenne", type="string", length=32, nullable=false)
     */
    private $margeMoyenne;

    /**
     * @var int
     *
     * @ORM\Column(name="ordre", type="smallint", nullable=false)
     */
    private $ordre;

    public function getIdTarif(): ?int
    {
        return $this->idTarif;
    }

    public function getLibTarif(): ?string
    {
        return $this->libTarif;
    }

    public function setLibTarif(string $libTarif): self
    {
        $this->libTarif = $libTarif;

        return $this;
    }

    public function getDescTarif(): ?string
    {
        return $this->descTarif;
    }

    public function setDescTarif(string $descTarif): self
    {
        $this->descTarif = $descTarif;

        return $this;
    }

    public function getMargeMoyenne(): ?string
    {
        return $this->margeMoyenne;
    }

    public function setMargeMoyenne(string $margeMoyenne): self
    {
        $this->margeMoyenne = $margeMoyenne;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }


}
