<?php

namespace App\Tests\Entity;

use App\Entity\Emplacement;
use App\Entity\Segment;
use App\Entity\StockCorde;
use App\Entity\StockLanterne;
use PHPUnit\Framework\TestCase;

class EmplacementTest extends TestCase
{
    public function testInstantiation(): void
    {
        $emplacement = new Emplacement();
        $this->assertInstanceOf(Emplacement::class, $emplacement);
        $this->assertNull($emplacement->getId());
        $this->assertNull($emplacement->getPlace());
        $this->assertNull($emplacement->getSegment());
        $this->assertEmpty($emplacement->getStockCordes());
        $this->assertEmpty($emplacement->getStockLanternes());
    }

    public function testSettersAndGetters(): void
    {
        $emplacement = new Emplacement();

        $emplacement->setPlace(5);
        $this->assertEquals(5, $emplacement->getPlace());

        $segment = new Segment();
        $emplacement->setSegment($segment);
        $this->assertSame($segment, $emplacement->getSegment());
    }

    public function testToString(): void
    {
        $emplacement = new Emplacement();
        $emplacement->setPlace(10);
        $this->assertEquals(10, (string) $emplacement);
    }

    public function testStockCordesRelationship(): void
    {
        $emplacement = new Emplacement();
        $stockCorde = new StockCorde();

        $this->assertEmpty($emplacement->getStockCordes());

        $emplacement->addStockCorde($stockCorde);
        $this->assertCount(1, $emplacement->getStockCordes());
        $this->assertSame($emplacement, $stockCorde->getEmplacement());

        $emplacement->removeStockCorde($stockCorde);
        $this->assertEmpty($emplacement->getStockCordes());
        $this->assertNull($stockCorde->getEmplacement());
    }

    public function testStockLanternesRelationship(): void
    {
        $emplacement = new Emplacement();
        $stockLanterne = new StockLanterne();

        $this->assertEmpty($emplacement->getStockLanternes());

        $emplacement->addStockLanterne($stockLanterne);
        $this->assertCount(1, $emplacement->getStockLanternes());
        $this->assertSame($emplacement, $stockLanterne->getEmplacement());

        $emplacement->removeStockLanterne($stockLanterne);
        $this->assertEmpty($emplacement->getStockLanternes());
        $this->assertNull($stockLanterne->getEmplacement());
    }

    public function testAddStockCordeDoesNotDuplicate(): void
    {
        $emplacement = new Emplacement();
        $stockCorde = new StockCorde();

        $emplacement->addStockCorde($stockCorde);
        $emplacement->addStockCorde($stockCorde);

        $this->assertCount(1, $emplacement->getStockCordes());
    }

    public function testAddStockLanterneDoesNotDuplicate(): void
    {
        $emplacement = new Emplacement();
        $stockLanterne = new StockLanterne();

        $emplacement->addStockLanterne($stockLanterne);
        $emplacement->addStockLanterne($stockLanterne);

        $this->assertCount(1, $emplacement->getStockLanternes());
    }
}
