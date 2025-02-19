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
     * @Route("/preparation/{parc}", name="app_preparation", methods={"GET","HEAD"})
     */
    public function preparationtion(Parc $parc = null): Response
    {
        return $this->render('prod_a_faire/preparation.html.twig', [
            'parc' => $parc,
            'controller_name' => 'ProdAFaireController',
        ]);
    }

    /**
     * @Route("/preparation/corde/{parc}", name="app_preparation_corde", methods={"GET","POST"})
     */
    public function preparationtionCorde(Request $request, Parc $parc, FruitDeMerRepository $fruitDeMerRepository): Response
    {
        $fruitDeMers =  $fruitDeMerRepository->findAll();

        $id = $parc->getId();
        $corde = $parc->getCordes()->first();
        $stock = $parc->getStocks()->first();
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
        $form = $this->createForm(PreparationCordeType::class,  $preparationCorde, ['parc' => $parc, 'fruitDeMer' => $fruitDeMers]);
        $form->handleRequest($request);
        /* if ($request->isMethod('POST')  && $request->isXmlHttpRequest()) {
            $preparationCorde = $request->request->get('preparation_corde');
            dump($preparationCorde);
            $preparationCorde["datedecreation"]  = new DateTime($preparationCorde["datedecreation"]);
            $form = $this->createForm(PreparationCordeType::class, $preparationCorde, ['parc' => $parc]);
            return $this->render('prod_a_faire/preparation_corde.html.twig', [
                'parc' => $id,
                'form' => $form->createView(),
            ]);
        } */



        if ($request->isMethod('POST')) {
            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
                $form = $this->createForm(PreparationCordeType::class, $data, ['parc' => $parc]);
                return $this->render('prod_a_faire/preparation_corde.html.twig', [
                    'parc' => $id,
                    'form' => $form->createView(),
                ]);
            }
        }
        if ($request->isMethod('POST')) {
            if ($form->isSubmitted()) {
                $preparationCorde = $form->getData();
                $form = $this->createForm(PreparationCordeType::class, $preparationCorde, ['parc' => $parc]);
                return $this->render('prod_a_faire/preparation_corde.html.twig', [
                    'parc' => $id,
                    'form' => $form->createView(),
                ]);
            }
        }

        return $this->render('prod_a_faire/preparation_corde.html.twig', [
            'parc' => $id,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/preparation/lanterne/{parc}", name="app_preparation_lanterne", methods={"GET","HEAD"})
     */
    public function preparationtionLanterne(Parc $parc = null): Response
    {
        return $this->render('prod_a_faire/preparation_lanterne.html.twig', [
            'parc' => $parc,
            'controller_name' => 'ProdAFaireController',
        ]);
    }

    /**
     * @Route("/preparation/poche/{parc}", name="app_preparation_poche", methods={"GET","HEAD"})
     */
    public function preparationtionPoche(Parc $parc = null): Response
    {
        return $this->render('prod_a_faire/preparation_poche.html.twig', [
            'parc' => $parc,
            'controller_name' => 'ProdAFaireController',
        ]);
    }
    /**
     * @Route("/assemblage/{parc}", name="app_assemblage", methods={"GET","HEAD"})
     */
    public function assemblage(Parc $parc = null): Response
    {
        return $this->render('prod_a_faire/assemblage.html.twig', [
            'parc' => $parc,
            'controller_name' => 'ProdAFaireController',
        ]);
    }
    /**
     * @Route("/mise_a_eau/{parc}", name="app_mise_a_eau", methods={"GET","HEAD"})
     */
    public function miseAEau(Parc $parc = null): Response
    {
        return $this->render('prod_a_faire/index.html.twig', [
            'parc' => $parc,
            'controller_name' => 'ProdAFaireController',
        ]);
    }
    /**
     * @Route("/retrait/{parc}", name="app_retrait", methods={"GET","HEAD"})
     */
    public function retrait(Parc $parc = null): Response
    {
        return $this->render('prod_a_faire/index.html.twig', [
            'parc' => $parc,
            'controller_name' => 'ProdAFaireController',
        ]);
    }
    /**
     * @Route("/chaussement/{parc}", name="app_chaussement", methods={"GET","HEAD"})
     */
    public function chaussement(Parc $parc = null): Response
    {
        return $this->render('prod_a_faire/index.html.twig', [
            'parc' => $parc,
            'controller_name' => 'ProdAFaireController',
        ]);
    }
    /**
     * @Route("/commerciale/{parc}", name="app_commerciale", methods={"GET","HEAD"})
     */
    public function commerciale(Parc $parc = null): Response
    {
        return $this->render('prod_a_faire/index.html.twig', [
            'parc' => $parc,
            'controller_name' => 'ProdAFaireController',
        ]);
    }
}
