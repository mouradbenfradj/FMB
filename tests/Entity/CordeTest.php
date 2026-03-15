<?php

namespace App\Tests\Entity;

use App\Entity\Corde;
use App\Entity\Parc;
use App\Entity\StockCorde;
use App\Entity\FruitDeMer;
use PHPUnit\Framework\TestCase;

class CordeTest extends TestCase
{
    public function testGetId()
    {
        $corde = new Corde();
        $this->assertNull($corde->getId());
    }

    public function testSetAndGetNom()
    {
        $corde = new Corde();
        $corde->setNom('Corde Test');
        $this->assertEquals('Corde Test', $corde->getNom());
    }

    public function testSetAndGetLongeur()
    {
        $corde = new Corde();
        $corde->setLongeur(10.5);
        $this->assertEquals(10.5, $corde->getLongeur());
    }

    public function testSetAndGetquantite()
    {
        $corde = new Corde();
        $corde->setquantite(100);
        $this->assertEquals(100, $corde->getquantite());
    }

    public function testSetAndGetParc()
    {
        $corde = new Corde();
        $parc = new Parc();
        $corde->setParc($parc);
        $this->assertSame($parc, $corde->getParc());
    }

    public function testSetAndGetFruitDeMer()
    {
        $corde = new Corde();
        $fruitDeMer = new FruitDeMer();
        $corde->setFruitDeMer($fruitDeMer);
        $this->assertSame($fruitDeMer, $corde->getFruitDeMer());
    }

    public function testAddAndRemoveStockCorde()
    {
        $corde = new Corde();
        $stockCorde = new StockCorde();
        $corde->addStockCorde($stockCorde);

        $this->assertCount(1, $corde->getStockCordes());
        $this->assertTrue($corde->getStockCordes()->contains($stockCorde));

        $corde->removeStockCorde($stockCorde);
        $this->assertCount(0, $corde->getStockCordes());
    }

    public function testToString()
    {
        $corde = new Corde();
        $this->assertEquals('Corde', $corde->__toString());

        $corde->setNom('Test Corde');
        $this->assertEquals('Test Corde', $corde->__toString());
    }
}
