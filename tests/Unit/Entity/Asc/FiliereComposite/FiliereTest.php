<?php

namespace App\Tests\Unit\Entity\Asc\FiliereComposite;

use App\Entity\Asc\FiliereComposite\Emplacement;
use App\Entity\Asc\FiliereComposite\Filiere;
use App\Entity\Asc\FiliereComposite\Flotteur;
use App\Entity\Asc\FiliereComposite\FlotteurSegment;
use App\Entity\Asc\Parc;
use App\Entity\Asc\FiliereComposite\Segment;
use App\Entity\Asc\Stock\StockCorde;
use PHPUnit\Framework\TestCase;

class FiliereTest extends TestCase
{
    public function testGetId()
    {
        $filiere = new Filiere();
        $this->assertNull($filiere->getId());
    }

    public function testSetAndGetNomFiliere()
    {
        $filiere = new Filiere();
        $filiere->setNomFiliere('Filiere Test');
        $this->assertEquals('Filiere Test', $filiere->getNomFiliere());
    }

    public function testSetAndGetObservation()
    {
        $filiere = new Filiere();
        $observation = ['Note 1', 'Note 2'];
        $filiere->setObservation($observation);
        $this->assertEquals($observation, $filiere->getObservation());
    }

    public function testSetAndGetAireDeTravaille()
    {
        $filiere = new Filiere();
        $filiere->setAireDeTravaille(true);
        $this->assertTrue($filiere->isAireDeTravaille());
    }

    public function testSetAndGetParc()
    {
        $filiere = new Filiere();
        $parc = new Parc();
        $filiere->setParc($parc);
        $this->assertEquals($parc, $filiere->getParc());
    }

    public function testAddAndRemoveSegment()
    {
        $filiere = new Filiere();
        $segment = new Segment();
        $filiere->addSegment($segment);

        $this->assertCount(1, $filiere->getSegments());
        $this->assertTrue($filiere->getSegments()->contains($segment));

        $filiere->removeSegment($segment);
        $this->assertCount(0, $filiere->getSegments());
    }

    public function testGetFlottabiliter()
    {
        $filiere = new Filiere();
        $segment1 = new Segment();
        $flotteurSegment1 = new FlotteurSegment();
        $flottuer1 = new Flotteur();
        $flottuer1->setKgf(1.5);
        $flotteurSegment1->setFlotteur($flottuer1);
        $flotteurSegment1->setNombre(1);
        $segment1->addFlotteurSegment($flotteurSegment1);


        $segment2 = new Segment();
        $flotteurSegment2 = new FlotteurSegment();
        $flottuer2 = new Flotteur();
        $flottuer2->setKgf(2.5);
        $flotteurSegment2->setFlotteur($flottuer2);
        $flotteurSegment2->setNombre(1);
        $segment2->addFlotteurSegment($flotteurSegment2);

        $filiere->addSegment($segment1);
        $filiere->addSegment($segment2);

        $this->assertEquals(4.0, $filiere->getFlottabiliter());
    }

    public function testGetVolumesTotale()
    {
        $filiere = new Filiere();

        $segment1 = new Segment();
        $flotteurSegment1 = new FlotteurSegment();
        $flottuer1 = new Flotteur();
        $flottuer1->setVolume(100);
        $flotteurSegment1->setFlotteur($flottuer1);
        $flotteurSegment1->setNombre(1);
        $segment1->addFlotteurSegment($flotteurSegment1);

        $segment2 = new Segment();
        $flotteurSegment2 = new FlotteurSegment();
        $flottuer2 = new Flotteur();
        $flottuer2->setVolume(150);
        $flotteurSegment2->setFlotteur($flottuer2);
        $flotteurSegment2->setNombre(1);
        $segment2->addFlotteurSegment($flotteurSegment2);

        $filiere->addSegment($segment1);
        $filiere->addSegment($segment2);

        $this->assertEquals(250, $filiere->getVolumesTotale());
    }

