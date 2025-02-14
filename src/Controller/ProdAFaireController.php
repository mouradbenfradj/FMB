<?php

namespace App\Controller;

use App\Entity\Asc\FruitDeMer;
use App\Entity\Asc\Parc;
use App\Entity\Asc\Stock\Stock;
use App\Entity\Asc\Stock\StockArticle;
use App\Entity\Asc\Stock\StockArticleSn;
use App\Entity\Asc\Stock\StockCorde;
use App\Form\Asc\ProdAFaire\PreparationCordeType;
use App\Repository\Asc\Conteneur\CordeRepository;
use App\Repository\Asc\FruitDeMerRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/prod/a/faire")
 */
class ProdAFaireController extends AbstractController
{
    /**
     * @Route("/preparation/{parcID<\d+>}", name="app_preparation", methods={"GET","HEAD"}, requirements={"parcID"="\d+"})
     */
    public function preparationtion(int $parcID = 0): Response
    {
        return $this->render('prod_a_faire/preparation.html.twig', [
            'parcID' => $parcID,
            'controller_name' => 'ProdAFaireController',
        ]);
    }

    /**
     * @Route("/preparation/corde/{parcID<\d+>}", name="app_preparation_corde", methods={"GET","POST"}, requirements={"parcID"="\d+"})
     */
    public function preparationtionCorde(Request $request, Parc $parcID, FruitDeMerRepository $fruitDeMerRepository): Response
    {
        $fruitDeMers =  $fruitDeMerRepository->findAll();

        $id = $parcID->getId();
        $corde = $parcID->getCordes()->first();
        $stock = $parcID->getStocks()->first();
        $article =  $stock->getStockArticles()->first();
        $lot = $article->getStockArticleSns()->first();

        $preparationCorde  = [
            "corde" => $corde->getId(),
            "stocks" =>  $stock->getId(),
            "fruitDeMer" =>  $fruitDeMers[0]->getId(),
            "datedecreation" => new DateTime(),
            "article" =>  $article->getId(),
            "lot" => $lot->getId(),
            "quantiteEnStock" => $corde->getQuantiter(),
            "totalqte" => $lot->getSnQte(),
        ];
        $form = $this->createForm(PreparationCordeType::class,  $preparationCorde, ['parc' => $parcID, 'fruitDeMer' => $fruitDeMers]);
        $form->handleRequest($request);
        /* if ($request->isMethod('POST')  && $request->isXmlHttpRequest()) {
            $preparationCorde = $request->request->get('preparation_corde');
            dump($preparationCorde);
            $preparationCorde["datedecreation"]  = new DateTime($preparationCorde["datedecreation"]);
            $form = $this->createForm(PreparationCordeType::class, $preparationCorde, ['parc' => $parcID]);
            return $this->render('prod_a_faire/preparation_corde.html.twig', [
                'parcID' => $id,
                'form' => $form->createView(),
            ]);
        } */



        if ($request->isMethod('POST')) {
            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
                $form = $this->createForm(PreparationCordeType::class, $data, ['parc' => $parcID]);
                return $this->render('prod_a_faire/preparation_corde.html.twig', [
                    'parcID' => $id,
                    'form' => $form->createView(),
                ]);
            }
        }
        if ($request->isMethod('POST')) {
            if ($form->isSubmitted()) {
                $preparationCorde = $form->getData();
                $form = $this->createForm(PreparationCordeType::class, $preparationCorde, ['parc' => $parcID]);
                return $this->render('prod_a_faire/preparation_corde.html.twig', [
                    'parcID' => $id,
                    'form' => $form->createView(),
                ]);
            }
        }

        return $this->render('prod_a_faire/preparation_corde.html.twig', [
            'parcID' => $id,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/preparation/lanterne/{parcID<\d+>}", name="app_preparation_lanterne", methods={"GET","HEAD"}, requirements={"parcID"="\d+"})
     */
    public function preparationtionLanterne(int $parcID = 0): Response
    {
        return $this->render('prod_a_faire/preparation_lanterne.html.twig', [
            'parcID' => $parcID,
            'controller_name' => 'ProdAFaireController',
        ]);
    }

    /**
     * @Route("/preparation/poche/{parcID<\d+>}", name="app_preparation_poche", methods={"GET","HEAD"}, requirements={"parcID"="\d+"})
     */
    public function preparationtionPoche(int $parcID = 0): Response
    {
        return $this->render('prod_a_faire/preparation_poche.html.twig', [
            'parcID' => $parcID,
            'controller_name' => 'ProdAFaireController',
        ]);
    }
    /**
     * @Route("/assemblage/{parcID<\d+>}", name="app_assemblage", methods={"GET","HEAD"}, requirements={"parcID"="\d+"})
     */
    public function assemblage(int $parcID = 0): Response
    {
        return $this->render('prod_a_faire/assemblage.html.twig', [
            'parcID' => $parcID,
            'controller_name' => 'ProdAFaireController',
        ]);
    }
    /**
     * @Route("/mise_a_eau/{parcID<\d+>}", name="app_mise_a_eau", methods={"GET","HEAD"}, requirements={"parcID"="\d+"})
     */
    public function miseAEau(int $parcID = 0): Response
    {
        return $this->render('prod_a_faire/index.html.twig', [
            'parcID' => $parcID,
            'controller_name' => 'ProdAFaireController',
        ]);
    }
    /**
     * @Route("/retrait/{parcID<\d+>}", name="app_retrait", methods={"GET","HEAD"}, requirements={"parcID"="\d+"})
     */
    public function retrait(int $parcID = 0): Response
    {
        return $this->render('prod_a_faire/index.html.twig', [
            'parcID' => $parcID,
            'controller_name' => 'ProdAFaireController',
        ]);
    }
    /**
     * @Route("/chaussement/{parcID<\d+>}", name="app_chaussement", methods={"GET","HEAD"}, requirements={"parcID"="\d+"})
     */
    public function chaussement(int $parcID = 0): Response
    {
        return $this->render('prod_a_faire/index.html.twig', [
            'parcID' => $parcID,
            'controller_name' => 'ProdAFaireController',
        ]);
    }
    /**
     * @Route("/commerciale/{parcID<\d+>}", name="app_commerciale", methods={"GET","HEAD"}, requirements={"parcID"="\d+"})
     */
    public function commerciale(int $parcID = 0): Response
    {
        return $this->render('prod_a_faire/index.html.twig', [
            'parcID' => $parcID,
            'controller_name' => 'ProdAFaireController',
        ]);
    }
}
