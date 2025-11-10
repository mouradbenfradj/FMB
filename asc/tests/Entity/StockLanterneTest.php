<?php

namespace App\Tests\Entity;

use App\Entity\Emplacement;
use App\Entity\Lanterne;
use App\Entity\StockArticleSn;
use App\Entity\StockLanterne;
use PHPUnit\Framework\TestCase;

class StockLanterneTest extends TestCase
{
    public function testInstantiation(): void
    {
        $stockLanterne = new StockLanterne();
        $this->assertInstanceOf(StockLanterne::class, $stockLanterne);
        $this->assertNull($stockLanterne->getId());
        $this->assertNull($stockLanterne->getDatedecreation());
        $this->assertNull($stockLanterne->getLanterne());
        $this->assertNull($stockLanterne->getStockArticleSn());
        $this->assertNull($stockLanterne->getEmplacement());
        $this->assertNull($stockLanterne->isPret());
        $this->assertNull($stockLanterne->getDatederetirement());
        $this->assertNull($stockLanterne->getDatederetraittransfert());
        $this->assertNull($stockLanterne->getDatedemaetransfert());
        $this->assertNull($stockLanterne->getDateDeMiseAEau());
    }

    public function testSettersAndGetters(): void
    {
        $stockLanterne = new StockLanterne();

        $date = new \DateTime('2023-01-01');
        $stockLanterne->setDatedecreation($date);
        $this->assertEquals($date, $stockLanterne->getDatedecreation());

        $lanterne = new Lanterne();
        $stockLanterne->setLanterne($lanterne);
        $this->assertSame($lanterne, $stockLanterne->getLanterne());

        $stockArticleSn = new StockArticleSn();
        $stockLanterne->setStockArticleSn($stockArticleSn);
        $this->assertSame($stockArticleSn, $stockLanterne->getStockArticleSn());

        $emplacement = new Emplacement();
        $stockLanterne->setEmplacement($emplacement);
        $this->assertSame($emplacement, $stockLanterne->getEmplacement());

        $stockLanterne->setPret(true);
        $this->assertTrue($stockLanterne->isPret());

        $stockLanterne->setDatederetirement($date);
        $this->assertEquals($date, $stockLanterne->getDatederetirement());

        $stockLanterne->setDatederetraittransfert($date);
        $this->assertEquals($date, $stockLanterne->getDatederetraittransfert());

        $stockLanterne->setDatedemaetransfert($date);
        $this->assertEquals($date, $stockLanterne->getDatedemaetransfert());

        $stockLanterne->setDateDeMiseAEau($date);
        $this->assertEquals($date, $stockLanterne->getDateDeMiseAEau());
    }
}
