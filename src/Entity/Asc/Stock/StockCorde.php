<?php

namespace App\Entity\Asc\Stock;


use App\Entity\Asc\Conteneur\Corde;
use App\Entity\Asc\FiliereComposite\Emplacement;
use App\Interfaces\Visiteur\Operation\EntityInterface;
use App\Interfaces\Visiteur\Operation\OperationInterface;
use App\Repository\Asc\Stock\StockCordeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
  
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

    /**
     * @ORM\ManyToOne(targetEntity=StockArticleSn::class, inversedBy="stockCordes")
     */
    private $stockArticleSn;

    /**
     * @ORM\ManyToOne(targetEntity=Emplacement::class, inversedBy="stockCordes")
     */
    private $emplacement;

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

    public function accept(OperationInterface $operationInterface) {}
    public function preparation(OperationInterface $operationInterface)
    {
        $operationInterface->preparationCorde($this);
    }
    public function assemblage(OperationInterface $operationInterface) {}
    public function miseAEau(OperationInterface $operationInterface) {}
    public function chaussage(OperationInterface $operationInterface) {}
    public function retraitTransfert(OperationInterface $operationInterface) {}
    public function traitementCommerciale(OperationInterface $operationInterface) {}

    public function getStockArticleSn(): ?StockArticleSn
    {
        return $this->stockArticleSn;
    }

    public function setStockArticleSn(?StockArticleSn $stockArticleSn): self
    {
        $this->stockArticleSn = $stockArticleSn;

        return $this;
    }

    public function getEmplacement(): ?Emplacement
    {
        return $this->emplacement;
    }

    public function setEmplacement(?Emplacement $emplacement): self
    {
        $this->emplacement = $emplacement;

        return $this;
    }
}
