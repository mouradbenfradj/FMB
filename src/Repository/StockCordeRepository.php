<?php

namespace App\Repository;

use App\Entity\StockCorde;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<StockCorde>
 */
class StockCordeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StockCorde::class);
    }

    /**
     * Compte les cordes préparées à sec (pret=false, emplacement=null, dateDeMiseAEau=null)
     * pour un parc donné
     */
    public function countCordesPreparteesASec(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('sc')
            ->select('COUNT(sc.id)')
            ->where('sc.pret = :pret')
            ->andWhere('sc.emplacement IS NULL')
            ->andWhere('sc.dateDeMiseAEau IS NULL')
            ->setParameter('pret', false);

        if ($parcId !== 0) {
            $qb->leftJoin('sc.emplacement', 'e')
                ->leftJoin('e.segment', 's')
                ->leftJoin('s.filiere', 'f')
                ->andWhere('f.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Compte les cordes à l'eau (pret=false, emplacement!=null, dateDeMiseAEau!=null)
     * pour un parc donné
     */
    public function countCordesALeau(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('sc')
            ->select('COUNT(sc.id)')
            ->leftJoin('sc.emplacement', 'e')
            ->where('sc.pret = :pret')
            ->andWhere('sc.emplacement IS NOT NULL')
            ->andWhere('sc.dateDeMiseAEau IS NOT NULL')
            ->andWhere('sc.datedecreation IS NOT NULL')
            ->setParameter('pret', false);

        if ($parcId !== 0) {
            $qb->leftJoin('e.segment', 's')
                ->leftJoin('s.filiere', 'f')
                ->andWhere('f.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Compte les cordes vides (quantite=0 ou null)
     * pour un parc donné
     */
    public function countCordesVides(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('sc')
            ->select('SUM(sc.quantite)');

        if ($parcId !== 0) {
            $qb->leftJoin('sc.emplacement', 'e')
                ->leftJoin('e.segment', 's')
                ->leftJoin('s.filiere', 'f')
                ->andWhere('f.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Compte le total des cordes (pret=false)
     * pour un parc donné
     */
    public function countTotalCordes(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('sc')
            ->select('COUNT(sc.id)')
            ->where('sc.pret = :pret')
            ->setParameter('pret', false);

        if ($parcId !== 0) {
            $qb->leftJoin('sc.emplacement', 'e')
                ->leftJoin('e.segment', 's')
                ->leftJoin('s.filiere', 'f')
                ->andWhere('f.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Compte les cordes huîtres à l'eau (pret=false, emplacement!=null, dateDeMiseAEau!=null, corde.fruitDeMer='Huître')
     * pour un parc donné
     */
    public function countCordesHuitresALeau(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('sc')
            ->select('COUNT(sc.id)')
            ->leftJoin('sc.emplacement', 'e')
            ->leftJoin('sc.corde', 'c')
            ->leftJoin('c.fruitDeMer', 'fdm')
            ->where('sc.pret = :pret')
            ->andWhere('sc.emplacement IS NOT NULL')
            ->andWhere('sc.dateDeMiseAEau IS NOT NULL')
            ->andWhere('fdm.nom LIKE :fruitNom')
            ->setParameter('pret', false)
            ->setParameter('fruitNom', '%Huître%');

        if ($parcId !== 0) {
            $qb->leftJoin('e.segment', 's')
                ->leftJoin('s.filiere', 'f')
                ->andWhere('f.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Compte les cordes moules à l'eau (pret=false, emplacement!=null, dateDeMiseAEau!=null, corde.fruitDeMer='Moule')
     * pour un parc donné
     */
    public function countCordesMoulesALeau(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('sc')
            ->select('COUNT(sc.id)')
            ->leftJoin('sc.emplacement', 'e')
            ->leftJoin('sc.corde', 'c')
            ->leftJoin('c.fruitDeMer', 'fdm')
            ->where('sc.pret = :pret')
            ->andWhere('sc.emplacement IS NOT NULL')
            ->andWhere('sc.dateDeMiseAEau IS NOT NULL')
            ->andWhere('fdm.nom LIKE :fruitNom')
            ->setParameter('pret', false)
            ->setParameter('fruitNom', '%Moule%');

        if ($parcId !== 0) {
            $qb->leftJoin('e.segment', 's')
                ->leftJoin('s.filiere', 'f')
                ->andWhere('f.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Compte les chaussettes/cordes à l'eau (chaussement=true)
     * pour un parc donné
     */
    public function countChaussettesCordesALeau(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('sc')
            ->select('COUNT(sc.id)')
            ->leftJoin('sc.emplacement', 'e')
            ->where('sc.chaussement = :chaussement')
            ->setParameter('chaussement', true);

        if ($parcId !== 0) {
            $qb->leftJoin('e.segment', 's')
                ->leftJoin('s.filiere', 'f')
                ->andWhere('f.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Compte les cordes moules préparées (pret=false, emplacement=null, corde.fruitDeMer='Moule')
     * pour un parc donné
     */
    public function countCordesMoulesPreparees(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('sc')
            ->select('COUNT(sc.id)')
            ->leftJoin('sc.corde', 'c')
            ->leftJoin('c.fruitDeMer', 'fdm')
            ->where('sc.pret = :pret')
            ->andWhere('sc.emplacement IS NULL')
            ->andWhere('fdm.nom = :fruitNom')
            ->setParameter('pret', false)
            ->setParameter('fruitNom', 'Moule');

        if ($parcId !== 0) {
            $qb->leftJoin('sc.emplacement', 'e')
                ->leftJoin('e.segment', 's')
                ->leftJoin('s.filiere', 'f')
                ->andWhere('f.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Compte les cordes huîtres préparées (pret=false, emplacement=null, corde.fruitDeMer='Huître')
     * pour un parc donné
     */
    public function countCordesHuitresPreparees(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('sc')
            ->select('COUNT(sc.id)')
            ->leftJoin('sc.corde', 'c')
            ->leftJoin('c.fruitDeMer', 'fdm')
            ->where('sc.pret = :pret')
            ->andWhere('sc.emplacement IS NULL')
            ->andWhere('fdm.nom = :fruitNom')
            ->setParameter('pret', false)
            ->setParameter('fruitNom', 'Huître');

        if ($parcId !== 0) {
            $qb->leftJoin('sc.emplacement', 'e')
                ->leftJoin('e.segment', 's')
                ->leftJoin('s.filiere', 'f')
                ->andWhere('f.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Compte les cordes assemblées préparées (dateassemblage IS NOT NULL, emplacement IS NULL)
     */
    public function countCordesAssembleesPreparees(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('sc')
            ->select('COUNT(sc.id)')
            ->where('sc.dateassemblage IS NOT NULL')
            ->andWhere('sc.emplacement IS NULL');

        if ($parcId !== 0) {
            $qb->leftJoin('sc.emplacement', 'e')
                ->leftJoin('e.segment', 's')
                ->leftJoin('s.filiere', 'f')
                ->andWhere('f.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Compte les cordes assemblées à l'eau (dateassemblage IS NOT NULL, emplacement IS NOT NULL)
     */
    public function countCordesAssembleesALeau(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('sc')
            ->select('COUNT(sc.id)')
            ->where('sc.dateassemblage IS NOT NULL')
            ->andWhere('sc.emplacement IS NOT NULL');

        if ($parcId !== 0) {
            $qb->leftJoin('sc.emplacement', 'e')
                ->leftJoin('e.segment', 's')
                ->leftJoin('s.filiere', 'f')
                ->andWhere('f.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    }
}
