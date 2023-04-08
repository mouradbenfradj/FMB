<?php
/**
 * Created by PhpStorm.
 * User: moura
 * Date: 02/11/2017
 * Time: 18:16
 */

namespace OysterPro28Bundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Tools\Pagination\Paginator;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MagasinsRepository extends EntityRepository
{

    public function StatistiqueGenerals()
    {
        $countnbrFiliere = $this->createQueryBuilder('parc')
            ->select('COUNT(filieres.id) as nbrFiliere')
            ->leftJoin('parc.filieres', 'filieres', 'WITH', 'parc.idMagasin = filieres.parc')
            ->getQuery()->getSQL();


        $countnbrMagasin = $this->createQueryBuilder('parc')
            ->select('COUNT(parc) as nbrParc')
            ->getQuery()->getSQL();
        $rsm = new ResultSetMapping();

        $qb3 = $this->createNativeNamedQuery(
            "SELECT (SELECT COUNT(*) FROM magasins m) as nbrMagasin, (SELECT COUNT(*) FROM magasins m LEFT JOIN filiere f ON m.id_magasin = f.magasin) as nbrFiliere"
            ,
            $r
        );
        var_dump($qb3->getSQL());
        die();

    }

    public function StatistiqueGeneralsByParc($parc)
    {

        $qb = $this->createQueryBuilder('m')
            ->select('SUM(p.nbrTotaleEnStock)')
            ->join('m.poches', 'p')
            ->where('p.parc = :parc')
            ->setParameter('parc', $parc);
        return $qb->getQuery()->getSingleScalarResult();
    }

    public function allParcWithContent()
    {
        $qb = $this->createQueryBuilder('m')
            ->select('m')
            ->addSelect('filieres')
            ->addSelect('segments')
            ->addSelect('flotteurs')
            ->addSelect('emplacements')
            ->leftJoin('m.filieres', 'filieres')
            ->leftJoin('filieres.segments', 'segments')
            ->leftJoin('segments.flotteurs', 'flotteurs')
            ->leftJoin('flotteurs.emplacements', 'emplacements')
            ->getQuery()
            ->getResult();
        return $qb;
    }

    public function findAllPagineEtTrie($page, $nbMaxParPage)
    {
        if (!is_numeric($page)) {
            throw new InvalidArgumentException(
                'La valeur de l\'argument $page est incorrecte (valeur : ' . $page . ').'
            );
        }

        if ($page < 1) {
            throw new NotFoundHttpException('La page demandée n\'existe pas');
        }

        if (!is_numeric($nbMaxParPage)) {
            throw new InvalidArgumentException(
                'La valeur de l\'argument $nbMaxParPage est incorrecte (valeur : ' . $nbMaxParPage . ').'
            );
        }

        $qb = $this->createQueryBuilder('m')
            ->orderBy('m.idMagasin', 'ASC');

        $query = $qb->getQuery();

        $premierResultat = ($page - 1) * $nbMaxParPage;
        $query->setFirstResult($premierResultat)->setMaxResults($nbMaxParPage);
        $paginator = new Paginator($query);

        if (($paginator->count() <= $premierResultat) && $page != 1) {
            throw new NotFoundHttpException('La page demandée n\'existe pas.'); // page 404, sauf pour la première page
        }

        return $paginator;
    }
}