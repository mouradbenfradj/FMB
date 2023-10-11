<?php

namespace App\Controller\Conteneur;

use App\Entity\Asc\Conteneur\Poche;
use App\Form\Asc\Conteneur\PocheType;
use App\Repository\Asc\Conteneur\PocheRepository;
use App\Service\Conteneur\PocheService;
use App\Service\StatistiqueService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/conteneur/poche")
 */
class PocheController extends AbstractController
{

    /**
     * @Route("/statistique/{parcId}/{conteneur}", name="app_conteneur_poche_statistique", methods={"GET"})
     */
    public function statistique(int $parcId = 0, string $conteneur, StatistiqueService $statistiqueService, PocheService $pocheService): Response
    {
        $statistiqueService->setConteneur($pocheService);
        $cardBoxes = [
            ['text' => 'Total<br>Poches', 'icon' => 'fe-shopping-bag', 'total' => $statistiqueService->total($parcId)],
            ['text' => 'Poches<br>à l\'eau', 'icon' => 'fe-shopping-bag', 'total' => $statistiqueService->total($parcId)],
            ['text' => 'Poches<br>vides', 'icon' => 'fe-shopping-bag', 'total' => $statistiqueService->total($parcId)],
            ['text' => 'Poches<br>Préparées', 'icon' => 'fe-shopping-bag', 'total' => $statistiqueService->total($parcId)],
            ['text' => 'Poches<br>Assemblées', 'icon' => 'fe-shopping-bag', 'total' => $statistiqueService->total($parcId)],
            ['text' => 'Poches Assemblées<br>à l\'eau', 'icon' => 'fe-shopping-bag', 'total' => $statistiqueService->total($parcId)],
            ['text' => 'Chaussettes Poches<br>à l\'eau', 'icon' => 'fe-shopping-bag', 'total' => $statistiqueService->total($parcId)]
        ];
        return $this->render('conteneur/poche/statistique.html.twig', [
            'cardBoxes' => $cardBoxes,
        ]);
    }
    /**
     * @Route("/", name="app_conteneur_poche_index", methods={"GET"})
     */
    public function index(PocheRepository $pocheRepository): Response
    {
        return $this->render('conteneur/poche/index.html.twig', [
            'poches' => $pocheRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_conteneur_poche_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PocheRepository $pocheRepository): Response
    {
        $poche = new Poche();
        $form = $this->createForm(PocheType::class, $poche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pocheRepository->add($poche, true);

            return $this->redirectToRoute('app_conteneur_poche_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conteneur/poche/new.html.twig', [
            'poche' => $poche,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_conteneur_poche_show", methods={"GET"})
     */
    public function show(Poche $poche): Response
    {
        return $this->render('conteneur/poche/show.html.twig', [
            'poche' => $poche,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_conteneur_poche_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Poche $poche, PocheRepository $pocheRepository): Response
    {
        $form = $this->createForm(PocheType::class, $poche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pocheRepository->add($poche, true);

            return $this->redirectToRoute('app_conteneur_poche_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conteneur/poche/edit.html.twig', [
            'poche' => $poche,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_conteneur_poche_delete", methods={"POST"})
     */
    public function delete(Request $request, Poche $poche, PocheRepository $pocheRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $poche->getId(), $request->request->get('_token'))) {
            $pocheRepository->remove($poche, true);
        }

        return $this->redirectToRoute('app_conteneur_poche_index', [], Response::HTTP_SEE_OTHER);
    }
}
