<?php

namespace App\Controller;

use App\Form\PreparationCordeType;
use App\Model\PreparationCordeModel;
use App\Form\PreparationLanterneType;
use App\Service\Materiel\CordeService;
use App\Model\PreparationLanterneModel;
use App\Service\Cache\ParcCacheService;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\Materiel\LanterneService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\TravailleAFaire\TravailleAFaireService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PreparationController extends AbstractController
{
    private ParcCacheService $parcCacheService;
    private TravailleAFaireService $travailleAFaireService;
    private EntityManagerInterface $entityManager;
    private CordeService $cordeService;

    public function __construct(
        ParcCacheService $parcCacheService,
        TravailleAFaireService $travailleAFaireService,
        EntityManagerInterface $entityManager,
        CordeService $cordeService,
        LanterneService $lanterneService
    ) {
        $this->parcCacheService = $parcCacheService;
        $this->travailleAFaireService = $travailleAFaireService;
        $this->entityManager = $entityManager;
        $this->cordeService = $cordeService;
        $this->lanterneService = $lanterneService;
    }

    #[Route('/preparationCorde/{parc}', name: 'app_preparation_corde')]
    public function preparationCorde(
        Request $request,
        int $parc
    ): Response {
        $parcId = $request->getSession()->get('selected_parc_id');
        if (!$parcId)
            return $this->redirectToRoute('app_home');

        $allParcs = $this->parcCacheService->getAllParcsWithRelations();
        $parc = $this->parcCacheService->getParcFromCache($parcId, $allParcs);
        $model = new PreparationCordeModel();

        $form = $this->createForm(PreparationCordeType::class, $model, [
            'parc' => $parc,
            'action' => $this->generateUrl('app_preparation_corde', ['parc' => $parc]),
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //$this->travailleAFaireService->setStrategy($this->cordeService);
            $this->travailleAFaireService->executePreparation($this->cordeService, $model);

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );
            $this->entityManager->flush();
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

            /*             $this->travailleAFaireService->setStrategy($this->lanterneService);
 */
            $this->travailleAFaireService->executePreparation($this->cordeService, $model);
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
