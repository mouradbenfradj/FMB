<?php

namespace App\Repository;

use App\Entity\StocksArticles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method StocksArticles|null find($id, $lockMode = null, $lockVersion = null)
 * @method StocksArticles|null findOneBy(array $criteria, array $orderBy = null)
 * @method StocksArticles[]    findAll()
 * @method StocksArticles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StocksArticlesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StocksArticles::class);
    }

    // /**
    //  * @return StocksArticles[] Returns an array of StocksArticles objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StocksArticles
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

}
