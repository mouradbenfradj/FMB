<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lanterne
 *
 * @ORM\Table(name="lanterne", indexes={@ORM\Index(name="IDX_6C206D1854AF5F27", columns={"magasin"})})
 * @ORM\Entity
 */
class Lanterne
{
    /**
     * @var string
     *
     * @ORM\Column(name="nomLanterne", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nomlanterne;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrpoche", type="integer", nullable=false)
     */
    private $nbrpoche;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrtotaleEnStock", type="integer", nullable=false)
     */
    private $nbrtotaleenstock;

    /**
     * @var \Magasins
     *
     * @ORM\ManyToOne(targetEntity="Magasins")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="magasin", referencedColumnName="id_magasin")
     * })
     */
    private $magasin;

    public function getNomlanterne(): ?string
    {
        return $this->nomlanterne;
    }

    public function getNbrpoche(): ?int
    {
        return $this->nbrpoche;
    }

    public function setNbrpoche(int $nbrpoche): self
    {
        $this->nbrpoche = $nbrpoche;

        return $this;
    }

    public function getNbrtotaleenstock(): ?int
    {
        return $this->nbrtotaleenstock;
    }

    public function setNbrtotaleenstock(int $nbrtotaleenstock): self
    {
        $this->nbrtotaleenstock = $nbrtotaleenstock;

        return $this;
    }

    public function getMagasin(): ?Magasins
    {
        return $this->magasin;
    }

    public function setMagasin(?Magasins $magasin): self
    {
        $this->magasin = $magasin;

        return $this;
    }


}
