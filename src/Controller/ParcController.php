<?php

namespace App\Controller;

use App\Service\ParcService;
use App\Service\StatistiqueService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParcController extends AbstractController
{

    /**
     * @Route("/statistique/{parcId}", name="app_parc_statistique", methods={"GET"})
     */
    public function statistique(?int $parcId = 0, StatistiqueService $statistiqueService, ParcService $parcService): Response
    {
        $statistiqueService->setConteneur($parcService);
        $cardBoxes = [
            ['text' => 'Total Parc', 'icon' => 'fe-sliders', 'total' => $statistiqueService->total($parcId)]
        ];
        return $this->render('parc/statistique.html.twig', [
            'cardBoxes' => $cardBoxes,
        ]);
    }
}
