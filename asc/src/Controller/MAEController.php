<?php

namespace App\Controller;

use App\Entity\Parc;
use App\Form\MAECordeType;
use App\Model\MAECordeModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/mae')]
final class MAEController extends AbstractController
{
    #[Route('/corde/{parc}', name: 'app_m_a_e_corde')]
    public function index(Parc $parc): Response
    {
        $model = new MAECordeModel();

        $form = $this->createForm(MAECordeType::class, $model, [
            'parc' => $parc,
        ]);
        return $this->render('mae/index.html.twig', [
            'parc' => $parc,
        ]);
    }
}
