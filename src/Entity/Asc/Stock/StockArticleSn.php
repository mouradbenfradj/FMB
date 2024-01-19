<?php

namespace App\Entity\Asc\Stock;

use App\Repository\Asc\Stock\StockArticleSnRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StockArticleSnRepository::class)
 */
class StockArticleSn
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $snQte;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $numeroSerie;

    /**
     * @ORM\ManyToOne(targetEntity=StockArticle::class, inversedBy="stockArticleSns")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stockArticle;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSnQte(): ?float
    {
        return $this->snQte;
    }

    public function setSnQte(float $snQte): self
    {
        $this->snQte = $snQte;

        return $this;
    }

    public function getNumeroSerie(): ?string
    {
        return $this->numeroSerie;
    }

    public function setNumeroSerie(string $numeroSerie): self
    {
        $this->numeroSerie = $numeroSerie;

        return $this;
    }

    public function getStockArticle(): ?StockArticle
    {
        return $this->stockArticle;
    }

    public function setStockArticle(?StockArticle $stockArticle): self
    {
        $this->stockArticle = $stockArticle;

        return $this;
    }
}