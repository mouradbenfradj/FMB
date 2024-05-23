<?php

namespace App\Entity\Asc\Stock;

 
use App\Repository\Asc\Stock\StockPocheRepository;
use Doctrine\ORM\Mapping as ORM;

/**
  
 * @ORM\Entity(repositoryClass=StockPocheRepository::class)
 */
class StockPoche
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
