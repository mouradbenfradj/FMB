<?php

namespace App\Model;

use DateTime;
use App\Entity\Stock;
use App\Entity\Lanterne;
use App\Entity\FruitDeMer;
use App\Entity\StockArticle;
use App\Entity\StockArticleSn;

class PreparationLanterneModel
{
    private ?Stock $stocks = null;
    private ?Lanterne $lanterne = null;
    private ?string $nombre = null;
    private ?DateTime $datedecreation = null;
    private ?FruitDeMer $fruitDeMer = null;
    private ?StockArticle $article = null;
    private ?StockArticleSn $lot = null;
    private ?int $densite = null;
    private ?int $nbrEnStock = null;
    private ?int $totalqte = null;

    private ?string $submit = null;



    public function getTotalqte(): ?int
    {
        return $this->totalqte;
    }

    public function setTotalqte(?int $totalqte): self
    {
        $this->totalqte = $totalqte;
        return $this;
    }
    public function getNbrEnStock(): ?int
    {
        return $this->nbrEnStock;
    }

    public function setNbrEnStock(?int $nbrEnStock): self
    {
        $this->nbrEnStock = $nbrEnStock;
        return $this;
    }
    public function getSubmit(): ?string
    {
        return $this->submit;
    }

    public function setSubmit(?string $submit): self
    {
        $this->submit = $submit;
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
    public function getStocks(): ?Stock
    {
        return $this->stocks;
    }

    public function setStocks(?Stock $stocks): self
    {
        $this->stocks = $stocks;
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

    public function getFruitDeMer(): ?FruitDeMer
    {
        return $this->fruitDeMer;
    }

    public function setFruitDeMer(?FruitDeMer $fruitDeMer): self
    {
        $this->fruitDeMer = $fruitDeMer;
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

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;
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

    public function getArticle(): ?StockArticle
    {
        return $this->article;
    }

    public function setArticle(?StockArticle $article): self
    {
        $this->article = $article;
        return $this;
    }
}
