<?php

namespace App\Controller\Conteneur;

use App\Entity\Asc\Conteneur\Lanterne;
use App\Entity\Asc\Parc;
use App\Form\Asc\Conteneur\LanterneType;
use App\Repository\Asc\Conteneur\LanterneRepository;
use App\Service\Conteneur\LanterneService;
use App\Service\StatistiqueService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/conteneur/lanterne")
 */
class LanterneController extends AbstractController
{

    /**
     * @Route("/statistique/{conteneur}/{parc}", name="app_conteneur_lanterne_statistique", methods={"GET"})
     */
    public function statistique(Parc $parc = null, string $conteneur, StatistiqueService $statistiqueService, LanterneService $lanterneService): Response
    {
        $statistiqueService->setConteneur($lanterneService);
        $cardBoxes = [
            ['text' => 'Total<br>Lanternes', 'icon' => 'fe-layers', 'total' => $statistiqueService->total($parc)],
            ['text' => 'Lanternes<br>à l\'eau', 'icon' => 'fe-layers', 'total' => $statistiqueService->total($parc)],
            ['text' => 'Lanternes<br>vides', 'icon' => 'fe-layers', 'total' => $statistiqueService->total($parc)],
            ['text' => 'Lanternes<br>Préparées', 'icon' => 'fe-layers', 'total' => $statistiqueService->total($parc)],
            ['text' => 'Chaussettes Lanternes<br>à l\'eau', 'icon' => 'fe-layers', 'total' => $statistiqueService->total($parc)]
        ];
        return $this->render('conteneur/lanterne/statistique.html.twig', [
            'cardBoxes' => $cardBoxes,
        ]);
    }
    /**
     * @Route("/", name="app_conteneur_lanterne_index", methods={"GET"})
     */
    public function index(LanterneRepository $lanterneRepository): Response
    {
        return $this->render('conteneur/lanterne/index.html.twig', [
            'lanternes' => $lanterneRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_conteneur_lanterne_new", methods={"GET", "POST"})
     */
    public function new(Request $request, LanterneRepository $lanterneRepository): Response
    {
        $lanterne = new Lanterne();
        $form = $this->createForm(App\Controller\Conteneur\LanterneType::class, $lanterne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lanterneRepository->add($lanterne, true);

            return $this->redirectToRoute('app_conteneur_lanterne_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conteneur/lanterne/new.html.twig', [
            'lanterne' => $lanterne,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_conteneur_lanterne_show", methods={"GET"})
     */
    public function show(Lanterne $lanterne): Response
    {
        return $this->render('conteneur/lanterne/show.html.twig', [
            'lanterne' => $lanterne,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_conteneur_lanterne_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Lanterne $lanterne, LanterneRepository $lanterneRepository): Response
    {
        $form = $this->createForm(LanterneType::class, $lanterne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lanterneRepository->add($lanterne, true);

            return $this->redirectToRoute('app_conteneur_lanterne_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conteneur/lanterne/edit.html.twig', [
            'lanterne' => $lanterne,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_conteneur_lanterne_delete", methods={"POST"})
     */
    public function delete(Request $request, Lanterne $lanterne, LanterneRepository $lanterneRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $lanterne->getId(), $request->request->get('_token'))) {
            $lanterneRepository->remove($lanterne, true);
        }

        return $this->redirectToRoute('app_conteneur_lanterne_index', [], Response::HTTP_SEE_OTHER);
    }
}
