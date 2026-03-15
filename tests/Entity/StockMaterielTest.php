<?php

namespace App\Tests\Entity;

use App\Entity\StockMateriel;
use App\Entity\Emplacement;
use App\Entity\Phase;
use App\Entity\Processus;
use PHPUnit\Framework\TestCase;

class StockMaterielTest extends TestCase
{
    private function createStockMateriel(): StockMateriel
    {
        return new class extends StockMateriel {
            public function __toString(): string
            {
                return "MockStockMateriel";
            }
        };
    }

    public function testInitialValues(): void
    {
        $stock = $this->createStockMateriel();
        $this->assertNull($stock->getId());
        $this->assertNull($stock->getDatedecreation());
        $this->assertNull($stock->getEmplacement());
        $this->assertNull($stock->getPhase());
        $this->assertNull($stock->getProcessus());
        $this->assertNull($stock->getDateDeMiseAEau());
    }

    public function testSettersAndGetters(): void
    {
        $stock = $this->createStockMateriel();
        
        $dateCreation = new \DateTime('2024-01-01');
        $stock->setDatedecreation($dateCreation);
        $this->assertEquals($dateCreation, $stock->getDatedecreation());

        $emplacement = new Emplacement();
        $stock->setEmplacement($emplacement);
        $this->assertEquals($emplacement, $stock->getEmplacement());

        $phase = new Phase();
        $stock->setPhase($phase);
        $this->assertEquals($phase, $stock->getPhase());

        $processus = new Processus();
        $stock->setProcessus($processus);
        $this->assertEquals($processus, $stock->getProcessus());

        $dateMAE = new \DateTime('2024-03-11');
        $stock->setDateDeMiseAEau($dateMAE);
        $this->assertEquals($dateMAE, $stock->getDateDeMiseAEau());

        $stock->setPret(true);
        $this->assertTrue($stock->isPret());
    }
}
