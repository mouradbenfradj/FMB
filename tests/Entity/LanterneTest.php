<?php

namespace App\Tests\Entity;

use App\Entity\Lanterne;
use App\Entity\Parc;
use App\Entity\StockLanterne;
use PHPUnit\Framework\TestCase;

class LanterneTest extends TestCase
{
    public function testGetId()
    {
        $lanterne = new Lanterne();
        $this->assertNull($lanterne->getId());
    }

    public function testSetAndGetNomLanterne()
    {
        $lanterne = new Lanterne();
        $lanterne->setNomLanterne('Lanterne Test');
        $this->assertEquals('Lanterne Test', $lanterne->getNomLanterne());
    }

    public function testSetAndGetParc()
    {
        $lanterne = new Lanterne();
        $parc = new Parc();
        $lanterne->setParc($parc);
        $this->assertSame($parc, $lanterne->getParc());
    }

    public function testAddAndRemoveStockLanterne()
    {
        $lanterne = new Lanterne();
        $stockLanterne = new StockLanterne();
        $lanterne->addStockLanterne($stockLanterne);

        $this->assertCount(1, $lanterne->getStockLanternes());
        $this->assertTrue($lanterne->getStockLanternes()->contains($stockLanterne));

        $lanterne->removeStockLanterne($stockLanterne);
        $this->assertCount(0, $lanterne->getStockLanternes());
    }
}
