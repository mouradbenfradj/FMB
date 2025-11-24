<?php

namespace App\Tests\Entity;

use App\Entity\Phase;
use App\Entity\Processus;
use PHPUnit\Framework\TestCase;

class ProcessusTest extends TestCase
{
    public function testInstantiation(): void
    {
        $processus = new Processus();
        $this->assertInstanceOf(Processus::class, $processus);
        $this->assertNull($processus->getId());
        $this->assertNull($processus->getNomProcessus());
        $this->assertNull($processus->getPhase());
    }

    public function testSettersAndGetters(): void
    {
        $processus = new Processus();

        $processus->setNomProcessus('Test Processus');
        $this->assertEquals('Test Processus', $processus->getNomProcessus());

        $phase = new Phase();
        $processus->setPhase($phase);
        $this->assertSame($phase, $processus->getPhase());
    }

    public function testToString(): void
    {
        $processus = new Processus();
        $processus->setNomProcessus('Test Processus');
        $this->assertEquals('Test Processus', (string) $processus);
    }
}
