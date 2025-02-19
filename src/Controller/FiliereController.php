<?php

namespace App\Controller;

use App\Entity\Asc\FiliereComposite\Filiere;
use App\Entity\Asc\Parc;
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
     * @Route("/statistique/{parc}", name="app_filiere_statistique", methods={"GET"})
     */
    public function statistique(Parc $parc = null, StatistiqueService $statistiqueService, FiliereService $filiereService): Response
    {
        $statistiqueService->setConteneur($filiereService);
        $cardBoxes = [
            ['text' => 'Total Filières', 'icon' => 'fe-sliders', 'total' => $statistiqueService->total($parc)]
        ];
        return $this->render('filiere/statistique.html.twig', [
            'cardBoxes' => $cardBoxes,
        ]);
    }

    /**
     * @Route("/{parc}", name="app_filiere", methods={"GET","HEAD"})
     */
    public function etatActuelProd(Parc $parc = null): Response
    {
        $filieres = $parc->getFilieres()->toArray();
        usort($filieres, function (Filiere $a, Filiere $b) {
            if ($a->isAireDeTravaille() === $b->isAireDeTravaille()) {
                return strcmp($a->getNomFiliere(), $b->getNomFiliere());
            }
            return $a->isAireDeTravaille() ? -1 : 1;
        });

        return $this->render('filiere/etatActuelProd.html.twig', [
            'parc' => $parc,
            'filieres' => $filieres,
        ]);
    }

    /**
     * @Route("/ajax/{parc}", name="app_filiere_ajax", methods={"GET","HEAD"})
     */
    public function etatActuelProdAjax(Parc $parc = null, FiliereRepository $filiereRepository): Response
    {
        $filieres = $parc->getFilieres()->toArray();
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
