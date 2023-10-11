<?php

namespace App\Entity\Asc\Stock;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Asc\Stock\StockLanterneRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=StockLanterneRepository::class)
 */
class StockLanterne
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
