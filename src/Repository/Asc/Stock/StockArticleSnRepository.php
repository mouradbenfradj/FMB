<?php

namespace App\Repository\Asc\Stock;

use App\Entity\Asc\Stock\StockArticleSn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StockArticleSn>
 *
 * @method StockArticleSn|null find($id, $lockMode = null, $lockVersion = null)
 * @method StockArticleSn|null findOneBy(array $criteria, array $orderBy = null)
 * @method StockArticleSn[]    findAll()
 * @method StockArticleSn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockArticleSnRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StockArticleSn::class);
    }

    public function add(StockArticleSn $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(StockArticleSn $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return StockArticleSn[] Returns an array of StockArticleSn objects
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

//    public function findOneBySomeField($value): ?StockArticleSn
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
