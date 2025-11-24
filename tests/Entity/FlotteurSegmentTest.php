<?php

namespace App\Tests\Entity;

use App\Entity\FlotteurSegment;
use App\Entity\Flotteur;
use App\Entity\Segment;
use PHPUnit\Framework\TestCase;

class FlotteurSegmentTest extends TestCase
{
    public function testGetId()
    {
        $flotteurSegment = new FlotteurSegment();
        $this->assertNull($flotteurSegment->getId());
    }

    public function testSetAndGetFlotteur()
    {
        $flotteurSegment = new FlotteurSegment();
        $flotteur = new Flotteur();
        $flotteurSegment->setFlotteur($flotteur);
        $this->assertSame($flotteur, $flotteurSegment->getFlotteur());
    }

    public function testSetAndGetSegment()
    {
        $flotteurSegment = new FlotteurSegment();
        $segment = new Segment();
        $flotteurSegment->setSegment($segment);
        $this->assertSame($segment, $flotteurSegment->getSegment());
    }

    public function testSetAndGetQuantite()
    {
        $flotteurSegment = new FlotteurSegment();
        $flotteurSegment->setQuantite(10);
        $this->assertEquals(10, $flotteurSegment->getQuantite());
    }
}
