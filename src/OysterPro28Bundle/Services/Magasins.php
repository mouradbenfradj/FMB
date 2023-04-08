<?php
/**
 * Created by PhpStorm.
 * User: moura
 * Date: 02/11/2017
 * Time: 22:16
 */

namespace OysterPro28Bundle\Services;


use Doctrine\Bundle\DoctrineBundle\Registry;

class Magasins
{
    private $doctrine;
    private $listeMagasins = null;

    function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getListeMagasins()
    {
        if (!$this->listeMagasins) {
            $this->setListeMagasins();
        }
        return $this->listeMagasins;
    }

    public function setListeMagasins()
    {
        $listeMagasins = array();
        $magasins = $this->doctrine->getRepository('OysterPro28Bundle:Magasins')->allParcWithContent();
        foreach ($magasins as $magasin) {
            $filieres = array();
            foreach ($magasin->getFilieres() as $filiere) {
                $segments = array();
                foreach ($filiere->getSegments() as $segment) {

                    $segments[] = array(
                        'id' => $segment->getId(),
                        'nomSegment' => $segment->getNomSegment(),
                        'longeur' => $segment->getLongeur(),
                        'flotteurs' => array()
                    );
                }

                $filieres[] = array(
                    'id' => $filiere->getId(),
                    'nomFiliere' => $filiere->getNomFiliere(),
                    'observation' => $filiere->getObservation(),
                    'aireDeTravaille' => $filiere->getAireDeTravaille(),
                    'segments' => $segments
                );
            }
            $tabMagasin = array(
                'idMagasins' => $magasin->getIdMagasin(),
                'libMagasin' => $magasin->getLibMagasin(),
                'abrevMagasin' => $magasin->getAbrevMagasin(),
                'filieres' => $filieres,
                'idStock' => array()//$magasin->getIdStock()
            );


            $listeMagasins[] = $tabMagasin;
        }
        $this->listeMagasins = $listeMagasins;
    }
}