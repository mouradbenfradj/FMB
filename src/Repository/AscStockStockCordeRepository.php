<?php

namespace App\Repository;

use App\Entity\AscStockStockCorde;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AscStockStockCorde>
 *
 * @method AscStockStockCorde|null find($id, $lockMode = null, $lockVersion = null)
 * @method AscStockStockCorde|null findOneBy(array $criteria, array $orderBy = null)
 * @method AscStockStockCorde[]    findAll()
 * @method AscStockStockCorde[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AscStockStockCordeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AscStockStockCorde::class);
    }

    public function add(AscStockStockCorde $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AscStockStockCorde $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AscStockStockCorde[] Returns an array of AscStockStockCorde objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AscStockStockCorde
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
