<?php

namespace App\Entity\Asc\Conteneur;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Asc\Parc;
use App\Entity\Asc\Stock\StockLanterne;
use App\Repository\Asc\Conteneur\PocheRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PocheRepository::class)
 */
class Poche
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $position;

    /**
     * @ORM\Column(type="integer")
     */
    private $piece;



    public function initPoche(StockLanterne $stockLanterne, int $position, string $piece)
    {
        //$this->stockLanterne = $stockLanterne;
        $this->position = $position;
        $this->piece = $piece;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getPiece(): ?int
    {
        return $this->piece;
    }

    public function setPiece(int $piece): self
    {
        $this->piece = $piece;

        return $this;
    }
}