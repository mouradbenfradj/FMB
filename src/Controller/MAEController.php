<?php

namespace App\Controller;

use App\Entity\Parc;
use App\Form\MAECordeType;
use App\Model\MAECordeModel;
use App\Repository\EmplacementRepository;
use App\Repository\StockCordeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/mae')]
final class MAEController extends AbstractController
{
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


        return $this->render('mae/index.html.twig', [
            'parc' => $parc,
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
