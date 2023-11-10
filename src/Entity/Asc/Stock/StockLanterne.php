<?php

namespace App\Entity\Asc\Stock;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Interfaces\Visiteur\Operation\EntityInterface;
use App\Interfaces\Visiteur\Operation\OperationInterface;
use App\Repository\Asc\Stock\StockLanterneRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=StockLanterneRepository::class)
 */
class StockLanterne extends StockConteneur implements EntityInterface
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

    public function accept(OperationInterface $operationInterface)
    {
    }
    public function preparation(OperationInterface $operationInterface)
    {
        $operationInterface->preparationLanterne($this);
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