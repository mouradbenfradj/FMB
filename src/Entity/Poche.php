<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Poche
 *
 * @ORM\Table(name="poche", indexes={@ORM\Index(name="IDX_86D8F186524B0562", columns={"stocklanterne_id"})})
 * @ORM\Entity
 */
class Poche
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
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var int
     *
     * @ORM\Column(name="emplacement", type="integer", nullable=false)
     */
    private $emplacement;

    /**
     * @var \StocksLanternes
     *
     * @ORM\ManyToOne(targetEntity="StocksLanternes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="stocklanterne_id", referencedColumnName="id")
     * })
     */
    private $stocklanterne;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getEmplacement(): ?int
    {
        return $this->emplacement;
    }

    public function setEmplacement(int $emplacement): self
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function getStocklanterne(): ?StocksLanternes
    {
        return $this->stocklanterne;
    }

    public function setStocklanterne(?StocksLanternes $stocklanterne): self
    {
        $this->stocklanterne = $stocklanterne;

        return $this;
    }


}
