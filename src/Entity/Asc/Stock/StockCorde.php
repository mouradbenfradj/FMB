<?php

namespace App\Entity\Asc\Stock;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Asc\Stock\StockCordeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=StockCordeRepository::class)
 */
class StockCorde
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
