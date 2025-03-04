<?php

namespace App\Controller;

use App\Entity\Parc;
use App\Repository\ParcRepository;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/{parc}', name: 'app_home')]
    public function index(?Parc $parc, ParcRepository $parcRepository): Response
    {
        $parcs = $parcRepository->findAll();

        return $this->render('home/index.html.twig', [
            'parcs' => $parcs,
            'parc' => $parc,
        ]);
    }
}
