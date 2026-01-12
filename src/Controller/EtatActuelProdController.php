<?php

namespace App\Controller;

use App\Entity\Parc;
use Twig\Environment;
use App\Service\Cache\ParcCacheService;
use App\Repository\ParcRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
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
        // Rendre la vue sans passer les variables car elles sont maintenant globales
        return $this->render('etat_actuel_prod/etatActuelProd.html.twig');
    }
}
