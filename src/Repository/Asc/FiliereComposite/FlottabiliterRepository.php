<?php

namespace App\Repository\Asc\FiliereComposite;

use App\Entity\Asc\FiliereComposite\Flottabiliter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Flottabiliter>
 *
 * @method Flottabiliter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Flottabiliter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Flottabiliter[]    findAll()
 * @method Flottabiliter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlottabiliterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Flottabiliter::class);
    }

    public function add(Flottabiliter $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Flottabiliter $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Flottabiliter[] Returns an array of Flottabiliter objects
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

//    public function findOneBySomeField($value): ?Flottabiliter
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
