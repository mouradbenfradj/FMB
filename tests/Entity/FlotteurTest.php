<?php

namespace App\Tests\Entity;

use App\Entity\Flotteur;
use App\Entity\Segment;
use App\Entity\FlotteurSegment;
use PHPUnit\Framework\TestCase;

class FlotteurTest extends TestCase
{
    public function testGetId()
    {
        $flotteur = new Flotteur();
        $this->assertNull($flotteur->getId());
    }

    public function testSetAndGetNomFlotteur()
    {
        $flotteur = new Flotteur();
        $flotteur->setNomFlotteur('Flotteur Test');
        $this->assertEquals('Flotteur Test', $flotteur->getNomFlotteur());
    }

    public function testSetAndGetVolume()
    {
        $flotteur = new Flotteur();
        $flotteur->setVolume(10.5);
        $this->assertEquals(10.5, $flotteur->getVolume());
    }

    public function testSetAndGetPoids()
    {
        $flotteur = new Flotteur();
        $flotteur->setPoids(5.0);
        $this->assertEquals(5.0, $flotteur->getPoids());
    }

    public function testSetAndGetSegment()
    {
        $flotteur = new Flotteur();
        $segment = new Segment();
        $flotteur->setSegment($segment);
        $this->assertSame($segment, $flotteur->getSegment());
    }

    public function testAddAndRemoveFlotteurSegment()
    {
        $flotteur = new Flotteur();
        $flotteurSegment = new FlotteurSegment();
        $flotteur->addFlotteurSegment($flotteurSegment);

        $this->assertCount(1, $flotteur->getFlotteurSegments());
        $this->assertTrue($flotteur->getFlotteurSegments()->contains($flotteurSegment));

        $flotteur->removeFlotteurSegment($flotteurSegment);
        $this->assertCount(0, $flotteur->getFlotteurSegments());
    }
}
