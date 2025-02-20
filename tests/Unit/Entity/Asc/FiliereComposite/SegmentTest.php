<?php

namespace App\Tests\Unit\Entity\Asc\FiliereComposite;

use App\Entity\Asc\FiliereComposite\Segment;
use App\Entity\Asc\FiliereComposite\Filiere;
use App\Entity\Asc\FiliereComposite\Emplacement;
use App\Entity\Asc\FiliereComposite\Flotteur;
use App\Entity\Asc\FiliereComposite\FlotteurSegment;
use App\Entity\Asc\Stock\StockCorde;
use PHPUnit\Framework\TestCase;

class SegmentTest extends TestCase
{
    public function testGetId()
    {
        $segment = new Segment();
        $this->assertNull($segment->getId());
    }

    public function testSetAndGetNomSegment()
    {
        $segment = new Segment();
        $segment->setNomSegment('Segment Test');
        $this->assertEquals('Segment Test', $segment->getNomSegment());
    }

    public function testSetAndGetPas()
    {
        $segment = new Segment();
        $segment->setPas(2.0);
        $this->assertEquals(2.0, $segment->getPas());
    }

    public function testSetAndGetLongeur()
    {
        $segment = new Segment();
        $segment->setLongeur(10.0);
        $this->assertEquals(10.0, $segment->getLongeur());
    }

    public function testSetAndGetFiliere()
    {
        $segment = new Segment();
        $filiere = new Filiere();
        $segment->setFiliere($filiere);
        $this->assertEquals($filiere, $segment->getFiliere());
    }

    public function testAddAndRemoveEmplacement()
    {
        $segment = new Segment();
        $emplacement = new Emplacement();
        $segment->addEmplacement($emplacement);

        $this->assertCount(1, $segment->getEmplacements());
        $this->assertTrue($segment->getEmplacements()->contains($emplacement));

        $segment->removeEmplacement($emplacement);
        $this->assertCount(0, $segment->getEmplacements());
    }

    public function testAddAndRemoveFlotteurSegment()
    {
        $segment = new Segment();
        $flotteurSegment = new FlotteurSegment();
        $segment->addFlotteurSegment($flotteurSegment);

        $this->assertCount(1, $segment->getFlotteurSegments());
        $this->assertTrue($segment->getFlotteurSegments()->contains($flotteurSegment));

        $segment->removeFlotteurSegment($flotteurSegment);
        $this->assertCount(0, $segment->getFlotteurSegments());
    }

    public function testGetFlottabiliter()
    {
        $segment = new Segment();
        $flotteurSegment1 = new FlotteurSegment();
        $flottuer1 = new Flotteur();
        $flottuer1->setKgf(1.5);
        $flotteurSegment1->setNombre(2);
        $flotteurSegment1->setFlotteur($flottuer1);

        $flotteurSegment2 = new FlotteurSegment();
        $flottuer2 = new Flotteur();
        $flottuer2->setKgf(2.5);
        $flotteurSegment2->setFlotteur($flottuer2);
        $flotteurSegment2->setNombre(3);

        $segment->addFlotteurSegment($flotteurSegment1);
        $segment->addFlotteurSegment($flotteurSegment2);

        $this->assertEquals(10.5, $segment->getFlottabiliter());
    }

    public function testGetVolumesTotale()
    {
        $segment = new Segment();

        $flotteurSegment1 = new FlotteurSegment();
        $flottuer1 = new Flotteur();
        $flottuer1->setVolume(10.0);
        $flotteurSegment1->setFlotteur($flottuer1);
        $flotteurSegment1->setNombre(2);


        $flotteurSegment2 = new FlotteurSegment();
        $flottuer2 = new Flotteur();
        $flottuer2->setVolume(20.0);
        $flotteurSegment2->setFlotteur($flottuer2);
        $flotteurSegment2->setNombre(3);

        $segment->addFlotteurSegment($flotteurSegment1);
        $segment->addFlotteurSegment($flotteurSegment2);

        $this->assertEquals(80.0, $segment->getVolumesTotale());
    }

    public function testGetNombreEmplacements()
    {
        $segment = new Segment();
        $emplacement1 = new Emplacement();
        $emplacement2 = new Emplacement();
        $segment->addEmplacement($emplacement1);
        $segment->addEmplacement($emplacement2);

        $this->assertEquals(2, $segment->getNombreEmplacements());
    }

    public function testGetNombreEmplacementsVide()
    {
        $segment = new Segment();
        $emplacement1 = new Emplacement();
        $emplacement2 = new Emplacement();
        $emplacement3 = new Emplacement();

        $stockCordes1 = new StockCorde();
        $emplacement1 = new Emplacement();

        $emplacement1->addStockCorde($stockCordes1);

        $segment->addEmplacement($emplacement1);
        $segment->addEmplacement($emplacement2);
        $segment->addEmplacement($emplacement3);

        $this->assertEquals(2, $segment->getNombreEmplacementsVide());
    }

    public function testGetTotaleCordes()
    {
        $segment = new Segment();

        $emplacement1 = new Emplacement();
        $stockCordes1 = new StockCorde();
        $stockCordes2 = new StockCorde();
        $stockCordes3 = new StockCorde();

        $emplacement1->addStockCorde($stockCordes1);

        $emplacement2 = new Emplacement();
        $emplacement2->addStockCorde($stockCordes2);
        $emplacement2->addStockCorde($stockCordes3);

        $segment->addEmplacement($emplacement1);
        $segment->addEmplacement($emplacement2);

        $this->assertEquals(3, $segment->getTotaleCordes());
    }

    public function testGetPoidCordes()
    {
        $segment = new Segment();

        $emplacement1 = new Emplacement();
        $stockCordes1 = new StockCorde();
        $stockCordes1->setPoid(10.0);
        $emplacement1->addStockCorde($stockCordes1);

        $emplacement2 = new Emplacement();
        $stockCordes2 = new StockCorde();
        $stockCordes2->setPoid(20.0);
        $emplacement2->addStockCorde($stockCordes2);

        $segment->addEmplacement($emplacement1);
        $segment->addEmplacement($emplacement2);

        $this->assertEquals(30.0, $segment->getPoidCordes());
    }

    public function testGenerateEmplacement()
    {
        $segment = new Segment();
        $segment->setPas(2.0);
        $segment->setLongeur(6.0);
        $segment->generateEmplacement();

        $this->assertEquals(3, $segment->getNombreEmplacements());
    }
}
