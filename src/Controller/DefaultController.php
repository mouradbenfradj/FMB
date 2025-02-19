<?php

namespace App\Controller;

use App\Entity\Asc\Parc;
use App\Service\ConteneurService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/", methods={"GET","HEAD"})
     */
    public function indexNoLocale(Request $request, Parc $parc = null): Response
    {

        if ($parc) {
            dd(' parc');
        }
        return $this->redirectToRoute('app_statistique', ['_locale' => $request->getLocale(), 'parc' => $parc]);
    }

    /**
     * @Route("/statd/{_locale}/{parc}", name="app_default", methods={"GET","HEAD"})
     */
    public function index(Parc $parc = null, ConteneurService $conteneurService): Response
    {

        if ($parc) {
            dd(' parc');
        } else {
            dd('pas de parc');
        }
        return $this->render('default/index.html.twig', [
            'parc' => $parc,
            'conteneurs' => $conteneurService->getContainerList()
        ]);
    }
    /**
     * @Route("/alerte-de-travaille/{id<\d+>}", name="app_alerte_de_travaille", methods={"GET","HEAD"}, requirements={"id"="\d+"})
     */
    public function AlerteDeTravaille(int $id): Response
    {
        return $this->render('default/alerte-de-travaille.html.twig', [
            'id' => $id
        ]);
    }

    /**
     * @Route("/vue", name="vue_app")
     */
    public function vueApp(): Response
    {
        return $this->render('vue_template.html.twig');
    }
}
