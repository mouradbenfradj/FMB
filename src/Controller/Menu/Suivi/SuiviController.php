<?php
namespace App\Controller\Menu\Suivi;

use App\Repository\MagasinsRepository;
use App\Repository\ProcessusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/suivi")
 */
class SuiviController extends AbstractController
{
 /**
     * @Route("/", name="app_suivi")
     */
        public function index(        
            Request $request,
            ProcessusRepository $processusRepository,
            MagasinsRepository $magasinsRepository
        ): Response
    {
        if ($request->get('idparc') == null) {
            $processus = null;
            $parc = null;
        }
        else
        {
            $processus = $processusRepository->findAll();
            $parc = $magasinsRepository->findOneByIdMagasin($request->get('idparc'));
        }
        return $this->render('default/suivit.html.twig', array('entity' => $parc, 'processus'=>$processus));
    }

}