<?php

namespace App\Tests\Entity;

use App\Entity\StockLanterne;
use App\Entity\Lanterne;
use App\Entity\Emplacement;
use PHPUnit\Framework\TestCase;

class StockLanterneTest extends TestCase
{
    public function testGetId()
    {
        $stockLanterne = new StockLanterne();
        $this->assertNull($stockLanterne->getId());
    }

    public function testSetAndGetLanterne()
    {
        $stockLanterne = new StockLanterne();
        $lanterne = new Lanterne();
        $stockLanterne->setLanterne($lanterne);
        $this->assertSame($lanterne, $stockLanterne->getLanterne());
    }

    public function testSetAndGetEmplacement()
    {
        $stockLanterne = new StockLanterne();
        $emplacement = new Emplacement();
        $stockLanterne->setEmplacement($emplacement);
        $this->assertSame($emplacement, $stockLanterne->getEmplacement());
    }

    public function testSetAndGetQuantite()
    {
        $stockLanterne = new StockLanterne();
        $stockLanterne->setQuantite(3);
        $this->assertEquals(3, $stockLanterne->getQuantite());
    }
}
