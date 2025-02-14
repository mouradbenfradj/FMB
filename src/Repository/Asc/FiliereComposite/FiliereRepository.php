<?php

namespace App\Repository\Asc\FiliereComposite;

use App\Entity\Asc\FiliereComposite\Filiere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Filiere>
 *
 * @method Filiere|null find($id, $lockMode = null, $lockVersion = null)
 * @method Filiere|null findOneBy(array $criteria, array $orderBy = null)
 * @method Filiere[]    findAll()
 * @method Filiere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FiliereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Filiere::class);
    }

    public function add(Filiere $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Filiere $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Filiere[] Returns an array of Filiere objects
     */
    public function findByParcId(int $id): array
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.parc = :id')
            ->setParameter('id', $id)
            ->innerJoin('f.segments', 's')
            /*             ->innerJoin('s.flotteurs', 'fl') */
            ->innerJoin('s.emplacements', 'e')
            ->orderBy('f.nomFiliere', 'ASC')
            ->getQuery()
            ->getResult();
    }
    /**
     * Compte le nombre de filières associées à un parc donné.
     *
     * @param int $parcId L'ID du parc
     * @return int Nombre de filières
     */
    public function countByParc(int $parcId): int
    {
        return $this->createQueryBuilder('f')
            ->select('COUNT(f.id)')
            ->andWhere('f.parc = :parcId')
            ->setParameter('parcId', $parcId)
            ->getQuery()
            ->getSingleScalarResult();
    }
    //    public function findOneBySomeField($value): ?Filiere
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
