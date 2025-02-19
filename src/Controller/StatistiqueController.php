<?php

namespace App\Controller;

use App\Entity\Asc\Parc;
use App\Service\ConteneurService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatistiqueController extends AbstractController
{
    /**
     * @Route("/stat/{_locale}/{parc}", name="app_statistique", methods={"GET","HEAD"}, defaults={"parc"=null})
     */
    public function index(Parc $parc = null, ConteneurService $conteneurService): Response
    {
        return $this->render('statistique/index.html.twig', [
            'parc' => $parc,
            'conteneurs' => $conteneurService->getContainerList(),
        ]);
    }
}
