<?php

namespace App\Entity\Asc\Stock;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Asc\Conteneur\Corde;
use App\Interfaces\Visiteur\Operation\EntityInterface;
use App\Interfaces\Visiteur\Operation\OperationInterface;
use App\Repository\Asc\Stock\StockCordeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=StockCordeRepository::class)
 */
class StockCorde extends StockConteneur implements EntityInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\ManyToOne(targetEntity=Corde::class, inversedBy="stockCordes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $corde;

    public function getId(): ?int
    {
        return $this->id;
    }





    public function getCorde(): ?Corde
    {
        return $this->corde;
    }

    public function setCorde(?Corde $corde): self
    {
        $this->corde = $corde;

        return $this;
    }

    public function accept(OperationInterface $operationInterface)
    {
    }
    public function preparation(OperationInterface $operationInterface)
    {
        $operationInterface->preparationCorde($this);
    }
    public function assemblage(OperationInterface $operationInterface)
    {
    }
    public function miseAEau(OperationInterface $operationInterface)
    {
    }
    public function chaussage(OperationInterface $operationInterface)
    {
    }
    public function retraitTransfert(OperationInterface $operationInterface)
    {
    }
    public function traitementCommerciale(OperationInterface $operationInterface)
    {
    }
}
