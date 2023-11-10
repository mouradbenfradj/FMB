<?php

namespace App\Entity\Asc\Stock;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 */
abstract class StockConteneur
{

    /**
     * @ORM\Column(type="integer")
     */
    private $quantiter;

    /**
     * @ORM\Column(type="boolean")
     */
    private $pret;

    public function getQuantiter(): ?int
    {
        return $this->quantiter;
    }

    public function setQuantiter(int $quantiter): self
    {
        $this->quantiter = $quantiter;

        return $this;
    }

    public function isPret(): ?bool
    {
        return $this->pret;
    }

    public function setPret(bool $pret): self
    {
        $this->pret = $pret;

        return $this;
    }
}