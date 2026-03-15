<?php

namespace App\Repository;

use App\Entity\Cycle;
use App\Entity\FruitDeMer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cycle>
 */
class CycleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cycle::class);
    }

    public function findByAgeAndFruitDeMer(int $age, FruitDeMer $fruitDeMer): ?Cycle
    {
        return $this->findOneBy([
            'age' => $age,
            'fruitDeMer' => $fruitDeMer
        ]);
    }
}
