<?php

namespace App\Repository\Asc;

use App\Entity\Asc\StocksArticles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StocksArticles>
 *
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

    public function add(StocksArticles $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(StocksArticles $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return StocksArticles[] Returns an array of StocksArticles objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StocksArticles
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
