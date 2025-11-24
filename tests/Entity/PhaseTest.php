<?php

namespace App\Tests\Entity;

use App\Entity\Phase;
use App\Entity\Processus;
use PHPUnit\Framework\TestCase;

class PhaseTest extends TestCase
{
    public function testInstantiation(): void
    {
        $phase = new Phase();
        $this->assertInstanceOf(Phase::class, $phase);
        $this->assertNull($phase->getId());
        $this->assertNull($phase->getNomPhase());
        $this->assertEmpty($phase->getProcessuses());
    }

    public function testSettersAndGetters(): void
    {
        $phase = new Phase();

        $phase->setNomPhase('Test Phase');
        $this->assertEquals('Test Phase', $phase->getNomPhase());
    }

    public function testToString(): void
    {
        $phase = new Phase();
        $phase->setNomPhase('Test Phase');
        $this->assertEquals('Test Phase', (string) $phase);
    }

    public function testProcessusesRelationship(): void
    {
        $phase = new Phase();
        $processus = new Processus();

        $this->assertEmpty($phase->getProcessuses());

        $phase->addProcessus($processus);
        $this->assertCount(1, $phase->getProcessuses());
        $this->assertSame($phase, $processus->getPhase());

        $phase->removeProcessus($processus);
        $this->assertEmpty($phase->getProcessuses());
        $this->assertNull($processus->getPhase());
    }

    public function testAddProcessusDoesNotDuplicate(): void
    {
        $phase = new Phase();
        $processus = new Processus();

        $phase->addProcessus($processus);
        $phase->addProcessus($processus);

        $this->assertCount(1, $phase->getProcessuses());
    }
}
