<?php

namespace App\Tests\Service;

use App\Entity\Cycle;
use App\Entity\FruitDeMer;
use App\Service\HuitreCalculator;
use App\Service\MouleCalculator;
use App\Repository\CycleRepository;
use App\Repository\FruitDeMerRepository;
use PHPUnit\Framework\TestCase;

class CalculatorAccuracyTest extends TestCase
{
    private function createMockRepositories(string $fruitDeMerName, array $cycleData)
    {
        $fruitDeMer = new FruitDeMer();
        $fruitDeMer->setNom($fruitDeMerName);

        $fdmRepo = $this->createMock(FruitDeMerRepository::class);
        $fdmRepo->method('findOneBy')->with(['nom' => $fruitDeMerName])->willReturn($fruitDeMer);

        $cycleRepo = $this->createMock(CycleRepository::class);
        $cycleRepo->method('findOneBy')->willReturnCallback(function($criteria) use ($cycleData, $fruitDeMer) {
            $age = $criteria['age'];
            if (isset($cycleData[$age])) {
                $cycle = new Cycle();
                $cycle->setAge($age);
                $cycle->setFruitDeMer($fruitDeMer);
                $cycle->setPoidsParPiece($cycleData[$age]['poids']);
                $cycle->setTauxSurvie($cycleData[$age]['survie'] ?? 0.97);
                return $cycle;
            }
            return null;
        });

        return [$fdmRepo, $cycleRepo];
    }

    public function testHuitrePoidsFromEntity(): void
    {
        $cycleData = [
            5 => ['poids' => 25.0, 'survie' => 0.97],
            10 => ['poids' => 100.0, 'survie' => 0.97]
        ];
        
        list($fdmRepo, $cycleRepo) = $this->createMockRepositories('huitre', $cycleData);
        $calculator = new HuitreCalculator($cycleRepo, $fdmRepo);
        
        $this->assertEquals(25.0, $calculator->calculatePoidsParPiece(5));
        $this->assertEquals(100.0, $calculator->calculatePoidsParPiece(10));
    }

    public function testMoulePoidsFromEntity(): void
    {
        $cycleData = [
            15 => ['poids' => 15.0, 'survie' => 0.9],
            20 => ['poids' => 35.0, 'survie' => 0.9]
        ];
        
        list($fdmRepo, $cycleRepo) = $this->createMockRepositories('moule', $cycleData);
        $calculator = new MouleCalculator($cycleRepo, $fdmRepo);
        
        $this->assertEquals(15.0, $calculator->calculatePoidsParPiece(15));
        $this->assertEquals(35.0, $calculator->calculatePoidsParPiece(20));
    }

    public function testHuitreFallbackWhenNoEntity(): void
    {
        // No cycle data in repo
        list($fdmRepo, $cycleRepo) = $this->createMockRepositories('huitre', []);
        $calculator = new HuitreCalculator($cycleRepo, $fdmRepo);
        
        // Should use fallback value from CSV (0 => 0.16)
        $this->assertEquals(0.16, $calculator->calculatePoidsParPiece(0));
    }
}
