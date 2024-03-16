<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/prod/a/faire")
 */
class ProdAFaireController extends AbstractController
{
    /**
     * @Route("/preparation/{parcID<\d+>}", name="app_preparation", methods={"GET","HEAD"}, requirements={"parcID"="\d+"})
     */
    public function preparationtion(int $parcID = 0): Response
    {
        return $this->render('prod_a_faire/preparation.html.twig', [
            'parcID' => $parcID,
            'controller_name' => 'ProdAFaireController',
        ]);
    }
    /**
     * @Route("/assemblage/{parcID<\d+>}", name="app_assemblage", methods={"GET","HEAD"}, requirements={"parcID"="\d+"})
     */
    public function assemblage(int $parcID = 0): Response
    {
        return $this->render('prod_a_faire/index.html.twig', [
            'parcID' => $parcID,
            'controller_name' => 'ProdAFaireController',
        ]);
    }
    /**
     * @Route("/mise_a_eau/{parcID<\d+>}", name="app_mise_a_eau", methods={"GET","HEAD"}, requirements={"parcID"="\d+"})
     */
    public function miseAEau(int $parcID = 0): Response
    {
        return $this->render('prod_a_faire/index.html.twig', [
            'parcID' => $parcID,
            'controller_name' => 'ProdAFaireController',
        ]);
    }
    /**
     * @Route("/retrait/{parcID<\d+>}", name="app_retrait", methods={"GET","HEAD"}, requirements={"parcID"="\d+"})
     */
    public function retrait(int $parcID = 0): Response
    {
        return $this->render('prod_a_faire/index.html.twig', [
            'parcID' => $parcID,
            'controller_name' => 'ProdAFaireController',
        ]);
    }
    /**
     * @Route("/chaussement/{parcID<\d+>}", name="app_chaussement", methods={"GET","HEAD"}, requirements={"parcID"="\d+"})
     */
    public function chaussement(int $parcID = 0): Response
    {
        return $this->render('prod_a_faire/index.html.twig', [
            'parcID' => $parcID,
            'controller_name' => 'ProdAFaireController',
        ]);
    }
    /**
     * @Route("/commerciale/{parcID<\d+>}", name="app_commerciale", methods={"GET","HEAD"}, requirements={"parcID"="\d+"})
     */
    public function commerciale(int $parcID = 0): Response
    {
        return $this->render('prod_a_faire/index.html.twig', [
            'parcID' => $parcID,
            'controller_name' => 'ProdAFaireController',
        ]);
    }
}
