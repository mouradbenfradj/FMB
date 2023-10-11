<?php

namespace App\Controller;

use App\Repository\Asc\FiliereComposite\FiliereRepository;
use App\Service\FiliereService;
use App\Service\StatistiqueService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/filiere")
 */
class FiliereController extends AbstractController
{


    /**
     * @Route("/statistique/{parcId}", name="app_filiere_statistique", methods={"GET"})
     */
    public function statistique(int $parcId = 0, StatistiqueService $statistiqueService, FiliereService $filiereService): Response
    {
        $statistiqueService->setConteneur($filiereService);
        $cardBoxes = [
            ['text' => 'Total Filiere', 'icon' => 'fe-sliders', 'total' => $statistiqueService->total($parcId)]
        ];
        return $this->render('filiere/statistique.html.twig', [
            'cardBoxes' => $cardBoxes,
        ]);
    }

    /**
     * @Route("/{id<\d+>}", name="app_filiere", methods={"GET","HEAD"}, requirements={"id"="\d+"})
     */
    public function etatActuelProd(int $id = 0, FiliereRepository $filiereRepository): Response
    {
        return $this->render('filiere/etatActuelProd.html.twig', [
            'id' => $id,
            'filieres' => $filiereRepository->findByParcId($id),
        ]);
    }

    /**
     * @Route("/ajax/{id<\d+>}", name="app_filiere_ajax", methods={"GET","HEAD"}, requirements={"id"="\d+"})
     */
    public function etatActuelProdAjax(int $id = 0, FiliereRepository $filiereRepository): Response
    {
        $filieres = $filiereRepository->findByParcId($id);
        $b = array_map(function ($f) {
            return [
                "Réf Filière" =>  $f->getNomFiliere(),
                "Remplissage Filière (%)" => "mourad",
                "Capacité Filière (u)" => 0,
                "Places Remplies (u)" => 0,
                "Places Vides (u)" => 0,
                "Taille Filière (m)" => 0,
                "Nombre de place totale" => 0,
                "Nombre de place vide" => 0,
                "Nombre de place remplis" => 0,
                "Nombre de place corde" => 0,
                "Nombre de place corde huitre" => 0,
                "Nombre de place corde moule" => 0,
                "Nombre de place corde lanterne" => 0,
                "Date Min MAE" => "mourad",
                "Segments" => "mourad"
            ];
        }, $filieres);
        return new JsonResponse($b);
    }
}
