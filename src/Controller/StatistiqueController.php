<?php

namespace App\Controller;

use App\Service\ConteneurService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatistiqueController extends AbstractController
{
    /**
     * @Route("/stat/{_locale}/{!parcID<\d+>}", name="app_statistique", methods={"GET","HEAD"}, requirements={"parcID"="\d+"})
     */
    public function index(int $parcID = 0, ConteneurService $conteneurService): Response
    {
        return $this->render('statistique/index.html.twig', [
            'parcID' => $parcID,
            'conteneurs' => $conteneurService->getContainerList()
        ]);
    }
}