    public function testGetTotaleCordes()
    {
        $filiere = new Filiere();

        $segment1 = new Segment();
        $emplacement1 = new Emplacement();
        $stockCordes1 = new StockCorde();
        $stockCordes3 = new StockCorde();
        $stockCordes4 = new StockCorde();
        $stockCordes5 = new StockCorde();
        $stockCordes2 = new StockCorde();

        $emplacement1->addStockCorde($stockCordes1);
        $emplacement1->addStockCorde($stockCordes2);
        $emplacement1->addStockCorde($stockCordes3);
        $segment1->addEmplacement($emplacement1);

        $segment2 = new Segment();
        $emplacement2 = new Emplacement();
        $emplacement2->addStockCorde($stockCordes4);
        $emplacement2->addStockCorde($stockCordes5);
        $segment2->addEmplacement($emplacement2);

        $filiere->addSegment($segment1);
        $filiere->addSegment($segment2);

        $this->assertEquals(5, $filiere->getTotaleCordes());
    }

    public function testGetPoidCordes()
    {
        $filiere = new Filiere();
        $segment1 = new Segment();
        $emplacement1 = new Emplacement();
        $stockCordes1 = new StockCorde();
        $stockCordes1->setPoid(10);
        $stockCordes3 = new StockCorde();
        $stockCordes3->setPoid(20);
        $stockCordes4 = new StockCorde();
        $stockCordes4->setPoid(50);
        $stockCordes5 = new StockCorde();
        $stockCordes5->setPoid(50);
        $stockCordes2 = new StockCorde();
        $stockCordes2->setPoid(20);
        $emplacement1->addStockCorde($stockCordes1);
        $emplacement1->addStockCorde($stockCordes2);
        $emplacement1->addStockCorde($stockCordes3);
        $segment1->addEmplacement($emplacement1);

        $segment2 = new Segment();
        $emplacement2 = new Emplacement();
        $emplacement2->addStockCorde($stockCordes4);
        $emplacement2->addStockCorde($stockCordes5);
        $segment2->addEmplacement($emplacement2);

        $filiere->addSegment($segment1);
        $filiere->addSegment($segment2);

        $this->assertEquals(150, $filiere->getPoidCordes());
    }

    public function testGetNombreEmplacements()
    {
        $filiere = new Filiere();
        $segment1 = new Segment();
        $emplacement1 = new Emplacement();
        $segment1->addEmplacement($emplacement1);

        $segment2 = new Segment();
        $emplacement2 = new Emplacement();
        $segment2->addEmplacement($emplacement2);

        $filiere->addSegment($segment1);
        $filiere->addSegment($segment2);
        $this->assertEquals(2, $filiere->getNombreEmplacements());
    }

    public function testGetNombreEmplacementsVide()
    {
        $filiere = new Filiere();
        $segment1 = new Segment();
        $segment2 = new Segment();

        $stockCordes1 = new StockCorde();
        $emplacement1 = new Emplacement();
        $emplacement1->addStockCorde($stockCordes1);

        $emplacement2 = new Emplacement();
        $emplacement3 = new Emplacement();
        $emplacement4 = new Emplacement();

        $segment1->addEmplacement($emplacement1);
        $segment1->addEmplacement($emplacement2);
        $segment2->addEmplacement($emplacement3);
        $segment2->addEmplacement($emplacement4);

        $filiere->addSegment($segment1);
        $filiere->addSegment($segment2);

        $this->assertEquals(3, $filiere->getNombreEmplacementsVide());
    }

    public function testGetNombreEmplacementsRemplit()
    {
        $filiere = new Filiere();
        $segment1 = new Segment();
        $emplacement1 = new Emplacement();

        $stockCordes1 = new StockCorde();
        $stockCordes5 = new StockCorde();

        $emplacement1->addStockCorde($stockCordes1);
        $segment1->addEmplacement($emplacement1);

        $segment2 = new Segment();
        $emplacement2 = new Emplacement();
        $emplacement2->addStockCorde($stockCordes5);
        $segment2->addEmplacement($emplacement2);
        $filiere->addSegment($segment1);
        $filiere->addSegment($segment2);

        $this->assertEquals(2, $filiere->getNombreEmplacementsRemplit());
    }
}
