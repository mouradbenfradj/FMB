<?php

namespace App\Service;

use App\Entity\Emplacement;

class EmplacementService
{
    private Emplacement $emplacement;
    public function setEmplacementToService(Emplacement $emplacement): void
    {
        $this->emplacement = $emplacement;
    }

    public function isEmpty(): bool
    {
        return $this->emplacement->getStockCordes()->count() === 0 && $this->emplacement->getStockLanternes()->count() === 0;
    }
    public function haseCorde(): bool
    {

        return $this->emplacement->getStockCordes()->count() > 0 ? true : false;
    }
    public function haseLanterne(): bool
    {

        return $this->emplacement->getStockLanternes()->count() > 0 ? true : false;
    }
    public function hasePoche(): bool
    {

        //return $this->emplacement->getStockLanternes()->count() > 0 ? true : false;
        return false;
    }
    public function haseCordeHuitre(): bool
    {
        if ($this->emplacement->getStockCordes()->count() > 0) {
            $stockCorde = $this->emplacement->getStockCordes()[0];
            if ($stockCorde && $stockCorde->getStockArticleSn() && $stockCorde->getStockArticleSn()->getStockArticle() && $stockCorde->getStockArticleSn()->getStockArticle()->getArticles() && $stockCorde->getStockArticleSn()->getStockArticle()->getArticles()->getFruitDeMer()) {
                dump(strtoupper($stockCorde->getStockArticleSn()->getStockArticle()->getArticles()->getFruitDeMer()->getNom()));
                return strtoupper($stockCorde->getStockArticleSn()->getStockArticle()->getArticles()->getFruitDeMer()->getNom()) == 'HUîTRE';
            }
        }
        return false;
    }
    public function haseCordeMoule(): bool
    {
        if ($this->emplacement->getStockCordes()->count() > 0) {
            $stockCorde = $this->emplacement->getStockCordes()[0];
            if ($stockCorde && $stockCorde->getStockArticleSn() && $stockCorde->getStockArticleSn()->getStockArticle() && $stockCorde->getStockArticleSn()->getStockArticle()->getArticles() && $stockCorde->getStockArticleSn()->getStockArticle()->getArticles()->getFruitDeMer()) {
                dump($stockCorde->getStockArticleSn()->getStockArticle()->getArticles()->getFruitDeMer()->getNom());
                return strtoupper($stockCorde->getStockArticleSn()->getStockArticle()->getArticles()->getFruitDeMer()->getNom()) == 'MOULE';
            }
        }
        return false;
    }
}
