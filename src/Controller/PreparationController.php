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
    private LanterneService $lanterneService;

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

    #[Route('/preparation/{type}/{parc}', name: 'app_preparation', requirements: ['type' => 'corde|lanterne'])]
    public function preparation(
        Request $request,
        string $type,
        int $parc
    ): Response {
        $request->getSession()->set('preparation_type', $type);
        $parcId = $request->getSession()->get('selected_parc_id');
        if (!$parcId)
            return $this->redirectToRoute('app_home');

        $allParcs = $this->parcCacheService->getAllParcsWithRelations();
        $parc = $this->parcCacheService->getParcFromCache($parcId, $allParcs);


        $model = null;
        $formType = null;
        if ($type === 'corde') {
            $model = new PreparationCordeModel();
            $formType = PreparationCordeType::class;
            $service = $this->cordeService;
            $template = 'preparation/preparationCorde.html.twig';
            $successMessage = 'Your changes were saved!';
        } elseif ($type === 'lanterne') {
            $model = new PreparationLanterneModel();
            $formType = PreparationLanterneType::class;
            $service = $this->lanterneService;
            $template = 'preparation/preparationLanterne.html.twig';
            $successMessage = 'Création validée !';
        } else {
            throw new \InvalidArgumentException('Invalid type');
        }

        $form = $this->createForm($formType, $model, [
            'parc' => $parc,
            'action' => $this->generateUrl('app_preparation', ['type' => $type, 'parc' => $parc]),
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->travailleAFaireService->executePreparation($service, $model);

            $this->addFlash('success', $successMessage);
            $this->entityManager->flush();
            $this->parcCacheService->refreshCache();
            return $this->redirectToRoute('app_preparation_confirmation', ['type' => $type, 'parc' => $parc->getId()]);
        }
        return $this->render($template, [
            'parcs' => $allParcs,
            'parc' => $parc,
            'type' => $type,
        ]);
    }

    #[Route('/preparation/{type}/{parc}/confirmation', name: 'app_preparation_confirmation', requirements: ['type' => 'corde|lanterne'])]
    public function confirmation(Request $request, string $type, int $parc): Response
    {
        $parcId = $request->getSession()->get('selected_parc_id');
        if (!$parcId)
            return $this->redirectToRoute('app_home');

        $allParcs = $this->parcCacheService->getAllParcsWithRelations();
        $parc = $this->parcCacheService->getParcFromCache($parcId, $allParcs);

        return $this->render('preparation/confirmation.html.twig', [
            'type' => $type,
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
