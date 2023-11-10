<?php

namespace App\Repository\Asc\Alerte;

use App\Entity\Asc\Alerte\AlerteRouge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AlerteRouge>
 *
 * @method AlerteRouge|null find($id, $lockMode = null, $lockVersion = null)
 * @method AlerteRouge|null findOneBy(array $criteria, array $orderBy = null)
 * @method AlerteRouge[]    findAll()
 * @method AlerteRouge[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlerteRougeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AlerteRouge::class);
    }

    public function add(AlerteRouge $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AlerteRouge $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return AlerteRouge[] Returns an array of AlerteRouge objects
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

    //    public function findOneBySomeField($value): ?AlerteRouge
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
