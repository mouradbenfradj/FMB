<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlertesDeTravailController extends AbstractController
{
    /**
     * @Route("/alertes/de/travail/{parcID<\d+>}", name="app_alertes_de_travail", methods={"GET","HEAD"}, requirements={"parcID"="\d+"})
     */
    public function index(int $parcID = 0): Response
    {
        return $this->render('alertes_de_travail/index.html.twig', [
            'parcID' => $parcID,
            'controller_name' => 'AlertesDeTravailController',
        ]);
    }
}
