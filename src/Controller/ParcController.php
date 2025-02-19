<?php

namespace App\Controller;

use App\Entity\Asc\Parc;
use App\Service\Cache\ParcCacheService;
use App\Service\StatistiqueService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParcController extends AbstractController
{

    /**
     * @Route("/statistique/{parc}", name="app_parc_statistique", methods={"GET"})
     */
    public function statistique(Parc $parc = null, StatistiqueService $statistiqueService, ParcCacheService $parcCacheService): Response
    {
        $statistiqueService->setConteneur($parcCacheService);
        $cardBoxes = [
            ['text' => 'Total Parcs', 'icon' => 'fe-home', 'total' => $statistiqueService->total($parc)]
        ];
        return $this->render('parc/statistique.html.twig', [
            'cardBoxes' => $cardBoxes,
        ]);
    }
}
