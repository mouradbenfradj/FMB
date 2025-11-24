<?php

namespace App\Tests\Entity;

use App\Entity\Emplacement;
use App\Entity\Segment;
use App\Entity\StockCorde;
use App\Entity\StockLanterne;
use PHPUnit\Framework\TestCase;

class EmplacementTest extends TestCase
{
    public function testGetId()
    {
        $emplacement = new Emplacement();
        $this->assertNull($emplacement->getId());
    }

    public function testSetAndGetPlace()
    {
        $emplacement = new Emplacement();
        $emplacement->setPlace(1);
        $this->assertEquals(1, $emplacement->getPlace());
    }

    public function testSetAndGetSegment()
    {
        $emplacement = new Emplacement();
        $segment = new Segment();
        $emplacement->setSegment($segment);
        $this->assertSame($segment, $emplacement->getSegment());
    }

    public function testAddAndRemoveStockCorde()
    {
        $emplacement = new Emplacement();
        $stockCorde = new StockCorde();
        $emplacement->addStockCorde($stockCorde);

        $this->assertCount(1, $emplacement->getStockCordes());
        $this->assertTrue($emplacement->getStockCordes()->contains($stockCorde));

        $emplacement->removeStockCorde($stockCorde);
        $this->assertCount(0, $emplacement->getStockCordes());
    }

    public function testAddAndRemoveStockLanterne()
    {
        $emplacement = new Emplacement();
        $stockLanterne = new StockLanterne();
        $emplacement->addStockLanterne($stockLanterne);

        $this->assertCount(1, $emplacement->getStockLanternes());
        $this->assertTrue($emplacement->getStockLanternes()->contains($stockLanterne));

        $emplacement->removeStockLanterne($stockLanterne);
        $this->assertCount(0, $emplacement->getStockLanternes());
    }

    public function testToString()
    {
        $emplacement = new Emplacement();
        $emplacement->setPlace(5);
        $this->assertEquals(5, $emplacement->__toString());
    }
}
