<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OutilsDeGestionController extends AbstractController
{
    /**
     * @Route("/prevision/{parcID}", name="app_prevision")
     */
    public function prevision(int $parcID): Response
    {
        return $this->render('outils_de_gestion/prevision.html.twig', [
            'parcID' => $parcID,
            'controller_name' => 'OutilsDeGestionController',
        ]);
    }
}
