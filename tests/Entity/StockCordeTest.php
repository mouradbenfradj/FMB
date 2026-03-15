<?php

namespace App\Tests\Entity;

use App\Entity\StockCorde;
use App\Entity\Corde;
use PHPUnit\Framework\TestCase;

class StockCordeTest extends TestCase
{
    public function testquantite(): void
    {
        $stockCorde = new StockCorde();
        $stockCorde->setquantite(100);
        $this->assertEquals(100, $stockCorde->getquantite());
    }

    public function testLongeur(): void
    {
        $stockCorde = new StockCorde();
        $stockCorde->setLongeur(1.5);
        $this->assertEquals(1.5, $stockCorde->getLongeur());
    }

    public function testCorde(): void
    {
        $stockCorde = new StockCorde();
        $corde = new Corde();
        $corde->setNom('Corde 1');
        $stockCorde->setCorde($corde);

        $this->assertEquals($corde, $stockCorde->getCorde());
        $this->assertEquals('Corde 1', (string)$stockCorde);
    }

    public function testChaussement(): void
    {
        $stockCorde = new StockCorde();
        $this->assertFalse($stockCorde->isChaussement());

        $stockCorde->setChaussement(true);
        $this->assertTrue($stockCorde->isChaussement());
    }
}
