<?php

namespace App\Service;

use App\Entity\StockCorde;
use App\Entity\Emplacement;
use App\Entity\StockLanterne;
use App\Service\MouleCalculator;

class EmplacementService
{
    private Emplacement $emplacement;
    private MouleCalculator $mouleCalculator;
    public function __construct(MouleCalculator $mouleCalculator)
    {
        $this->mouleCalculator = $mouleCalculator;
    }
    public function setEmplacementToService(Emplacement $emplacement): void
    {
        $this->emplacement = $emplacement;
    }

    public function isEmpty(): bool
    {
        return $this->emplacement->getStockMateriel() ? true : false;
    }
    public function haseCorde(): bool
    {
        $stockMateriel = $this->emplacement->getStockMateriel();

        if ($stockMateriel instanceof StockCorde) {
            return true;
        }
        return false;
    }
    public function haseLanterne(): bool
    {
        $stockMateriel = $this->emplacement->getStockMateriel();

        if ($stockMateriel instanceof StockLanterne) {
            return true;
        }
        return false;
    }
    public function hasePoche(): bool
    {

        //return $this->emplacement->getStockLanternes()->count() > 0 ? true : false;
        return false;
    }
    public function haseCordeHuitre(): bool
    {
        $stockMateriel = $this->emplacement->getStockMateriel();

        if ($stockMateriel instanceof StockCorde) {
            if ($stockMateriel->getStockArticleSn() && $stockMateriel->getStockArticleSn()->getStockArticle() && $stockMateriel->getStockArticleSn()->getStockArticle()->getArticles() && $stockMateriel->getStockArticleSn()->getStockArticle()->getArticles()->getFruitDeMer()) {
                //dump(strtoupper($stockMateriel->getStockArticleSn()->getStockArticle()->getArticles()->getFruitDeMer()->getNom()));
                return strtoupper($stockMateriel->getStockArticleSn()->getStockArticle()->getArticles()->getFruitDeMer()->getNom()) == 'HUîTRE';
            }
        }
        return false;
    }
    public function haseCordeMoule(): bool
    {
        $stockMateriel = $this->emplacement->getStockMateriel();

        if ($stockMateriel instanceof StockCorde) {
            if ($stockMateriel->getStockArticleSn() && $stockMateriel->getStockArticleSn()->getStockArticle() && $stockMateriel->getStockArticleSn()->getStockArticle()->getArticles() && $stockMateriel->getStockArticleSn()->getStockArticle()->getArticles()->getFruitDeMer()) {
                //dump($stockMateriel->getStockArticleSn()->getStockArticle()->getArticles()->getFruitDeMer()->getNom());
                return strtoupper($stockMateriel->getStockArticleSn()->getStockArticle()->getArticles()->getFruitDeMer()->getNom()) == 'MOULE';
            }
        }
        return false;
    }

    public function getPoidPlace(): float
    {
        $poids = 0;
        $stockMateriel =  $this->emplacement->getStockMateriel();

        if ($stockMateriel instanceof StockCorde) {
            //dump($stockMateriel->getquantite());
            //dump($stockMateriel->getLongeur());
            //dump($this->mouleCalculator->calculateAllColumns(0, $stockMateriel->getLongeur(), $stockMateriel->getquantite()));
            //dump($this->mouleCalculator->calculateAllColumns(1, $stockMateriel->getLongeur(), $stockMateriel->getquantite()));
            //dd($stockMateriel);
        }

        return 0;
    }
}
