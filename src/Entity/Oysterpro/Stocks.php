<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stocks
 *
 * @ORM\Table(name="stocks", indexes={@ORM\Index(name="ref_adr_stock", columns={"ref_adr_stock"}), @ORM\Index(name="actif", columns={"actif"})})
 * @ORM\Entity
 */
class Stocks
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_stock", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idStock;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_stock", type="string", length=32, nullable=false)
     */
    private $libStock;

    /**
     * @var string
     *
     * @ORM\Column(name="abrev_stock", type="string", length=32, nullable=false)
     */
    private $abrevStock;

    /**
     * @var bool
     *
     * @ORM\Column(name="actif", type="boolean", nullable=false)
     */
    private $actif;

    /**
     * @var \Adresses
     *
     * @ORM\ManyToOne(targetEntity="Adresses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_adr_stock", referencedColumnName="ref_adresse")
     * })
     */
    private $refAdrStock;

    public function getIdStock(): ?int
    {
        return $this->idStock;
    }

    public function getLibStock(): ?string
    {
        return $this->libStock;
    }

    public function setLibStock(string $libStock): self
    {
        $this->libStock = $libStock;

        return $this;
    }

    public function getAbrevStock(): ?string
    {
        return $this->abrevStock;
    }

    public function setAbrevStock(string $abrevStock): self
    {
        $this->abrevStock = $abrevStock;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getRefAdrStock(): ?Adresses
    {
        return $this->refAdrStock;
    }

    public function setRefAdrStock(?Adresses $refAdrStock): self
    {
        $this->refAdrStock = $refAdrStock;

        return $this;
    }


}
