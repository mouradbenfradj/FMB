<?php

namespace App\Repository\Asc;

use App\Entity\Asc\FruitDeMer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FruitDeMer>
 *
 * @method FruitDeMer|null find($id, $lockMode = null, $lockVersion = null)
 * @method FruitDeMer|null findOneBy(array $criteria, array $orderBy = null)
 * @method FruitDeMer[]    findAll()
 * @method FruitDeMer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FruitDeMerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FruitDeMer::class);
    }

    public function add(FruitDeMer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FruitDeMer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return FruitDeMer[] Returns an array of FruitDeMer objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FruitDeMer
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
