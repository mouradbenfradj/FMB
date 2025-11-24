<?php

namespace App\Controller;

use App\Service\ParcCacheService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Attribute\Route;

final class ClearCacheController extends AbstractController
{
    #[Route('/clear-caches', name: 'app_clear_caches', methods: ['GET'])]
    public function clearCaches(ParcCacheService $parcCacheService, EntityManagerInterface $em): RedirectResponse
    {
        // Vider le cache des parcs (Redis)
        $parcCacheService->refreshCache();

        // Optionnel : vider les caches Doctrine de 2e niveau si nécessaire
        $em->getConfiguration()->getResultCache()?->clear();

        $this->addFlash('success', 'Tous les caches ont été vidés.');

        // Revenir sur la page d'accueil
        return $this->redirectToRoute('app_home');
    }
}
