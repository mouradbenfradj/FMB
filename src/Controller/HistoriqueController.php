<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistoriqueController extends AbstractController
{
    /**
     * @Route("/historique/{parcID}", name="app_historique")
     */
    public function index(int $parcID): Response
    {
        return $this->render('historique/index.html.twig', [
            'parcID' => $parcID,
            'controller_name' => 'HistoriqueController',
        ]);
    }
}
