<?php

namespace App\Controller;

use App\Entity\Parc;
use App\Entity\StockLanterne;
use App\Service\ParcCacheService;
use App\Form\PreparationLanterneType;
use App\Model\PreparationLanterneModel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PreparationController extends AbstractController
{
    #[Route('/preparationCorde/{parc}', name: 'app_preparation_corde')]
    public function preparationCorde(Request $request, int $parc, ParcCacheService $parcCacheService): Response
    {
        $parcId = $request->getSession()->get('selected_parc_id');

        if (!$parcId) {
            return $this->redirectToRoute('app_home');
        }

        $allParcs = $parcCacheService->getAllParcsWithRelations();
        $parc = $parcCacheService->getParcFromCache($parcId, $allParcs);

        if (!$parc) {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('preparation/preparationCorde.html.twig', [
            'parcs' => $allParcs,
            'parc' => $parc,
        ]);
    }

    #[Route('/preparationLanterne/{parc}', name: 'app_preparation_lanterne')]
    public function preparationLanterne(Request $request, int $parc, ParcCacheService $parcCacheService, EntityManagerInterface $entityManager): Response
    {
        $parcId = $request->getSession()->get('selected_parc_id');

        if (!$parcId) {
            return $this->redirectToRoute('app_home');
        }

        $allParcs = $parcCacheService->getAllParcsWithRelations();
        $parc = $parcCacheService->getParcFromCache($parcId, $allParcs);

        if (!$parc) {
            return $this->redirectToRoute('app_home');
        }
        $model = new PreparationLanterneModel();

        $form = $this->createForm(PreparationLanterneType::class, $model, [
            'parc' => $parc,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            for ($i = 0; $i < $model->getNombre(); $i++) {
                $stockLanterne = new StockLanterne();
                $stockLanterne->setLanterne($model->getLanterne());
                $stockLanterne->setStockArticleSn($model->getLot());
                $stockLanterne->setDatedecreation($model->getDatedecreation());
                //$stockLanterne->setQuantiter($model->getDensite());
                $entityManager->persist($stockLanterne);
                //$model->getLanterne()->setQuantiter($model->getLanterne()->getQuantiter() - $model->getNombre());
                $model->getLanterne()->setNbrEnStock($model->getLanterne()->getNbrEnStock() - $model->getNombre());
                $entityManager->persist($model->getLanterne());
            }
            $this->addFlash(
                'success',
                'Création validée !'
            );
            $entityManager->flush();
            return $this->redirectToRoute('app_home');
        }


        return $this->render('preparation/preparationLanterne.html.twig', [
            'parcs' => $allParcs,
            'parc' => $parc,
        ]);
    }

    #[Route('/preparationPoche/{parc}', name: 'app_preparation_poche')]
    public function preparationPoche(Request $request, int $parc, ParcCacheService $parcCacheService): Response
    {
        $parcId = $request->getSession()->get('selected_parc_id');

        if (!$parcId) {
            return $this->redirectToRoute('app_home');
        }

        $allParcs = $parcCacheService->getAllParcsWithRelations();
        $parc = $parcCacheService->getParcFromCache($parcId, $allParcs);

        if (!$parc) {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('preparation/preparationPoche.html.twig', [
            'parcs' => $allParcs,
            'parc' => $parc,
        ]);
    }
}
