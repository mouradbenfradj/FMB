<?php

namespace App\Controller;

use App\Entity\Asc\Parc;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlertesDeTravailController extends AbstractController
{
    /**
     * @Route("/alertes/de/travail/{parc}", name="app_alertes_de_travail", methods={"GET","HEAD"})
     */
    public function index(Parc $parc = null): Response
    {
        return $this->render('alertes_de_travail/index.html.twig', [
            'parc' => $parc,
            'controller_name' => 'AlertesDeTravailController',
        ]);
    }
}
