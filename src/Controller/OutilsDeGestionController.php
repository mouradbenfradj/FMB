<?php

namespace App\Controller;

use App\Entity\Asc\Parc;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OutilsDeGestionController extends AbstractController
{
    /**
     * @Route("/prevision/{parc}", name="app_prevision")
     */
    public function prevision(Parc $parc = null): Response
    {
        return $this->render('outils_de_gestion/prevision.html.twig', [
            'parc' => $parc,
            'controller_name' => 'OutilsDeGestionController',
        ]);
    }
}
