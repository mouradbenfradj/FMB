<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * Magasins
 *
 * @ORM\Table(name="magasins", indexes={@ORM\Index(name="id_tarif", columns={"id_tarif"}), @ORM\Index(name="id_mag_enseigne", columns={"id_mag_enseigne"}), @ORM\Index(name="id_stock", columns={"id_stock"}), @ORM\Index(name="actif", columns={"actif"})})
 * @ORM\Entity
 */
class Magasins
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_magasin", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMagasin;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_magasin", type="string", length=64, nullable=false)
     */
    private $libMagasin;

    /**
     * @var string
     *
     * @ORM\Column(name="abrev_magasin", type="string", length=32, nullable=false)
     */
    private $abrevMagasin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mode_vente", type="string", length=255, nullable=true)
     */
    private $modeVente;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="actif", type="boolean", nullable=true)
     */
    private $actif;

    /**
     * @var \MagasinsEnseignes
     *
     * @ORM\ManyToOne(targetEntity="MagasinsEnseignes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_mag_enseigne", referencedColumnName="id_mag_enseigne")
     * })
     */
    private $idMagEnseigne;

    /**
     * @var \TarifsListes
     *
     * @ORM\ManyToOne(targetEntity="TarifsListes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tarif", referencedColumnName="id_tarif")
     * })
     */
    private $idTarif;

    /**
     * @var \Stocks
     *
     * @ORM\ManyToOne(targetEntity="Stocks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_stock", referencedColumnName="id_stock")
     * })
     */
    private $idStock;

    public function getIdMagasin(): ?int
    {
        return $this->idMagasin;
    }

    public function getLibMagasin(): ?string
    {
        return $this->libMagasin;
    }

    public function setLibMagasin(string $libMagasin): self
    {
        $this->libMagasin = $libMagasin;

        return $this;
    }

    public function getAbrevMagasin(): ?string
    {
        return $this->abrevMagasin;
    }

    public function setAbrevMagasin(string $abrevMagasin): self
    {
        $this->abrevMagasin = $abrevMagasin;

        return $this;
    }

    public function getModeVente(): ?string
    {
        return $this->modeVente;
    }

    public function setModeVente(?string $modeVente): self
    {
        $this->modeVente = $modeVente;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(?bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getIdMagEnseigne(): ?MagasinsEnseignes
    {
        return $this->idMagEnseigne;
    }

    public function setIdMagEnseigne(?MagasinsEnseignes $idMagEnseigne): self
    {
        $this->idMagEnseigne = $idMagEnseigne;

        return $this;
    }

    public function getIdTarif(): ?TarifsListes
    {
        return $this->idTarif;
    }

    public function setIdTarif(?TarifsListes $idTarif): self
    {
        $this->idTarif = $idTarif;

        return $this;
    }

    public function getIdStock(): ?Stocks
    {
        return $this->idStock;
    }

    public function setIdStock(?Stocks $idStock): self
    {
        $this->idStock = $idStock;

        return $this;
    }


}
