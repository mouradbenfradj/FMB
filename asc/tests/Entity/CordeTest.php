<?php

namespace App\Tests\Entity;

use App\Entity\Corde;
use App\Entity\Parc;
use App\Entity\StockCorde;
use PHPUnit\Framework\TestCase;

class CordeTest extends TestCase
{
    public function testInstantiation(): void
    {
        $corde = new Corde();
        $this->assertInstanceOf(Corde::class, $corde);
        $this->assertNull($corde->getId());
        $this->assertNull($corde->getParc());
        $this->assertNull($corde->getLongeur());
        $this->assertEmpty($corde->getStockCordes());
        $this->assertNull($corde->getQuantiter());
        $this->assertNull($corde->getNom());
    }

    public function testSettersAndGetters(): void
    {
        $corde = new Corde();

        $parc = new Parc();
        $corde->setParc($parc);
        $this->assertSame($parc, $corde->getParc());

        $corde->setLongeur(100.5);
        $this->assertEquals(100.5, $corde->getLongeur());

        $corde->setQuantiter(10);
        $this->assertEquals(10, $corde->getQuantiter());

        $corde->setNom('Test Corde');
        $this->assertEquals('Test Corde', $corde->getNom());
    }

    public function testToString(): void
    {
        $corde = new Corde();
        $this->assertEquals('Corde', (string) $corde);

        $corde->setNom('Test Corde');
        $this->assertEquals('Test Corde', (string) $corde);
    }

    public function testStockCordesRelationship(): void
    {
        $corde = new Corde();
        $stockCorde = new StockCorde();

        $this->assertEmpty($corde->getStockCordes());

        $corde->addStockCorde($stockCorde);
        $this->assertCount(1, $corde->getStockCordes());
        $this->assertSame($corde, $stockCorde->getCorde());

        $corde->removeStockCorde($stockCorde);
        $this->assertEmpty($corde->getStockCordes());
        $this->assertNull($stockCorde->getCorde());
    }

    public function testAddStockCordeDoesNotDuplicate(): void
    {
        $corde = new Corde();
        $stockCorde = new StockCorde();

        $corde->addStockCorde($stockCorde);
        $corde->addStockCorde($stockCorde);

        $this->assertCount(1, $corde->getStockCordes());
    }
}
