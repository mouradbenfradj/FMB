<?php

namespace App\Controller;

use App\Repository\CordeRepository;
use App\Repository\StockCordeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\ParcEnchiffre\ParcEnchiffreService;
use App\Service\DesignPatterns\DesignPatternsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{

    #[Route('/{parc}', name: 'app_home', defaults: ['parc' => null])]
    public function index(Request $request, ParcEnchiffreService $parcEnchiffreService, StockCordeRepository $stockCordeRepo, CordeRepository $cordeRepository, ?int $parc = null): Response
    {
        // Récupérer le parc ID depuis la requête (session, paramètre, etc.)
        $parcId = $request->getSession()->get('selected_parc_id');

        // Calculer les statistiques pour les cordes
        $stats =  $parcEnchiffreService->getData($parcId);


        return $this->render('home/index.html.twig', [
            'stats' => $stats,
        ]);
    }

    #[Route('/designepatterne', name: 'app_dp')]
    public function dp(DesignPatternsService $designPatternsService): Response
    {

        $designPatternsService->usePatronsStructurelsService()->useProcurationService();
        dd('endteste');
        return $this->render('home/index.html.twig');
    }

    /* 
    #[Route('/test/{age}/{longeur}')]
    public function calculateMoules(int $age, int $longeur, MouleCalculator $calculator): JsonResponse
    {
        try {
            $results01 = $calculator->calculateAllColumns($age, $longeur);
            $results02 = $calculator->calculateAllColumns($age, $longeur + 1);
            $results11 = $calculator->calculateAllColumns($age + 1, $longeur);
            $results12 = $calculator->calculateAllColumns($age + 1, $longeur + 1);
            $results21 = $calculator->calculateAllColumns($age + 2, $longeur);
            $results22 = $calculator->calculateAllColumns($age + 2, $longeur + 1);
            $results31 = $calculator->calculateAllColumns($age + 3, $longeur);
            $results32 = $calculator->calculateAllColumns($age + 3, $longeur + 1);
            $results41 = $calculator->calculateAllColumns($age + 4, $longeur);
            $results42 = $calculator->calculateAllColumns($age + 4, $longeur + 1);
            $results51 = $calculator->calculateAllColumns($age + 5, $longeur);
            $results52 = $calculator->calculateAllColumns($age + 5, $longeur + 1);
            $results61 = $calculator->calculateAllColumns($age + 6, $longeur);
            $results62 = $calculator->calculateAllColumns($age + 6, $longeur + 1);
            $results71 = $calculator->calculateAllColumns($age + 7, $longeur);
            $results72 = $calculator->calculateAllColumns($age + 7, $longeur + 1);
            $results81 = $calculator->calculateAllColumns($age + 8, $longeur);
            $results82 = $calculator->calculateAllColumns($age + 8, $longeur + 1);
            $results91 = $calculator->calculateAllColumns($age + 9, $longeur);
            $results92 = $calculator->calculateAllColumns($age + 9, $longeur + 1);
            $results101 = $calculator->calculateAllColumns($age + 10, $longeur);
            $results102 = $calculator->calculateAllColumns($age + 10, $longeur + 1);


            dd($results01, $results02, $results11, $results12, $results21, $results22, $results31, $results32, $results41, $results42, $results51, $results52, $results61, $results62, $results71, $results72, $results81, $results82, $results91, $results92, $results101, $results102);
            return $this->json([
                'success' => true,
                'age' => $age,
                'results' => $results
            ]);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    } */
    /*  #[Route('/test')]
    public function calculateMoulesRange(Request $request, MouleCalculator $calculator): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);
            $startAge = $data['start'] ?? 0;
            $endAge = $data['end'] ?? 23;

            $results = [];
            for ($age = $startAge; $age <= $endAge; $age++) {
                $results[$age] = $calculator->calculateAllColumns($age);
            }
            dd([
                'success' => true,
                'range' => ['start' => $startAge, 'end' => $endAge],
                'results' => $results
            ]);
            return $this->json([
                'success' => true,
                'range' => ['start' => $startAge, 'end' => $endAge],
                'results' => $results
            ]);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    #[Route('/test2')]
    public function list2(LifeService $testService): Response
    {
        $ageEnMois = $testService->calculerAgeEnMois("2025-06-26");
        $distance = 1; // 1000 mètres (peut être ignoré ou utilisé plus tard)
        $unitesInitiales = 2500; // 1000 unités au départ
        $taux = 0.88; // Taux exact (89.0299252903103%)

        $unitesRestantes = $testService->calculerUnitesRestantesMoules($distance, $unitesInitiales, $ageEnMois, $taux);
        dump("Moules: Unités restantes après $ageEnMois mois : " . round($unitesRestantes, 2));
        $calculerRatio1000SurPoidsUnite = $testService->calculerRatio1000SurPoidsUnite($ageEnMois);
        dump($calculerRatio1000SurPoidsUnite);
        $calculerValeurDecroissante = $testService->calculerValeurDecroissante($ageEnMois);
        dd($calculerValeurDecroissante);
    } */
}
