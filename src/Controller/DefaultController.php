<?php

namespace App\Controller;

use App\Repository\StocksArticlesSnRepository;
use App\Repository\StocksCordesRepository;
use App\Repository\StocksPochesBSRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_default")
     */
    public function index(): Response
    {
        $fonctionnel = true;
        if ($fonctionnel) {
            return $this->redirectToRoute('app_statistique');
        } else
            return $this->render('Default/maintenance.html.twig');
    }
   
    public function correction(StocksCordesRepository $stocksCordesRepository)
    {
        var_dump('correction');
        $tableauACorriger = $stocksCordesRepository->findBy(array('dateDeRetirement' => NULL, 'dateChaussement' => null, 'chaussement' => true));

        $tabRenvoyer = array();
        $cmp = 0;
        foreach ($tableauACorriger as $objet) {
            if ($objet->getEmplacement() != null) {

                $cmp++;
                $tabRenvoyer[$objet->getEmplacement()->getFlotteur()->getSegment()->getFiliere()->getNomFiliere()][$objet->getEmplacement()->getFlotteur()->getSegment()->getNomSegment()][$objet->getEmplacement()->getFlotteur()->getNomFlotteur()][$objet->getEmplacement()->getPlace()] = $objet;
            }

        }
        return $this->render('default:correction.html.twig', array('tab' => $tabRenvoyer));
    }

    public function quantiterEnStocksSnActuel(
        Request $request,
        StocksArticlesSnRepository $stocksArticlesSnRepository)
    {
        $stocksArticlesSn =$stocksArticlesSnRepository->getSAS($request->get('stocks'), $request->get('lot'));
        return $this->render('render:quantiterEnStocksArticlesSnRender.html.twig', array(
            'stocksArticlesSn' => $stocksArticlesSn->getSnQte()));
    }

    public function dateFinProcessusAction($dateMAE, $dateRecherche, $processus)
    {
        $dateMAE = new DateTime($dateMAE);
        $dateRecherche = new DateTime($dateRecherche);
        $suivant = true;
        $date = new DateTime($dateMAE->format("Y-m-d"));
        $date = $date->modify($processus->getDuree()['jours'] . ' day');
        $date = $date->modify($processus->getDuree()['mois'] . ' month');
        $date = $date->modify($processus->getDuree()['annee'] . ' year');
        $dateProchainProcessus = $date;
        while (!(($dateMAE <= $dateRecherche) && ($dateRecherche < $dateProchainProcessus)) && $suivant) {
            $processus = $processus->getIdProcessusSuivant();
            $dateMAE = new DateTime($dateProchainProcessus->format("Y-m-d"));
            $date = new DateTime($dateMAE->format("Y-m-d"));
            $date = $date->modify($processus->getDuree()['jours'] . ' day');
            $date = $date->modify($processus->getDuree()['mois'] . ' month');
            $date = $date->modify($processus->getDuree()['annee'] . ' year');
            $dateProchainProcessus = $date;
            if (!$processus->getIdProcessusSuivant()) {
                $suivant = false;
            }
        }
        return $this->render('Default/Render/dateFinProcessus.html.twig', array('datefin' => $dateProchainProcessus, 'suivant' => $suivant));
    }


    public function pochePreparer(Request $request,
    StocksPochesBSRepository $stocksPochesBSRepository)
    {// Get the province ID
        $id = $request->query->get('poche_id');
        $date = new DateTime($request->query->get('date'));

        $result = array();
        // Return a list of cities, based on the selected province
        $poches = $stocksPochesBSRepository->findBy(array('pochesbs' => $id, 'dateDeCreation' => $date));
        foreach ($poches as $poche) {
            $result[$poche->getQuantiter()] = $poche->getQuantiter();
        }
        return new JsonResponse($result);
    }

    public function datePochePreparer(Request $request,
    StocksPochesBSRepository $stocksPochesBSRepository)
    {// Get the province ID
        $id = $request->query->get('poche_id');

        $result = array();
        // Return a list of cities, based on the selected province
       
        $poches = $stocksPochesBSRepository->findBy(array('pochesbs' => $id, 'cordeAssemblage' => null));
        foreach ($poches as $poche) {
            $result[$poche->getDateDeCreation()->format('Y-m-d')] = $poche->getDateDeCreation()->format('Y-m-d');
        }

        return new JsonResponse($result);
    }

    public function nombrePochePreparer(
        Request $request,
    StocksPochesBSRepository $stocksPochesBSRepository
    )
    {// Get the province ID
        $id = $request->query->get('poche_id');
        $qte = $request->query->get('qte');
        $result = array();
        // Return a list of cities, based on the selected province
        $poches = $stocksPochesBSRepository->findBy(array('pochesbs' => $id, 'quantiter' => $qte, 'cordeAssemblage' => null));
        $result = count($poches);
        return new JsonResponse($result);
    }
}
