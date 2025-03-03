<?php

namespace App\Controller;

use App\Entity\Parc;
use App\Repository\ParcRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    #[Route('/{parc}', name: 'app_home_parc')]
    public function index(?Parc $parc, ParcRepository $parcRepository): Response
    {
        $parcs = $parcRepository->findAll();

        return $this->render('home/index.html.twig', [
            'parcs' => $parcs,
            'parc' => $parc,
        ]);
    }
}