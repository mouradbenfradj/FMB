<?php

namespace App\Tests\Entity;

use App\Entity\StockLanterne;
use App\Entity\Lanterne;
use PHPUnit\Framework\TestCase;

class StockLanterneTest extends TestCase
{
    public function testLanterne(): void
    {
        $stockLanterne = new StockLanterne();
        $lanterne = new Lanterne();
        $lanterne->setNomLanterne('Lanterne 1');
        $stockLanterne->setLanterne($lanterne);

        $this->assertEquals($lanterne, $stockLanterne->getLanterne());
        $this->assertEquals('Lanterne 1', (string)$stockLanterne);
    }

    public function testquantite(): void
    {
        $stockLanterne = new StockLanterne();
        $this->assertNull($stockLanterne->getquantite());

        $stockLanterne->setquantite(50);
        $this->assertEquals(50, $stockLanterne->getquantite());
    }
}
