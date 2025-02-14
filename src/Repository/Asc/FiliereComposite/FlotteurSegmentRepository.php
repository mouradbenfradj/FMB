<?php

namespace App\Repository\Asc\FiliereComposite;

use App\Entity\Asc\FiliereComposite\FlotteurSegment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FlotteurSegment>
 *
 * @method FlotteurSegment|null find($id, $lockMode = null, $lockVersion = null)
 * @method FlotteurSegment|null findOneBy(array $criteria, array $orderBy = null)
 * @method FlotteurSegment[]    findAll()
 * @method FlotteurSegment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlotteurSegmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FlotteurSegment::class);
    }

    public function add(FlotteurSegment $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FlotteurSegment $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return FlotteurSegment[] Returns an array of FlotteurSegment objects
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

//    public function findOneBySomeField($value): ?FlotteurSegment
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
