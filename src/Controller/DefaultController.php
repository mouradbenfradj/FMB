<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/{id<\d+>}", name="app_default", methods={"GET","HEAD"}, requirements={"id"="\d+"})
     */
    public function index(int $id = 0): Response
    {
        return $this->render('default/index.html.twig', [
            'id' => $id,
        ]);
    }

    /**
     * @Route("alerte-de-travaille/{id<\d+>}", name="app_alerte_de_travaille", methods={"GET","HEAD"}, requirements={"id"="\d+"})
     */
    public function AlerteDeTravaille(int $id): Response
    {
        return $this->render('default/alerte-de-travaille.html.twig', [
            'id' => $id
        ]);
    }
}
