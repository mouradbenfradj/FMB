<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * PochesBs
 *
 * @ORM\Table(name="poches_bs", indexes={@ORM\Index(name="IDX_90E7094254AF5F27", columns={"magasin"})})
 * @ORM\Entity
 */
class PochesBs
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
     * @ORM\Column(name="nbrTotaleEnStock", type="integer", nullable=false)
     */
    private $nbrtotaleenstock;

    /**
     * @var string
     *
     * @ORM\Column(name="nomPoche", type="string", length=255, nullable=false)
     */
    private $nompoche;

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

    public function getNompoche(): ?string
    {
        return $this->nompoche;
    }

    public function setNompoche(string $nompoche): self
    {
        $this->nompoche = $nompoche;

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
