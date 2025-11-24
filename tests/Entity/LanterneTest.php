<?php

namespace App\Tests\Entity;

use App\Entity\Lanterne;
use App\Entity\Parc;
use App\Entity\StockLanterne;
use PHPUnit\Framework\TestCase;

class LanterneTest extends TestCase
{
    public function testInstantiation(): void
    {
        $lanterne = new Lanterne();
        $this->assertInstanceOf(Lanterne::class, $lanterne);
        $this->assertNull($lanterne->getId());
        $this->assertNull($lanterne->getNomLanterne());
        $this->assertNull($lanterne->getNbrPoche());
        $this->assertNull($lanterne->getNbrEnStock());
        $this->assertNull($lanterne->getParc());
        $this->assertEmpty($lanterne->getStockLanternes());
    }

    public function testSettersAndGetters(): void
    {
        $lanterne = new Lanterne();

        $lanterne->setNomLanterne('Test Lanterne');
        $this->assertEquals('Test Lanterne', $lanterne->getNomLanterne());

        $lanterne->setNbrPoche(10);
        $this->assertEquals(10, $lanterne->getNbrPoche());

        $lanterne->setNbrEnStock(5);
        $this->assertEquals(5, $lanterne->getNbrEnStock());

        $parc = new Parc();
        $lanterne->setParc($parc);
        $this->assertSame($parc, $lanterne->getParc());
    }

    public function testStockLanternesRelationship(): void
    {
        $lanterne = new Lanterne();
        $stockLanterne = new StockLanterne();

        $this->assertEmpty($lanterne->getStockLanternes());

        $lanterne->addStockLanterne($stockLanterne);
        $this->assertCount(1, $lanterne->getStockLanternes());
        $this->assertSame($lanterne, $stockLanterne->getLanterne());

        $lanterne->removeStockLanterne($stockLanterne);
        $this->assertEmpty($lanterne->getStockLanternes());
        $this->assertNull($stockLanterne->getLanterne());
    }

    public function testAddStockLanterneDoesNotDuplicate(): void
    {
        $lanterne = new Lanterne();
        $stockLanterne = new StockLanterne();

        $lanterne->addStockLanterne($stockLanterne);
        $lanterne->addStockLanterne($stockLanterne);

        $this->assertCount(1, $lanterne->getStockLanternes());
    }
}
