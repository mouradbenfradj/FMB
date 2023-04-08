<?php

namespace OysterPro28Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($page)
    {
        $nbMagasinsParPage = $this->container->getParameter('front_nb_magasins_par_page');

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('OysterPro28Bundle:Filiere');
        $food = $repo->find(1);
        var_dump($repo->getChildren($food));
        die();
        $magasinsTotal = $em->getRepository('OysterPro28Bundle:Magasins')->findAll();
        if ($page == 0) {
            $page = $page + 1;
        }
        $magasins = $em->getRepository('OysterPro28Bundle:Magasins')
            ->findAllPagineEtTrie($page, $nbMagasinsParPage);
        $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($magasins) / $nbMagasinsParPage),
            'total' => $magasinsTotal,
            'nomRoute' => 'oyster_pro28_homepage',
            'paramsRoute' => array()
        );


        return $this->render('OysterPro28Bundle:Default:index.html.twig', array(
            'magasinsTotal' => $magasinsTotal,
            'magasins' => $magasins,
            'pagination' => $pagination
        ));
    }
}

