<?php

namespace App\Tests\Entity;

use App\Entity\Filiere;
use App\Entity\Parc;
use App\Entity\Segment;
use PHPUnit\Framework\TestCase;

class FiliereTest extends TestCase
{
    public function testInstantiation(): void
    {
        $filiere = new Filiere();
        $this->assertInstanceOf(Filiere::class, $filiere);
        $this->assertNull($filiere->getId());
        $this->assertNull($filiere->getNomFiliere());
        $this->assertNull($filiere->getObservation());
        $this->assertNull($filiere->getParc());
        $this->assertNull($filiere->isAireDeTravaille());
        $this->assertEmpty($filiere->getSegments());
    }

    public function testSettersAndGetters(): void
    {
        $filiere = new Filiere();

        $filiere->setNomFiliere('Test Filiere');
        $this->assertEquals('Test Filiere', $filiere->getNomFiliere());

        $observation = ['note1', 'note2'];
        $filiere->setObservation($observation);
        $this->assertEquals($observation, $filiere->getObservation());

        $parc = new Parc();
        $filiere->setParc($parc);
        $this->assertSame($parc, $filiere->getParc());

        $filiere->setAireDeTravaille(true);
        $this->assertTrue($filiere->isAireDeTravaille());
    }

    public function testSegmentsRelationship(): void
    {
        $filiere = new Filiere();
        $segment = new Segment();

        $this->assertEmpty($filiere->getSegments());

        $filiere->addSegment($segment);
        $this->assertCount(1, $filiere->getSegments());
        $this->assertSame($filiere, $segment->getFiliere());

        $filiere->removeSegment($segment);
        $this->assertEmpty($filiere->getSegments());
        $this->assertNull($segment->getFiliere());
    }

    public function testAddSegmentDoesNotDuplicate(): void
    {
        $filiere = new Filiere();
        $segment = new Segment();

        $filiere->addSegment($segment);
        $filiere->addSegment($segment);

        $this->assertCount(1, $filiere->getSegments());
    }

    public function testGetNombreEmplacements(): void
    {
        $filiere = new Filiere();
        $segment1 = $this->createMock(Segment::class);
        $segment1->method('getNombreEmplacements')->willReturn(5);
        $segment2 = $this->createMock(Segment::class);
        $segment2->method('getNombreEmplacements')->willReturn(3);

        $filiere->addSegment($segment1);
        $filiere->addSegment($segment2);

        $this->assertEquals(8, $filiere->getNombreEmplacements());
    }

    public function testGetTotaleCordes(): void
    {
        $filiere = new Filiere();
        $segment1 = $this->createMock(Segment::class);
        $segment1->method('getTotaleCordes')->willReturn(2);
        $segment2 = $this->createMock(Segment::class);
        $segment2->method('getTotaleCordes')->willReturn(4);

        $filiere->addSegment($segment1);
        $filiere->addSegment($segment2);

        $this->assertEquals(6, $filiere->getTotaleCordes());
    }

    public function testGetFlottabiliter(): void
    {
        $filiere = new Filiere();
        $segment1 = $this->createMock(Segment::class);
        $segment1->method('getFlottabiliter')->willReturn(1.5);
        $segment2 = $this->createMock(Segment::class);
        $segment2->method('getFlottabiliter')->willReturn(2.5);

        $filiere->addSegment($segment1);
        $filiere->addSegment($segment2);

        $this->assertEquals(4.0, $filiere->getFlottabiliter());
    }

    public function testGetFlottabiliterEmpty(): void
    {
        $filiere = new Filiere();
        $this->assertEquals(1.0, $filiere->getFlottabiliter());
    }

    public function testGetPoidCordes(): void
    {
        $filiere = new Filiere();
        $segment1 = $this->createMock(Segment::class);
        $segment1->method('getPoidCordes')->willReturn(10);
        $segment2 = $this->createMock(Segment::class);
        $segment2->method('getPoidCordes')->willReturn(15);

        $filiere->addSegment($segment1);
        $filiere->addSegment($segment2);

        $this->assertEquals(25, $filiere->getPoidCordes());
    }

    public function testGetVolumesTotale(): void
    {
        $filiere = new Filiere();
        $segment1 = $this->createMock(Segment::class);
        $segment1->method('getVolumesTotale')->willReturn(3.5);
        $segment2 = $this->createMock(Segment::class);
        $segment2->method('getVolumesTotale')->willReturn(4.5);

        $filiere->addSegment($segment1);
        $filiere->addSegment($segment2);

        $this->assertEquals(8.0, $filiere->getVolumesTotale());
    }

    public function testGetVolumesTotaleEmpty(): void
    {
        $filiere = new Filiere();
        $this->assertEquals(1.0, $filiere->getVolumesTotale());
    }

    public function testGetNombreEmplacementsVide(): void
    {
        $filiere = new Filiere();
        $segment1 = $this->createMock(Segment::class);
        $segment1->method('getNombreEmplacementsVide')->willReturn(2);
        $segment2 = $this->createMock(Segment::class);
        $segment2->method('getNombreEmplacementsVide')->willReturn(3);

        $filiere->addSegment($segment1);
        $filiere->addSegment($segment2);

        $this->assertEquals(5, $filiere->getNombreEmplacementsVide());
    }

    public function testGetNombreEmplacementsRemplit(): void
    {
        $filiere = new Filiere();
        $segment1 = $this->createMock(Segment::class);
        $segment1->method('getTotaleCordes')->willReturn(1);
        $segment2 = $this->createMock(Segment::class);
        $segment2->method('getTotaleCordes')->willReturn(2);

        $filiere->addSegment($segment1);
        $filiere->addSegment($segment2);

        $this->assertEquals(3, $filiere->getNombreEmplacementsRemplit());
    }
}
