<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProdParCycleController extends AbstractController
{
    /**
     * @Route("/prod/par/cycle", name="app_prod_par_cycle")
     */
    public function index(): Response
    {
        return $this->render('prod_par_cycle/index.html.twig', [
            'controller_name' => 'ProdParCycleController',
        ]);
    }
}
