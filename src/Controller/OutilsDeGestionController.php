<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OutilsDeGestionController extends AbstractController
{
    /**
     * @Route("/prevision", name="app_prevision")
     */
    public function prevision(): Response
    {
        return $this->render('outils_de_gestion/prevision.html.twig', [
            'controller_name' => 'OutilsDeGestionController',
        ]);
    }
}
