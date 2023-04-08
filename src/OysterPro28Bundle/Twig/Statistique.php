<?php
/**
 * Created by PhpStorm.
 * User: moura
 * Date: 02/11/2017
 * Time: 22:16
 */

namespace OysterPro28Bundle\Twig;


class Statistique extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('nbrParc', array($this, 'nbrParc')),
            new \Twig_SimpleFilter('nbrFiliere', array($this, 'nbrFiliere')),
        );
    }

    public function nbrParc($magasins, $nbr = 0)
    {
        if ($nbr == 0)
            $nbrParc = count($magasins);
        else
            $nbrParc = count($magasins[$nbr - 1]);

        return $nbrParc;

    }

    public function nbrFiliere($magasins, $nbr = 0)
    {
        if ($nbr == 0) {
            $nbrFiliere = 0;
            foreach ($magasins as $magasin) {
                $nbrFiliere = $nbrFiliere + count($magasin->getfilieres());
            }
        } else
            $nbrFiliere = count($magasins[$nbr - 1]->getFilieres());
        return $nbrFiliere;
    }

}