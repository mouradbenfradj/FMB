<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Corde;
use App\Form\CordeType;
use App\Repository\StocksArticlesSnRepository;
use App\Repository\StocksCordesRepository;
use Symfony\Component\HttpFoundation\Response;

/**
 * Corde controller.
 *
 */
class CordeController  extends AbstractController
{
    public function cordeArticle(
        Request $request,
        StocksCordesRepository $stocksCordesRepository,
        StocksArticlesSnRepository $stocksArticlesSnRepository
        )
    {
        $request->get('id');
        
             $cordearticle = $stocksCordesRepository->getCordePreparer(
                $stocksArticlesSnRepository->findOneBy(array('refStockArticle' => $request->get('ida'), 'numeroSerie' => $request->get('lot'))), $request->get('idl')
        );
        count($cordearticle);
        $tabEnsembles = array();
        $tabtest = array();
        $i = 0;
        foreach ($cordearticle as $e) { // transformer la réponse de la requete en tableau qui remplira le select pour ensembles
            if (!in_array($e->getQuantiter(), $tabtest)) {
                $tabEnsembles[$i]['id'] = $e->getId();
                $tabEnsembles[$i]['nombre'] = count($cordearticle);
                $tabEnsembles[$i]['qte'] =$e->getQuantiter();
                $tabtest[] = $e->getQuantiter();
            }
            $i++;
        }
        $response = new Response();
        $data = json_encode($tabEnsembles); // formater le résultat de la requête en json
        $response->headers->set('Content-Type', 'miseaeaucorde/json');
        $response->setContent($data);

        return $response;
    }

    public function nombreCordeArticle(
        Request $request,
        StocksCordesRepository $stocksCordesRepository,
        StocksArticlesSnRepository $stocksArticlesSnRepository
    )
    {
        $cordearticle = $stocksCordesRepository->getCordePreparer(
            $stocksArticlesSnRepository->findOneBy(array('refStockArticle' => $request->get('ida'), 'numeroSerie' => $request->get('lot')))
            , $request->get('idl')
        );
        count($cordearticle);
        $tabEnsembles = array();
        $tabtest = array();
        $i = 0;
        $tt = 1;
        foreach ($cordearticle as $e) { // transformer la réponse de la requete en tableau qui remplira le select pour ensembles
            if ($e->getQuantiter() == $request->get('qtech')) {
                $tabEnsembles[$i]['id'] = $e->getId();
                $tabEnsembles[$i]['nombre'] = $tt;
                $tabEnsembles[$i]['qte'] = $e->getQuantiter();
                $tabtest[] = $e->getQuantiter();
                $tt++;
            }
            $i++;
        }
        $response = new Response();
        $data = json_encode($tabEnsembles); // formater le résultat de la requête en json
        $response->headers->set('Content-Type', 'miseaeaucorde/json');
        $response->setContent($data);

        return $response;
    }
}
