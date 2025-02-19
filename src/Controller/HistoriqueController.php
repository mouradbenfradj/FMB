<?php

namespace App\Controller;

use App\Entity\Asc\Parc;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistoriqueController extends AbstractController
{
    /**
     * @Route("/historique/{parc}", name="app_historique")
     */
    public function index(Parc $parc = null): Response
    {
        return $this->render('historique/index.html.twig', [
            'parc' => $parc,
            'controller_name' => 'HistoriqueController',
        ]);
    }
}
