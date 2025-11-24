<?php

namespace App\Tests\Entity;

use App\Entity\Processus;
use App\Entity\Phase;
use PHPUnit\Framework\TestCase;

class ProcessusTest extends TestCase
{
    public function testGetId()
    {
        $processus = new Processus();
        $this->assertNull($processus->getId());
    }

    public function testSetAndGetNomProcessus()
    {
        $processus = new Processus();
        $processus->setNomProcessus('Processus Test');
        $this->assertEquals('Processus Test', $processus->getNomProcessus());
    }

    public function testAddAndRemovePhase()
    {
        $processus = new Processus();
        $phase = new Phase();
        $processus->addPhase($phase);

        $this->assertCount(1, $processus->getPhases());
        $this->assertTrue($processus->getPhases()->contains($phase));

        $processus->removePhase($phase);
        $this->assertCount(0, $processus->getPhases());
    }
}
