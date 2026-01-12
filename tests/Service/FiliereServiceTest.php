<?php

namespace App\Tests\Service;

use App\Entity\Filiere;
use App\Entity\Segment;
use App\Service\FiliereService;
use App\Service\SegmentService;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\ArrayCollection;

class FiliereServiceTest extends TestCase
{
    public function testCalculateValues()
    {
        // Mock SegmentService
        $segmentService = $this->createMock(SegmentService::class);
        $segmentService->expects($this->exactly(2))
            ->method('setSegmentToService');
        $segmentService->method('totalEmplacement')
            ->willReturnOnConsecutiveCalls(2, 3);
        $segmentService->method('emplacementRemplit')
            ->willReturnOnConsecutiveCalls(1, 2);
        $segmentService->method('totalCorde')
            ->willReturnOnConsecutiveCalls(1, 2);
        $segmentService->method('totalCordeHuitre')
            ->willReturnOnConsecutiveCalls(1, 1);
        $segmentService->method('totalCordeMoule')
            ->willReturnOnConsecutiveCalls(0, 1);
        $segmentService->method('totalCordeLanterne')
            ->willReturnOnConsecutiveCalls(0, 1);
        $segmentService->method('totalCordePoche')
            ->willReturnOnConsecutiveCalls(0, 0);
        $segmentService->method('flottabiliter')
            ->willReturnOnConsecutiveCalls(10.0, 15.0);
        $segmentService->method('taille')
            ->willReturnOnConsecutiveCalls(10.0, 20.0);
        $segmentService->method('dateDeMAE')
            ->willReturnOnConsecutiveCalls(null, new \DateTime('2023-01-01'));

        // Create Filiere
        $filiere = $this->createMock(Filiere::class);
        $filiere->method('getNomFiliere')
            ->willReturn('TestFiliere');

        // Mock segments
        $segment1 = $this->createMock(Segment::class);
        $segment2 = $this->createMock(Segment::class);
        $segments = new ArrayCollection([$segment1, $segment2]);
        $filiere->method('getSegments')
            ->willReturn($segments);

        // Create service
        $service = new FiliereService($segmentService);
        $service->setFiliereToService($filiere);

        // Assert
        $this->assertEquals('TestFiliere', $service->ref());
        $this->assertEquals(60.0, $service->remplissage()); // (1+2)/(2+3)*100
        $this->assertEquals(25.0, $service->flottabiliter()); // 10+15
        $this->assertEquals(30.0, $service->taille()); // 10+20
        $this->assertEquals(5, $service->totalEmplacement()); // 2+3
        $this->assertEquals(2, $service->emplacementVide()); // 5-3
        $this->assertEquals(3, $service->emplacementRemplit()); // 1+2
        $this->assertEquals(3, $service->totalCorde()); // 1+2
        $this->assertEquals(2, $service->totalCordeHuitre()); // 1+1
        $this->assertEquals(1, $service->totalCordeMoule()); // 0+1
        $this->assertEquals(1, $service->totalCordeLanterne()); // 0+1
        $this->assertEquals(0, $service->totalCordePoche()); // 0+0
        $this->assertEquals(new \DateTime('2023-01-01'), $service->dateDeMAE());
        $this->assertEquals(0, $service->passageChaussette());
    }

    public function testGetColumn()
    {
        // Similar setup as above
        $segmentService = $this->createMock(SegmentService::class);
        $segmentService->method('totalEmplacement')->willReturn(1);
        $segmentService->method('emplacementRemplit')->willReturn(1);
        $segmentService->method('totalCorde')->willReturn(1);
        $segmentService->method('totalCordeHuitre')->willReturn(1);
        $segmentService->method('totalCordeMoule')->willReturn(0);
        $segmentService->method('totalCordeLanterne')->willReturn(0);
        $segmentService->method('totalCordePoche')->willReturn(0);
        $segmentService->method('flottabiliter')->willReturn(5.0);
        $segmentService->method('taille')->willReturn(5.0);
        $segmentService->method('dateDeMAE')->willReturn(null);

        $filiere = $this->createMock(Filiere::class);
        $filiere->method('getNomFiliere')->willReturn('ColFiliere');
        $segment = $this->createMock(Segment::class);
        $filiere->method('getSegments')->willReturn(new ArrayCollection([$segment]));

        $service = new FiliereService($segmentService);
        $service->setFiliereToService($filiere);

        $column = $service->getColumn();
        $this->assertIsArray($column);
        $this->assertCount(14, $column);
        $this->assertEquals('ColFiliere', $column[0]);
        $this->assertEquals(100.0, $column[1]); // remplissage
    }
}
