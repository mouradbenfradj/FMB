<?php

namespace App\Controller;

use App\Service\Cache\ParcCacheService;
use App\Service\StatistiqueService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParcController extends AbstractController
{

    /**
     * @Route("/statistique/{parcId}", name="app_parc_statistique", methods={"GET"})
     */
    public function statistique(?int $parcId = 0, StatistiqueService $statistiqueService, ParcCacheService $parcCacheService): Response
    {
        $statistiqueService->setConteneur($parcCacheService);
        $cardBoxes = [
            ['text' => 'Total Parcs', 'icon' => 'fe-home', 'total' => $statistiqueService->total($parcId)]
        ];
        return $this->render('parc/statistique.html.twig', [
            'cardBoxes' => $cardBoxes,
        ]);
    }
}
