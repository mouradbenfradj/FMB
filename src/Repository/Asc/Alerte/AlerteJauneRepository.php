<?php

namespace App\Repository\Asc\Alerte;

use App\Entity\Asc\Alerte\AlerteJaune;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AlerteJaune>
 *
 * @method AlerteJaune|null find($id, $lockMode = null, $lockVersion = null)
 * @method AlerteJaune|null findOneBy(array $criteria, array $orderBy = null)
 * @method AlerteJaune[]    findAll()
 * @method AlerteJaune[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlerteJauneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AlerteJaune::class);
    }

    public function add(AlerteJaune $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AlerteJaune $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return AlerteJaune[] Returns an array of AlerteJaune objects
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

    //    public function findOneBySomeField($value): ?AlerteJaune
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
