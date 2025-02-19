<?php

namespace App\Controller;

use App\Entity\Asc\Parc;
use App\Service\FiliereService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/etat/actuel/prod")
 */
class EtatActuelProdController extends AbstractController
{
    /**
     * @Route("/{parc}", name="app_etat_actuel_prod")
     */
    public function index(Parc $parc): Response
    {
        return $this->render('etat_actuel_prod/index.html.twig', [
            'parc' => $parc
        ]);
    }
}
