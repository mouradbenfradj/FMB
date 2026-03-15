<?php

namespace App\Repository;

use App\Entity\StockLanterne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StockLanterne>
 */
class StockLanterneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StockLanterne::class);
    }

    /**
     * Compte le total des lanternes pour un parc donné
     */
    public function countTotalLanternes(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('sl')
            ->select('COUNT(sl.id)');

        if ($parcId !== 0) {
            $qb->leftJoin('sl.stockArticleSn', 'sn')
                ->leftJoin('sn.stockArticle', 'sa')
                ->leftJoin('sa.stock', 's')
                ->andWhere('s.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Compte les lanternes à l'eau (emplacement != null, dateDeMiseAEau != null)
     */
    public function countLanternesALeau(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('sl')
            ->select('COUNT(sl.id)')
            ->where('sl.emplacement IS NOT NULL')
            ->andWhere('sl.dateDeMiseAEau IS NOT NULL');

        if ($parcId !== 0) {
            $qb->leftJoin('sl.stockArticleSn', 'sn')
                ->leftJoin('sn.stockArticle', 'sa')
                ->leftJoin('sa.stock', 's')
                ->andWhere('s.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Compte les lanternes vides (sans StockArticleSn ou quantite = 0)
     */
    public function countLanternesVides(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('sl')
            ->select('COUNT(sl.id)')
            ->where('sl.quantite IS NULL OR sl.quantite = 0');

        if ($parcId !== 0) {
            $qb->leftJoin('sl.stockArticleSn', 'sn')
                ->leftJoin('sn.stockArticle', 'sa')
                ->leftJoin('sa.stock', 's')
                ->andWhere('s.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Compte les lanternes préparées (pret = false, emplacement = null)
     */
    public function countLanternesPreparees(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('sl')
            ->select('COUNT(sl.id)')
            ->where('sl.pret = :pret')
            ->andWhere('sl.emplacement IS NULL')
            ->setParameter('pret', false);

        if ($parcId !== 0) {
            $qb->leftJoin('sl.stockArticleSn', 'sn')
                ->leftJoin('sn.stockArticle', 'sa')
                ->leftJoin('sa.stock', 's')
                ->andWhere('s.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Compte les lanternes avec chaussement (chaussement = true)
     * Note: Cette méthode nécessite d'ajouter le champ chaussement à StockLanterne
     */
    /* public function countChaussettesLanternes(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('sl')
            ->select('COUNT(sl.id)')
            ->where('sl.chaussement = :chaussement')
            ->setParameter('chaussement', true);

        if ($parcId !== 0) {
            $qb->leftJoin('sl.stockArticleSn', 'sn')
                ->leftJoin('sn.stock', 's')
                ->andWhere('s.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    } */
}
