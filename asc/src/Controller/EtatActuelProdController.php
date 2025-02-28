<?php

namespace App\Controller;

use App\Entity\Parc;
use App\Repository\ParcRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EtatActuelProdController extends AbstractController
{
    #[Route('/etatActuelProd/{parc}', name: 'app_etat_actuel_prod')]
    public function etatActuelProd(Parc $parc, ParcRepository $parcRepository): Response
    {
        $parcs = $parcRepository->findAll();
        return $this->render('etat_actuel_prod/etatActuelProd.html.twig', [
            'controller_name' => 'EtatActuelProdController',
            'parcs' => $parcs,
            'parc' => $parc,
        ]);
    }
}
