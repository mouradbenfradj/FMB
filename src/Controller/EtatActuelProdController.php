<?php

namespace App\Controller;

use App\Service\FiliereService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtatActuelProdController extends AbstractController
{
    /**
     * @Route("/etat/actuel/prod/{id}", name="app_etat_actuel_prod")
     */
    public function index(FiliereService $filiereService, int $id): Response
    {
        return $this->render('etat_actuel_prod/index.html.twig', [
            'id' => $id,
            'filieres'=>$filiereService->getFilieres($id)
        ]);
    }
}
