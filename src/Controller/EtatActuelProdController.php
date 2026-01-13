<?php

namespace App\Controller;

use App\Entity\Parc;
use Twig\Environment;
use App\Repository\ParcRepository;
use App\Service\Cache\ParcCacheService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\EtatActuelProd\EtatActuelProdService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class EtatActuelProdController extends AbstractController
{
    public function __construct(
        private Environment $twig
    ) {}

    #[Route('/etatActuelProd/{parc}', name: 'app_etat_actuel_prod', requirements: ['parc' => '[1-9]\d*'])]
    public function etatActuelProd(
        int $parc,
        ParcCacheService $parcCache,
        EtatActuelProdService $etatActuelProdService,
        Request $request,
    ): Response {
        // Rediriger vers la page d'accueil si parc est 0 ou invalide
        if ($parc <= 0) {
            return $this->redirectToRoute('app_home');
        }

        // Récupérer tous les parcs depuis le cache Redis
        $parcs = $parcCache->getAllParcsWithRelations();

        // Récupérer le parc spécifique depuis le cache Redis
        $selectedParc = $parcCache->getParcFromCache($parc, $parcs);
        if (!$selectedParc) {
            return $this->redirectToRoute('app_home');
        }

        // Stocker l'abréviation en session
        /* $id = $selectedParc->getId();
        $abrev = $selectedParc->getAbrevParc();
        $request->getSession()->set('selected_parc_id', $id);
        $request->getSession()->set('current_parc_abrev', $abrev);
 */
        // Mettre à jour les variables globales Twig avec l'entité complète
        /*         $this->twig->addGlobal('parcs', $parcs); // Mettre à jour la liste des parcs
        $this->twig->addGlobal('parc', $selectedParc); // Mettre à jour le parc sélectionné
        $this->twig->addGlobal('isAllParcs', $parc === 0);
 */
        // Rendre la vue avec les données des filières
        $filieresData = [];
        foreach ($selectedParc->getFilieres() as $filiere) {
            $stats = $etatActuelProdService->getFiliereArrayStat($filiere);
            $segments = [];
            foreach ($filiere->getSegments() as $segment) {
                $segStats = $etatActuelProdService->getSegmentArrayStat($segment);
                $segments[] = [
                    'nomSegment' => $segment->getNomSegment(),
                    'remplissage' => $segStats[1],
                    'flottabiliter' => $segStats[2],
                    'taille' => $segStats[3],
                    'totalEmplacement' => $segStats[4],
                    'emplacementVide' => $segStats[5],
                    'emplacementRemplit' => $segStats[6],
                    'totalCorde' => $segStats[7],
                    'totalCordeHuitre' => $segStats[8],
                    'totalCordeMoule' => $segStats[9],
                    'totalCordeLanterne' => $segStats[10],
                    'totalCordePoche' => $segStats[11],
                    'dateDeMAE' => $segStats[12] ? $segStats[12]->format('Y-m-d') : null,
                    'passageChaussette' => $segStats[13],
                    'poidCordes' => $segStats[14],
                    'volumesTotale' => $segStats[15],
                    'emplacementHtml' => $this->renderView('emplacement/etat_actuel_prod.html.twig', ['segment' => $segment]),
                ];
            }
            $filieresData[] = [
                'id' => $filiere->getId(),
                'nomFiliere' => $filiere->getNomFiliere(),
                'ref' => $stats[0],
                'remplissage' => $stats[1],
                'flottabiliter' => $stats[2],
                'taille' => $stats[3],
                'totalEmplacement' => $stats[4],
                'emplacementVide' => $stats[5],
                'emplacementRemplit' => $stats[6],
                'totalCorde' => $stats[7],
                'totalCordeHuitre' => $stats[8],
                'totalCordeMoule' => $stats[9],
                'totalCordeLanterne' => $stats[10],
                'totalCordePoche' => $stats[11],
                'dateDeMAE' => $stats[12] ? $stats[12]->format('Y-m-d') : null,
                'passageChaussette' => $stats[13],
                'poidCordes' => $stats[14],
                'volumesTotale' => $stats[15],
                'segments' => $segments,
            ];
        }

        return $this->render('etat_actuel_prod/etatActuelProd.html.twig', [
            'filieresJson' => json_encode($filieresData),
        ]);
    }

    #[Route('/etatActuelProd/{parc}/data', name: 'app_etat_actuel_prod_data', requirements: ['parc' => '[1-9]\d*'])]
    public function getEtatActuelProdData(
        int $parc,
        ParcCacheService $parcCache,
        EtatActuelProdService $etatActuelProdService,
    ): Response {
        // Rediriger vers la page d'accueil si parc est 0 ou invalide
        if ($parc <= 0) {
            return $this->json(['error' => 'Invalid parc'], 400);
        }

        // Récupérer tous les parcs depuis le cache Redis
        $parcs = $parcCache->getAllParcsWithRelations();

        // Récupérer le parc spécifique depuis le cache Redis
        $selectedParc = $parcCache->getParcFromCache($parc, $parcs);
        if (!$selectedParc) {
            return $this->json(['error' => 'Parc not found'], 404);
        }

        $filieresData = [];
        foreach ($selectedParc->getFilieres() as $filiere) {
            $stats = $etatActuelProdService->getFiliereArrayStat($filiere);
            $filieresData[] = [
                'id' => $filiere->getId(),
                'nomFiliere' => $filiere->getNomFiliere(),
                'ref' => $stats[0],
                'remplissage' => $stats[1],
                'flottabiliter' => $stats[2],
                'taille' => $stats[3],
                'totalEmplacement' => $stats[4],
                'emplacementVide' => $stats[5],
                'emplacementRemplit' => $stats[6],
                'totalCorde' => $stats[7],
                'totalCordeHuitre' => $stats[8],
                'totalCordeMoule' => $stats[9],
                'totalCordeLanterne' => $stats[10],
                'totalCordePoche' => $stats[11],
                'dateDeMAE' => $stats[12] ? $stats[12]->format('Y-m-d') : null,
                'passageChaussette' => $stats[13],
                'poidCordes' => $stats[14],
                'volumesTotale' => $stats[15],
                // Add segments if needed
            ];
        }

        return $this->json($filieresData);
    }
}
