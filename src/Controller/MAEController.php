<?php

namespace App\Controller;

use App\Entity\Parc;
use Twig\Environment;
use App\Form\MAECordeType;
use App\Model\MAECordeModel;
use App\Service\Cache\ParcCacheService;
use App\Repository\StockCordeRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EmplacementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\EtatActuelProd\EtatActuelProdService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/mae')]
final class MAEController extends AbstractController
{
    public function __construct(
        private ParcCacheService $parcCache,
        private EtatActuelProdService $etatActuelProdService,
        private Environment $twig,
    ) {}

    #[Route('/corde/{parc}', name: 'app_m_a_e_corde')]
    public function index(
        Request $request,
        Parc $parc,
        EmplacementRepository $emplacementRepository,
        StockCordeRepository $stockCordeRepository,
        EntityManagerInterface $entityManager
    ): Response {
        $model = new MAECordeModel();

        $form = $this->createForm(MAECordeType::class, $model, [
            'parc' => $parc,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Emplacements cochés
            $formData = $request->request->all('mae_corde');
            $emplacements = $request->request->all('emplacement');

            $request->getSession()->set('parc', $parc);
            $request->getSession()->set('form_data', $formData);
            $request->getSession()->set('emplacements', $emplacements);
            return $this->redirectToRoute('app_m_a_e_corde_validation');
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
                    'emplacementHtml' => $this->renderView('emplacement/mae.html.twig', ['segment' => $segment]),
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

        return $this->render('mae/index.html.twig', [
            'filieresJson' => json_encode($filieresData),
            'form' => $form->createView(),
        ]);
    }

    #[Route('/corde_validation', name: 'app_m_a_e_corde_validation')]
    public function validation(
        Request $request,
        EmplacementRepository $emplacementRepository,
        StockCordeRepository $stockCordeRepository,
        EntityManagerInterface $entityManager
    ): Response {
        // Récupérer les données de session
        $formData = $request->getSession()->get('form_data');
        $emplacementsIds = $request->getSession()->get('emplacements');
        $parc = $request->getSession()->get('parc');

        // Set session for nav
        $request->getSession()->set('selected_parc_id', $parc->getId());
        $parcs = $this->parcCache->getAllParcsWithRelations();
        $selectedParc = $this->parcCache->getParcFromCache($parc->getId(), $parcs);
        $this->twig->addGlobal('parcs', $parcs);
        $this->twig->addGlobal('parc', $selectedParc);
        $this->twig->addGlobal('isAllParcs', false);

        // Vérifier si les données existent
        if (!$formData || !$emplacementsIds) {
            $this->addFlash('error', 'Aucune donnée de formulaire trouvée.');
            return $this->redirectToRoute('app_m_a_e_corde', ['parc' => $parc->getId()]);
        }

        // Récupérer les entités
        $cordes = $stockCordeRepository->findBy([
            'corde' => $formData['corde'],
            'dateDeMiseAEau' => null,
            'emplacement' => null,
            'pret' => false,
            'stockArticleSn' => $formData['lot']
        ]);

        $emplacements = $emplacementRepository->findBy(['id' => $emplacementsIds]);
        $dateDeMAE = new \DateTime($formData['datedeMAE']);

        // Préparer les données pour l'affichage
        $cordesCount = count($cordes);
        $emplacementsCount = count($emplacements);

        // Traitement de la confirmation
        if ($request->isMethod('POST') && $request->request->get('confirm')) {
            // Vérifier la correspondance entre cordes et emplacements


            // Assigner les emplacements aux cordes
            foreach ($emplacements as $index => $emplacement) {
                if (isset($cordes[$index])) {
                    $corde = $cordes[$index];
                    $corde->setEmplacement($emplacement);
                    $corde->setDateDeMiseAEau($dateDeMAE);
                    // Vous pouvez ajouter d'autres setters si nécessaire
                }
            }

            // Sauvegarder en base de données
            $entityManager->flush();

            // Nettoyer la session
            $request->getSession()->remove('form_data');
            $request->getSession()->remove('emplacements');

            $this->addFlash('success', 'Les cordes ont été assignées aux emplacements avec succès.');
            return $this->redirectToRoute('app_m_a_e_confirmation');
        }

        //dd($cordes[0]);
        return $this->render('mae/validation.html.twig', [
            'parc' => $cordes[0]->getCorde()->getParc(),
            'formData' => $formData,
            'corde' => $cordes[0],
            'cordes' => $cordes,
            'emplacements' => $emplacements,
            'cordesCount' => $cordesCount,
            'emplacementsCount' => $emplacementsCount,
            'dateDeMAE' => $dateDeMAE,
        ]);
    }
    #[Route('/confirmation', name: 'app_m_a_e_confirmation')]
    public function confirmation(): Response
    {
        return $this->render('mae/confirmation.html.twig');
    }
}
