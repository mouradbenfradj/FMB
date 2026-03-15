<?php

namespace App\Repository;

use App\Entity\StockArticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StockArticle>
 */
class StockArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StockArticle::class);
    }

    /**
     * Compte le total des poches pour un parc donné
     */
    public function countTotalPoches(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('sa')
            ->select('SUM(sa.quantite)');

        if ($parcId !== 0) {
            $qb->leftJoin('sa.stock', 's')
                ->andWhere('s.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        $result = $qb->getQuery()->getSingleScalarResult();
        return $result ? (int) $result : 0;
    }

    /**
     * Compte les poches à l'eau (emplacement != null dans stockArticleSn)
     */
    public function countPochesALeau(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('sa')
            ->select('SUM(sa.quantite)')
            ->leftJoin('sa.stockArticleSns', 'sns')
            ->leftJoin('sns.stockMateriels', 'sm')
            ->where('sns.stockMateriels IS NOT EMPTY')
            ->andWhere('sm INSTANCE OF App\\Entity\\StockCorde');

        if ($parcId !== 0) {
            $qb->leftJoin('sa.stock', 's')
                ->andWhere('s.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        $result = $qb->getQuery()->getSingleScalarResult();
        return $result ? (int) $result : 0;
    }

    /**
     * Compte les poches vides (quantite = 0 ou null)
     */
    public function countPochesVides(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('sa')
            ->select('COUNT(sa.id)')
            ->where('sa.quantite IS NULL OR sa.quantite = 0');

        if ($parcId !== 0) {
            $qb->leftJoin('sa.stock', 's')
                ->andWhere('s.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Compte les poches préparées (pret = false, emplacement = null)
     */
    public function countPochesPreparees(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('sa')
            ->select('SUM(sa.quantite)')
            ->leftJoin('sa.stockArticleSns', 'sns')
            ->leftJoin('sns.stockMateriels', 'sm')
            ->where('sm.id IS NULL OR sm.pret = :pret')
            ->andWhere('sm.emplacement IS NULL')
            ->setParameter('pret', false);

        if ($parcId !== 0) {
            $qb->leftJoin('sa.stock', 's')
                ->andWhere('s.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        $result = $qb->getQuery()->getSingleScalarResult();
        return $result ? (int) $result : 0;
    }

    /**
     * Compte les poches assemblées
     */
    public function countPochesAssemblees(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('sa')
            ->select('SUM(sa.quantite)');

        // Exclure les articles qui ne sont pas des poches
        $qb->andWhere('sa.articles IS NOT NULL');

        if ($parcId !== 0) {
            $qb->leftJoin('sa.stock', 's')
                ->andWhere('s.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        $result = $qb->getQuery()->getSingleScalarResult();
        return $result ? (int) $result : 0;
    }

    /**
     * Compte les poches assemblées à l'eau
     */
    public function countPochesAssembleesALeau(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('sa')
            ->select('SUM(sa.quantite)')
            ->leftJoin('sa.stockArticleSns', 'sns')
            ->leftJoin('sns.stockMateriels', 'sm')
            ->where('sa.articles IS NOT NULL')
            ->andWhere('sm.emplacement IS NOT NULL')
            ->andWhere('sm.dateDeMiseAEau IS NOT NULL');

        if ($parcId !== 0) {
            $qb->leftJoin('sa.stock', 's')
                ->andWhere('s.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        $result = $qb->getQuery()->getSingleScalarResult();
        return $result ? (int) $result : 0;
    }

    /**
     * Compte les chaussettes/poches à l'eau
     */
    public function countChaussettesPochesALeau(?int $parcId = null): int
    {
        $qb = $this->createQueryBuilder('sa')
            ->select('SUM(sa.quantite)')
            ->leftJoin('sa.stockArticleSns', 'sns')
            ->leftJoin('sns.stockMateriels', 'sm')
            ->where('sm.emplacement IS NOT NULL')
            ->andWhere('sm.dateDeMiseAEau IS NOT NULL');

        if ($parcId !== 0) {
            $qb->leftJoin('sa.stock', 's')
                ->andWhere('s.parc = :parcId')
                ->setParameter('parcId', $parcId);
        }

        $result = $qb->getQuery()->getSingleScalarResult();
        return $result ? (int) $result : 0;
    }
}
