<?php

namespace App\Repository;

use App\Entity\Corde;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Corde>
 */
class CordeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Corde::class);
    }

    public function countCordesVides(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('c')
            ->select('SUM(c.quantite)');
        if ($parcId !== 0) {
            $qb->where('c.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    }
    //    /**
    //     * @return Corde[] Returns an array of Corde objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Corde
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
