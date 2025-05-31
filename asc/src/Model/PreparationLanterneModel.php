<?php

namespace App\Model;

use App\Entity\Articles;
use App\Entity\FruitDeMer;
use App\Entity\Lanterne;
use App\Entity\Stock;
use App\Entity\StockArticle;
use App\Entity\StockArticleSn;
use DateTime;

class PreparationLanterneModel
{
    private ?Stock $stocks = null;
    private ?FruitDeMer $fruitDeMer = null;
    private ?Lanterne $lanterne = null;
    private ?int $quantiteEnStock = null;
    private ?int $totalqte = null;
    private ?int $densite = null;
    private ?string $submit = null;
    private ?DateTime $datedecreation = null;
    private ?StockArticle $article = null;
    private ?StockArticleSn $lot = null;

    private ?string $nombre = null;

    public function getSubmit(): ?string
    {
        return $this->submit;
    }

    public function setSubmit(?string $submit): self
    {
        $this->submit = $submit;
        return $this;
    }
    public function getDatedecreation(): ?DateTime
    {
        return $this->datedecreation;
    }

    public function setDatedecreation(?DateTime $datedecreation): self
    {
        $this->datedecreation = $datedecreation;
        return $this;
    }

    public function getLot(): ?StockArticleSn
    {
        return $this->lot;
    }

    public function setLot(?StockArticleSn $lot): self
    {
        $this->lot = $lot;
        return $this;
    }
    public function getDensite(): ?int
    {
        return $this->densite;
    }

    public function setDensite(?int $densite): self
    {
        $this->densite = $densite;
        return $this;
    }
    public function getTotalqte(): ?int
    {
        return $this->totalqte;
    }

    public function setTotalqte(?int $totalqte): self
    {
        $this->totalqte = $totalqte;
        return $this;
    }
    public function getQuantiteEnStock(): ?int
    {
        return $this->quantiteEnStock;
    }

    public function setQuantiteEnStock(?int $quantiteEnStock): self
    {
        $this->quantiteEnStock = $quantiteEnStock;
        return $this;
    }
    public function getLanterne(): ?Lanterne
    {
        return $this->lanterne;
    }

    public function setLanterne(?Lanterne $lanterne): self
    {
        $this->lanterne = $lanterne;
        return $this;
    }
    public function getArticle(): ?StockArticle
    {
        return $this->article;
    }

    public function setArticle(?StockArticle $article): self
    {
        $this->article = $article;
        return $this;
    }
    public function getStocks(): ?Stock
    {
        return $this->stocks;
    }

    public function setStocks(?Stock $stocks): self
    {
        $this->stocks = $stocks;
        return $this;
    }

    public function getFruitDeMer(): ?FruitDeMer
    {
        return $this->fruitDeMer;
    }

    public function setFruitDeMer(?FruitDeMer $fruitDeMer): self
    {
        $this->fruitDeMer = $fruitDeMer;
        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;
        return $this;
    }
}
