<?php

namespace App\Tests\Entity;

use App\Entity\Stock;
use App\Entity\Parc;
use App\Entity\StockArticle;
use PHPUnit\Framework\TestCase;

class StockTest extends TestCase
{
    public function testGetId()
    {
        $stock = new Stock();
        $this->assertNull($stock->getId());
    }

    public function testSetAndGetLibStock()
    {
        $stock = new Stock();
        $stock->setLibStock('Stock Test');
        $this->assertEquals('Stock Test', $stock->getLibStock());
    }

    public function testSetAndGetAbrevStock()
    {
        $stock = new Stock();
        $stock->setAbrevStock('ST');
        $this->assertEquals('ST', $stock->getAbrevStock());
    }

    public function testSetAndGetActif()
    {
        $stock = new Stock();
        $stock->setActif(true);
        $this->assertTrue($stock->isActif());
    }

    public function testSetAndGetParc()
    {
        $stock = new Stock();
        $parc = new Parc();
        $stock->setParc($parc);
        $this->assertSame($parc, $stock->getParc());
    }

    public function testAddAndRemoveStockArticle()
    {
        $stock = new Stock();
        $stockArticle = new StockArticle();
        $stock->addStockArticle($stockArticle);

        $this->assertCount(1, $stock->getStockArticles());
        $this->assertTrue($stock->getStockArticles()->contains($stockArticle));

        $stock->removeStockArticle($stockArticle);
        $this->assertCount(0, $stock->getStockArticles());
    }

    public function testToString()
    {
        $stock = new Stock();
        $stock->setLibStock('Test Stock');
        $this->assertEquals('Test Stock', $stock->__toString());
    }
}
