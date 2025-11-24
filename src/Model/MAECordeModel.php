<?php

namespace App\Model;

use App\Entity\Corde;
use App\Entity\FruitDeMer;
use App\Entity\Phase;
use App\Entity\Processus;
use App\Entity\Stock;
use App\Entity\StockArticle;
use App\Entity\StockArticleSn;
use DateTime;

class MAECordeModel
{
    private ?Stock $stocks = null;
    private ?Corde $corde = null;
    private ?DateTime $datedeMAE = null;
    private ?string $disponibiliter = null;
    private ?FruitDeMer $fruitDeMer = null;
    private ?StockArticle $article = null;
    private ?StockArticleSn $lot = null;
    private ?Phase $phase = null;
    private ?Processus $processus = null;

    private ?int $densiter = null;

    public function getDensiter(): ?int
    {
        return $this->densiter;
    }
    public function setDensiter(?int $densiter): self
    {
        $this->densiter = $densiter;
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

    public function getArticle(): ?StockArticle
    {
        return $this->article;
    }

    public function setArticle(?StockArticle $article): self
    {
        $this->article = $article;
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
    public function getDisponibiliter(): ?string
    {
        return $this->disponibiliter;
    }
    public function setDisponibiliter(?string $disponibiliter): self
    {
        $this->disponibiliter = $disponibiliter;
        return $this;
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

    public function getDatedeMAE(): ?DateTime
    {
        return $this->datedeMAE;
    }

    public function setDatedeMAE(?DateTime $datedeMAE): self
    {
        $this->datedeMAE = $datedeMAE;
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

    /**
     * Get the value of phase
     */
    public function getPhase()
    {
        return $this->phase;
    }

    /**
     * Set the value of phase
     *
     * @return  self
     */
    public function setPhase($phase)
    {
        $this->phase = $phase;

        return $this;
    }

    /**
     * Get the value of processus
     */
    public function getProcessus()
    {
        return $this->processus;
    }

    /**
     * Set the value of processus
     *
     * @return  self
     */
    public function setProcessus($processus)
    {
        $this->processus = $processus;

        return $this;
    }
}
