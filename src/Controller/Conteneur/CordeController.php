<?php

namespace App\Controller\Conteneur;

use App\Entity\Asc\Conteneur\Corde;
use App\Form\Asc\Conteneur\CordeType;
use App\Repository\Asc\Conteneur\CordeRepository;
use App\Service\Conteneur\CordeService;
use App\Service\StatistiqueService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/conteneur/corde")
 */
class CordeController extends AbstractController
{


    /**
     * @Route("/statistique/{parcId}/{conteneur}", name="app_conteneur_corde_statistique", methods={"GET"})
     */
    public function statistique(int $parcId = 0, string $conteneur, StatistiqueService $statistiqueService, CordeService $cordeService): Response
    {
        $statistiqueService->setConteneur($cordeService);
        $cardBoxes = [
            ['text' => 'Total<br>' . $conteneur . 's', 'icon' => 'fe-more-vertical', 'total' => $statistiqueService->total($parcId)],
            ['text' => 'Total ' . $conteneur . 's<br>à l\'eau', 'icon' => 'fe-more-vertical', 'total' => $statistiqueService->aEau($parcId)],
            ['text' => $conteneur . 's Huîtres<br>à l\'eau', 'icon' => 'fe-more-vertical', 'total' => $statistiqueService->total($parcId)],
            ['text' => $conteneur . 's Moules<br>à l\'eau', 'icon' => 'fe-more-vertical', 'total' => $statistiqueService->total($parcId)],
            ['text' => $conteneur . 's<br>vides', 'icon' => 'fe-more-vertical', 'total' => $statistiqueService->total($parcId)],
            ['text' => $conteneur . 's<br>Préparées', 'icon' => 'fe-more-vertical', 'total' => $statistiqueService->total($parcId)],
            ['text' => $conteneur . 's Huîtres<br>Préparées', 'icon' => 'fe-more-vertical', 'total' => $statistiqueService->total($parcId)],
            ['text' => $conteneur . 's Moules<br>Préparées', 'icon' => 'fe-more-vertical', 'total' => $statistiqueService->total($parcId)],
            ['text' => $conteneur . 's Assemblées<br>Préparées', 'icon' => 'fe-more-vertical', 'total' => $statistiqueService->total($parcId)],
            ['text' => $conteneur . 's Assemblées<br>à l\'eau', 'icon' => 'fe-more-vertical', 'total' => $statistiqueService->total($parcId)],
            ['text' => 'Chaussettes<br>' . $conteneur . 's à l\'eau', 'icon' => 'fe-more-vertical', 'total' => $statistiqueService->total($parcId)]
        ];
        return $this->render('conteneur/corde/statistique.html.twig', [
            'cardBoxes' => $cardBoxes,
        ]);
    }
    /**
     * @Route("/", name="app_conteneur_corde_index", methods={"GET"})
     */
    public function index(CordeRepository $cordeRepository): Response
    {
        return $this->render('conteneur/corde/index.html.twig', [
            'cordes' => $cordeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_conteneur_corde_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CordeRepository $cordeRepository): Response
    {
        $corde = new Corde();
        $form = $this->createForm(CordeType::class, $corde);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cordeRepository->add($corde, true);

            return $this->redirectToRoute('app_conteneur_corde_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conteneur/corde/new.html.twig', [
            'corde' => $corde,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_conteneur_corde_show", methods={"GET"})
     */
    public function show(Corde $corde): Response
    {
        return $this->render('conteneur/corde/show.html.twig', [
            'corde' => $corde,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_conteneur_corde_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Corde $corde, CordeRepository $cordeRepository): Response
    {
        $form = $this->createForm(CordeType::class, $corde);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cordeRepository->add($corde, true);

            return $this->redirectToRoute('app_conteneur_corde_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conteneur/corde/edit.html.twig', [
            'corde' => $corde,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_conteneur_corde_delete", methods={"POST"})
     */
    public function delete(Request $request, Corde $corde, CordeRepository $cordeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $corde->getId(), $request->request->get('_token'))) {
            $cordeRepository->remove($corde, true);
        }

        return $this->redirectToRoute('app_conteneur_corde_index', [], Response::HTTP_SEE_OTHER);
    }
}