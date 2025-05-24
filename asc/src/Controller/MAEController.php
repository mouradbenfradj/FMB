<?php

namespace App\Controller;

use App\Entity\Parc;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/mae')]
final class MAEController extends AbstractController
{
    #[Route('/corde/{parc}', name: 'app_m_a_e_corde')]
    public function index(Parc $parc): Response
    {
        return $this->render('mae/index.html.twig', [
            'parc' => $parc,
        ]);
    }
}
