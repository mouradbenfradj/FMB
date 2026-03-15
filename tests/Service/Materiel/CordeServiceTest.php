<?php

namespace App\Tests\Service\Materiel;

use DateTime;
use App\Entity\Corde;
use App\Entity\StockCorde;
use App\Entity\StockArticleSn;
use PHPUnit\Framework\TestCase;
use App\Model\PreparationCordeModel;
use App\Service\Materiel\CordeService;
use Doctrine\ORM\EntityManagerInterface;

class CordeServiceTest extends TestCase
{
    public function testPreparation()
    {
        // Mock EntityManager
        $entityManager = $this->createMock(EntityManagerInterface::class);

        // Mock Corde
        $corde = $this->createMock(Corde::class);
        $corde->method('getquantite')->willReturn(100);
        $corde->expects($this->once())
            ->method('setquantite')
            ->with(90); // 100 - 10

        // Mock Lot (StockArticleSn)
        $lot = $this->createMock(StockArticleSn::class);
        $lot->method('getSnQte')->willReturn(50.0);
        $lot->expects($this->exactly(10)) // nombre = 10
            ->method('setSnQte')
            ->with(45.0); // 50.0 - 5

        // Mock Materiel (PreparationCordeModel)
        $materiel = $this->createMock(PreparationCordeModel::class);
        $materiel->method('getCorde')->willReturn($corde);
        $materiel->method('getLot')->willReturn($lot);
        $materiel->method('getNombre')->willReturn('10');
        $materiel->method('getDensite')->willReturn(5);
        $materiel->method('getDatedecreation')->willReturn(new DateTime());
        $materiel->method('getLongeur')->willReturn(10.0);

        // Expect persist calls: corde, then for each i: lot, stockCorde
        $entityManager->expects($this->exactly(21))
            ->method('persist')
            ->withConsecutive(
                [$corde],
                [$lot],
                [$this->isInstanceOf(StockCorde::class)],
                [$lot],
                [$this->isInstanceOf(StockCorde::class)],
                [$lot],
                [$this->isInstanceOf(StockCorde::class)],
                [$lot],
                [$this->isInstanceOf(StockCorde::class)],
                [$lot],
                [$this->isInstanceOf(StockCorde::class)],
                [$lot],
                [$this->isInstanceOf(StockCorde::class)],
                [$lot],
                [$this->isInstanceOf(StockCorde::class)],
                [$lot],
                [$this->isInstanceOf(StockCorde::class)],
                [$lot],
                [$this->isInstanceOf(StockCorde::class)],
                [$lot],
                [$this->isInstanceOf(StockCorde::class)],
                [$lot],
                [$this->isInstanceOf(StockCorde::class)]
            );

        // Create service
        $service = new CordeService($entityManager);

        // Call preparation
        $service->preparation($materiel);
    }
}
