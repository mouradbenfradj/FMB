<?php

namespace App\Controller;

use App\Entity\Parc;
use Twig\Environment;
use App\Form\RetraitTransfertType;
use App\Model\RetraitTransfertModel;
use App\Service\Cache\ParcCacheService;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EmplacementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\EtatActuelProd\EtatActuelProdService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/retrait-transfert')]
final class RetraitTransfertController extends AbstractController
{
    public function __construct(
        private ParcCacheService $parcCache,
        private EtatActuelProdService $etatActuelProdService,
        private Environment $twig,
    ) {}

    #[Route('/{parc}', name: 'app_retrait_transfert')]
    public function index(
        Request $request,
        Parc $parc,
        EmplacementRepository $emplacementRepository,
        EntityManagerInterface $entityManager
    ): Response {
        if ($request->isMethod('POST')) {
            // Emplacements sources et destinations
            $sources = $request->request->all('source');
            $destinations = $request->request->all('destination');

            $request->getSession()->set('parc', $parc);
            $request->getSession()->set('sources', $sources);
            $request->getSession()->set('destinations', $destinations);
            return $this->redirectToRoute('app_retrait_transfert_validation');
        }

        // Build filieresData like EtatActuelProdController
        $parcs = $this->parcCache->getAllParcsWithRelations();
        $selectedParc = $this->parcCache->getParcFromCache($parc->getId(), $parcs);
        if (!$selectedParc) {
            return $this->redirectToRoute('app_home');
        }

        // Set session and twig globals
        $request->getSession()->set('selected_parc_id', $parc->getId());
        $this->twig->addGlobal('parcs', $parcs);
        $this->twig->addGlobal('parc', $selectedParc);
        $this->twig->addGlobal('isAllParcs', false);

        $filieresData = [];
        foreach ($selectedParc->getFilieres() as $filiere) {
            $stats = $this->etatActuelProdService->getFiliereArrayStat($filiere);
            $segments = [];
            foreach ($filiere->getSegments() as $segment) {
                $segStats = $this->etatActuelProdService->getSegmentArrayStat($segment);
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
                    'emplacementHtml' => $this->renderView('emplacement/retrait_transfert.html.twig', ['segment' => $segment]),
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

        return $this->render('retrait_transfert/index.html.twig', [
            'filieresJson' => json_encode($filieresData),
        ]);
    }

    #[Route('/validation', name: 'app_retrait_transfert_validation')]
    public function validation(
        Request $request,
        EmplacementRepository $emplacementRepository,
        EntityManagerInterface $entityManager
    ): Response {
        // Récupérer les données de session
        $sourcesIds = $request->getSession()->get('sources');
        $destinationsIds = $request->getSession()->get('destinations');
        $parc = $request->getSession()->get('parc');

        // Set session for nav
        $request->getSession()->set('selected_parc_id', $parc->getId());
        $parcs = $this->parcCache->getAllParcsWithRelations();
        $selectedParc = $this->parcCache->getParcFromCache($parc->getId(), $parcs);
        $this->twig->addGlobal('parcs', $parcs);
        $this->twig->addGlobal('parc', $selectedParc);
        $this->twig->addGlobal('isAllParcs', false);

        // Vérifier si les données existent
        if (!$sourcesIds || !$destinationsIds) {
            $this->addFlash('error', 'Aucune donnée de formulaire trouvée.');
            return $this->redirectToRoute('app_retrait_transfert', ['parc' => $parc->getId()]);
        }

        // Récupérer les entités
        $sources = $emplacementRepository->findBy(['id' => $sourcesIds]);
        $destinations = $emplacementRepository->findBy(['id' => $destinationsIds]);

        // Préparer les données pour l'affichage
        $sourcesCount = count($sources);
        $destinationsCount = count($destinations);

        // Traitement de la confirmation
        if ($request->isMethod('POST') && $request->request->get('confirm')) {
            // Vérifier la correspondance
            if ($sourcesCount !== $destinationsCount) {
                $this->addFlash('error', 'Le nombre de sources et de destinations doit être identique.');
                return $this->redirectToRoute('app_retrait_transfert', ['parc' => $parc->getId()]);
            }

            // Transférer les matériaux
            foreach ($sources as $index => $source) {
                $destination = $destinations[$index];
                if ($source->getStockMateriel() && !$destination->getStockMateriel()) {
                    $stockMateriel = $source->getStockMateriel();
                    $destination->setStockMateriel($stockMateriel);
                    $stockMateriel->setEmplacement($destination);
                    $source->setStockMateriel(null);
                }
            }

            // Sauvegarder en base de données
            $entityManager->flush();

            // Nettoyer la session
            $request->getSession()->remove('sources');
            $request->getSession()->remove('destinations');

            $this->addFlash('success', 'Les matériaux ont été transférés avec succès.');
            return $this->redirectToRoute('app_retrait_transfert_confirmation');
        }

        return $this->render('retrait_transfert/validation.html.twig', [
            'parc' => $parc,
            'sources' => $sources,
            'destinations' => $destinations,
            'sourcesCount' => $sourcesCount,
            'destinationsCount' => $destinationsCount,
        ]);
    }

    #[Route('/confirmation', name: 'app_retrait_transfert_confirmation')]
    public function confirmation(): Response
    {
        return $this->render('retrait_transfert/confirmation.html.twig');
    }
}
