<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Corde
 *
 * @ORM\Table(name="corde", indexes={@ORM\Index(name="IDX_10C99A9F54AF5F27", columns={"magasin"})})
 * @ORM\Entity
 */
class Corde
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
     * @var int
     *
     * @ORM\Column(name="nbrtotaleEnStock", type="integer", nullable=false)
     */
    private $nbrtotaleenstock;

    /**
     * @var string
     *
     * @ORM\Column(name="nomCorde", type="string", length=255, nullable=false)
     */
    private $nomcorde;

    /**
     * @var \Magasins
     *
     * @ORM\ManyToOne(targetEntity="Magasins")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="magasin", referencedColumnName="id_magasin")
     * })
     */
    private $magasin;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNomcorde(): ?string
    {
        return $this->nomcorde;
    }

    public function setNomcorde(string $nomcorde): self
    {
        $this->nomcorde = $nomcorde;

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
