<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\ParcEnchiffre\ParcEnchiffreService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
    //#[Route('/')]
    //#[Route('/{parc}', name: 'app_home')]
    #[Route('/', name: 'app_home')]
    public function index(
        Request $request,
        ParcEnchiffreService $parcEnchiffreService
    ): Response {
        // Récupérer le parc ID depuis la requête (session, paramètre, etc.)
        $parcId = $request->getSession()->get('selected_parc_id');
        // Calculer les statistiques pour les cordes
        $stats =  $parcEnchiffreService->getData($parcId);


        return $this->render('home/index.html.twig', [
            'stats' => $stats,
        ]);
    }
}
