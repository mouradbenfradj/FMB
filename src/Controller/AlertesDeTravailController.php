<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlertesDeTravailController extends AbstractController
{
    /**
     * @Route("/alertes/de/travail", name="app_alertes_de_travail")
     */
    public function index(): Response
    {
        return $this->render('alertes_de_travail/index.html.twig', [
            'controller_name' => 'AlertesDeTravailController',
        ]);
    }
}
