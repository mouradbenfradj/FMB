<?php

namespace App\Tests\Service;

use App\Entity\Segment;
use App\Entity\Emplacement;
use App\Entity\FlotteurSegment;
use App\Service\SegmentService;
use PHPUnit\Framework\TestCase;
use App\Service\EmplacementService;
use App\Service\FlotteurSegmentService;
use Doctrine\Common\Collections\ArrayCollection;

class SegmentServiceTest extends TestCase
{
    public function testCalculateValues()
    {
        // Mock EmplacementService
        $emplacementService = $this->createMock(EmplacementService::class);
        $emplacementService->expects($this->exactly(2))
            ->method('setEmplacementToService');
        $emplacementService->method('isEmpty')
            ->willReturnOnConsecutiveCalls(true, false);
        $emplacementService->method('haseCorde')
            ->willReturnOnConsecutiveCalls(false, true);
        $emplacementService->method('haseCordeHuitre')
            ->willReturnOnConsecutiveCalls(false, true);
        $emplacementService->method('haseCordeMoule')
            ->willReturnOnConsecutiveCalls(false, false);
        $emplacementService->method('haseLanterne')
            ->willReturnOnConsecutiveCalls(false, false);
        $emplacementService->method('hasePoche')
            ->willReturnOnConsecutiveCalls(false, false);

        // Mock FlotteurSegmentService
        $flotteurSegmentService = $this->createMock(FlotteurSegmentService::class);
        $flotteurSegmentService->expects($this->once())
            ->method('setFlotteurSegmentToService');
        $flotteurSegmentService->method('getFlottabiliter')
            ->willReturn(10.0);

        // Create Segment
        $segment = $this->createMock(Segment::class);
        $segment->method('getNomsegment')
            ->willReturn('TestSegment');
        $segment->method('getLongeur')
            ->willReturn(10.0);

        // Mock emplacements collection
        $emplacement1 = $this->createMock(Emplacement::class);
        $emplacement1->method('getStockCordes')
            ->willReturn(new ArrayCollection());
        $emplacement1->method('getStockLanternes')
            ->willReturn(new ArrayCollection());

        $emplacement2 = $this->createMock(Emplacement::class);
        $emplacement2->method('getStockCordes')
            ->willReturn(new ArrayCollection()); // Empty for simplicity, but service uses EmplacementService
        $emplacement2->method('getStockLanternes')
            ->willReturn(new ArrayCollection());

        $emplacements = new ArrayCollection([$emplacement1, $emplacement2]);
        $segment->method('getEmplacements')
            ->willReturn($emplacements);

        // Mock flotteurSegments
        $flotteurSegment = $this->createMock(FlotteurSegment::class);
        $flotteurSegments = new ArrayCollection([$flotteurSegment]);
        $segment->method('getFlotteurSegments')
            ->willReturn($flotteurSegments);

        // Create service
        $service = new SegmentService($emplacementService, $flotteurSegmentService);
        $service->setSegmentToService($segment);

        // Assert
        $this->assertEquals('TestSegment', $service->ref());
        $this->assertEquals(50.0, $service->remplissage()); // 1 out of 2 filled
        $this->assertEquals(10.0, $service->flottabiliter());
        $this->assertEquals(10.0, $service->taille());
        $this->assertEquals(2, $service->totalEmplacement());
        $this->assertEquals(1, $service->emplacementVide());
        $this->assertEquals(1, $service->emplacementRemplit());
        $this->assertEquals(1, $service->totalCorde());
        $this->assertEquals(1, $service->totalCordeHuitre());
        $this->assertEquals(0, $service->totalCordeMoule());
        $this->assertEquals(0, $service->totalCordeLanterne());
        $this->assertEquals(0, $service->totalCordePoche());
        $this->assertNull($service->dateDeMAE()); // No dates mocked
        $this->assertEquals(0, $service->passageChaussette());
    }
}
