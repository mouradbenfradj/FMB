<?php

namespace App\Repository;

use App\Entity\Parc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Parc>
 */
class OldParcRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Parc::    /**
     * Récupère toutes les statistiques du parc en une seule requête SQL
     */
    public function getParcStats($parcId): array
    {
        $sql = "SELECT
            -- Cordes stats
            (SELECT COUNT(sc.id) FROM stock_materiel sc 
                LEFT JOIN emplacement e ON sc.emplacement_id = e.id LEFT JOIN segment s ON e.segment_id = s.id LEFT JOIN filiere f ON s.filiere_id = f.id
                WHERE sc.type = 'corde' AND sc.pret = 0 AND sc.emplacement_id IS NULL AND sc.date_de_mise_a_eau IS NULL AND (:parcId = 0 OR f.parc_id = :parcId)) as cordes_preparees_a_sec,
            (SELECT COUNT(sc.id) FROM stock_materiel sc 
                LEFT JOIN emplacement e ON sc.emplacement_id = e.id LEFT JOIN segment s ON e.segment_id = s.id LEFT JOIN filiere f ON s.filiere_id = f.id
                WHERE sc.type = 'corde' AND sc.pret = 0 AND sc.emplacement_id IS NOT NULL AND sc.date_de_mise_a_eau IS NOT NULL AND sc.datedecreation IS NOT NULL AND (:parcId = 0 OR f.parc_id = :parcId)) as cordes_a_leau,
            (SELECT SUM(c.quantite) FROM corde c WHERE (:parcId = 0 OR c.parc_id = :parcId)) as cordes_vides,
            (SELECT COUNT(sc.id) FROM stock_materiel sc 
                LEFT JOIN emplacement e ON sc.emplacement_id = e.id LEFT JOIN segment s ON e.segment_id = s.id LEFT JOIN filiere f ON s.filiere_id = f.id
                WHERE sc.type = 'corde' AND sc.pret = 0 AND (:parcId = 0 OR f.parc_id = :parcId)) as total_cordes,
            (SELECT COUNT(sc.id) FROM stock_materiel sc 
                LEFT JOIN emplacement e ON sc.emplacement_id = e.id LEFT JOIN segment s ON e.segment_id = s.id LEFT JOIN filiere f ON s.filiere_id = f.id
                LEFT JOIN corde co ON sc.corde_id = co.id LEFT JOIN fruit_de_mer fdm ON co.fruit_de_mer_id = fdm.id
                WHERE sc.type = 'corde' AND sc.pret = 0 AND sc.emplacement_id IS NOT NULL AND sc.date_de_mise_a_eau IS NOT NULL AND fdm.nom LIKE '%Huître%' AND (:parcId = 0 OR f.parc_id = :parcId)) as cordes_huitres_a_leau,
            (SELECT COUNT(sc.id) FROM stock_materiel sc 
                LEFT JOIN emplacement e ON sc.emplacement_id = e.id LEFT JOIN segment s ON e.segment_id = s.id LEFT JOIN filiere f ON s.filiere_id = f.id
                LEFT JOIN corde co ON sc.corde_id = co.id LEFT JOIN fruit_de_mer fdm ON co.fruit_de_mer_id = fdm.id
                WHERE sc.type = 'corde' AND sc.pret = 0 AND sc.emplacement_id IS NOT NULL AND sc.date_de_mise_a_eau IS NOT NULL AND fdm.nom LIKE '%Moule%' AND (:parcId = 0 OR f.parc_id = :parcId)) as cordes_moules_a_leau,
            (SELECT COUNT(sc.id) FROM stock_materiel sc 
                LEFT JOIN emplacement e ON sc.emplacement_id = e.id LEFT JOIN segment s ON e.segment_id = s.id LEFT JOIN filiere f ON s.filiere_id = f.id
                WHERE sc.type = 'corde' AND sc.chaussement = 1 AND (:parcId = 0 OR f.parc_id = :parcId)) as chaussettes_cordes_a_leau,
            (SELECT COUNT(sc.id) FROM stock_materiel sc 
                LEFT JOIN emplacement e ON sc.emplacement_id = e.id LEFT JOIN segment s ON e.segment_id = s.id LEFT JOIN filiere f ON s.filiere_id = f.id
                LEFT JOIN corde co ON sc.corde_id = co.id LEFT JOIN fruit_de_mer fdm ON co.fruit_de_mer_id = fdm.id
                WHERE sc.type = 'corde' AND sc.pret = 0 AND sc.emplacement_id IS NULL AND fdm.nom = 'Moule' AND (:parcId = 0 OR f.parc_id = :parcId)) as cordes_moules_preparees,
            (SELECT COUNT(sc.id) FROM stock_materiel sc 
                LEFT JOIN emplacement e ON sc.emplacement_id = e.id LEFT JOIN segment s ON e.segment_id = s.id LEFT JOIN filiere f ON s.filiere_id = f.id
                LEFT JOIN corde co ON sc.corde_id = co.id LEFT JOIN fruit_de_mer fdm ON co.fruit_de_mer_id = fdm.id
                WHERE sc.type = 'corde' AND sc.pret = 0 AND sc.emplacement_id IS NULL AND fdm.nom = 'Huître' AND (:parcId = 0 OR f.parc_id = :parcId)) as cordes_huitres_preparees,
            (SELECT COUNT(sc.id) FROM stock_materiel sc 
                LEFT JOIN emplacement e ON sc.emplacement_id = e.id LEFT JOIN segment s ON e.segment_id = s.id LEFT JOIN filiere f ON s.filiere_id = f.id
                WHERE sc.type = 'corde' AND sc.dateassemblage IS NOT NULL AND sc.emplacement_id IS NULL AND (:parcId = 0 OR f.parc_id = :parcId)) as cordes_assemblees_preparees,
            (SELECT COUNT(sc.id) FROM stock_materiel sc 
                LEFT JOIN emplacement e ON sc.emplacement_id = e.id LEFT JOIN segment s ON e.segment_id = s.id LEFT JOIN filiere f ON s.filiere_id = f.id
                WHERE sc.type = 'corde' AND sc.dateassemblage IS NOT NULL AND sc.emplacement_id IS NOT NULL AND (:parcId = 0 OR f.parc_id = :parcId)) as cordes_assemblees_a_leau,

            -- Lanternes stats
            (SELECT COUNT(sl.id) FROM stock_materiel sl 
                LEFT JOIN stock_article_sn sn ON sl.stock_article_sn_id = sn.id LEFT JOIN stock_article sa ON sn.stock_article_id = sa.id LEFT JOIN stock s ON sa.stock_id = s.id
                WHERE sl.type = 'lanterne' AND (:parcId = 0 OR s.parc_id = :parcId)) as total_lanternes,
            (SELECT COUNT(sl.id) FROM stock_materiel sl 
                LEFT JOIN stock_article_sn sn ON sl.stock_article_sn_id = sn.id LEFT JOIN stock_article sa ON sn.stock_article_id = sa.id LEFT JOIN stock s ON sa.stock_id = s.id
                WHERE sl.type = 'lanterne' AND sl.emplacement_id IS NOT NULL AND sl.date_de_mise_a_eau IS NOT NULL AND (:parcId = 0 OR s.parc_id = :parcId)) as lanternes_a_leau,
            (SELECT COUNT(sl.id) FROM stock_materiel sl 
                LEFT JOIN stock_article_sn sn ON sl.stock_article_sn_id = sn.id LEFT JOIN stock_article sa ON sn.stock_article_id = sa.id LEFT JOIN stock s ON sa.stock_id = s.id
                WHERE sl.type = 'lanterne' AND (sl.quantite IS NULL OR sl.quantite = 0) AND (:parcId = 0 OR s.parc_id = :parcId)) as lanternes_vides,
            (SELECT COUNT(sl.id) FROM stock_materiel sl 
                LEFT JOIN stock_article_sn sn ON sl.stock_article_sn_id = sn.id LEFT JOIN stock_article sa ON sn.stock_article_id = sa.id LEFT JOIN stock s ON sa.stock_id = s.id
                WHERE sl.type = 'lanterne' AND sl.pret = 0 AND sl.emplacement_id IS NULL AND (:parcId = 0 OR s.parc_id = :parcId)) as lanternes_preparees,

            -- Poches stats
            (SELECT SUM(sa.quantite) FROM stock_article sa 
                LEFT JOIN stock s ON sa.stock_id = s.id WHERE (:parcId = 0 OR s.parc_id = :parcId)) as total_poches,
            (SELECT SUM(sa.quantite) FROM stock_article sa 
                LEFT JOIN stock_article_sn sn ON sa.id = sn.stock_article_id JOIN stock_materiel sm ON sn.id = sm.stock_article_sn_id LEFT JOIN stock s ON sa.stock_id = s.id
                WHERE sm.type = 'corde' AND (:parcId = 0 OR s.parc_id = :parcId)) as poches_a_leau,
            (SELECT COUNT(sa.id) FROM stock_article sa 
                LEFT JOIN stock s ON sa.stock_id = s.id WHERE (sa.quantite IS NULL OR sa.quantite = 0) AND (:parcId = 0 OR s.parc_id = :parcId)) as poches_vides,
            (SELECT SUM(sa.quantite) FROM stock_article sa 
                LEFT JOIN stock_article_sn sn ON sa.id = sn.stock_article_id LEFT JOIN stock_materiel sm ON sn.id = sm.stock_article_sn_id LEFT JOIN stock s ON sa.stock_id = s.id
                WHERE (sm.id IS NULL OR sm.pret = 0) AND sm.emplacement_id IS NULL AND (:parcId = 0 OR s.parc_id = :parcId)) as poches_preparees,
            (SELECT SUM(sa.quantite) FROM stock_article sa 
                LEFT JOIN stock s ON sa.stock_id = s.id WHERE sa.articles_id IS NOT NULL AND (:parcId = 0 OR s.parc_id = :parcId)) as poches_assemblees,
            (SELECT SUM(sa.quantite) FROM stock_article sa 
                LEFT JOIN stock_article_sn sn ON sa.id = sn.stock_article_id LEFT JOIN stock_materiel sm ON sn.id = sm.stock_article_sn_id LEFT JOIN stock s ON sa.stock_id = s.id
                WHERE sa.articles_id IS NOT NULL AND sm.emplacement_id IS NOT NULL AND sm.date_de_mise_a_eau IS NOT NULL AND (:parcId = 0 OR s.parc_id = :parcId)) as poches_assemblees_a_leau,
            (SELECT SUM(sa.quantite) FROM stock_article sa 
                LEFT JOIN stock_article_sn sn ON sa.id = sn.stock_article_id LEFT JOIN stock_materiel sm ON sn.id = sm.stock_article_sn_id LEFT JOIN stock s ON sa.stock_id = s.id
                WHERE sm.emplacement_id IS NOT NULL AND sm.date_de_mise_a_eau IS NOT NULL AND (:parcId = 0 OR s.parc_id = :parcId)) as chaussettes_poches_a_leau
        ";

        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        return $stmt->executeQuery(['parcId' => $parcId])->fetchAssociative();
    }

class);
    }

    //    /**
    //     * @return Parc[] Returns an array of Parc objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Parc
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}