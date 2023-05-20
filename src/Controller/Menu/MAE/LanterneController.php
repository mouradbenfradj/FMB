<?php

namespace App\Controller\Menu\MAE;

use App\Entity\Historique;
use App\Implementation\DefaultImpl;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class LanterneController  extends AbstractController
{
    public function miseAEauLanterne()
    {
        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
            $em = $this->getDoctrine()->getManager();
            $defaultmetier = new DefaultImpl($em);

            if ($request->get('idparc') == null) {
                $parcs = null;
                $stock = null;
                $processus = null;
                $lanternes = null;
            } else {
                $parcs = $em->getRepository('App\Magasins')->findOneByIdMagasin($request->get('idparc'));
                $lanternes = $em->getRepository('App/Lanterne')->findByParc($parcs);
                $processus = $em->getRepository('App\Processus')->findAll();
            }
            if ($request->isMethod('POST')) {
                $historique = new Historique();
                $historique->setOperation("MAE Lanterne");
                $historique->setUtilisateur($this->container->get('security.context')->getToken()->getUser());
                $tacheEffectuer = array();

                $lanterne = $em->getRepository('App/Lanterne')->find($request->request->get('lanternechoix'));
                $dateMiseAEau = new \DateTime($request->request->get('dateMAELanterne'));
                $article = $em->getRepository('App/Articles')->findOneByLibArticle($request->request->get('articlechoix'));
                $stockArticle = $em->getRepository('App/StocksArticles')->findOneBy(array('idStock' => $request->request->get('idstockparc'), 'refArticle' => $article));
                $lanternearticle = $em->getRepository('App\StocksLanternes')->getLanternePreparer($em->getRepository('App/StocksArticlesSn')->getSAS($stockArticle, $request->request->get('articlelotchoix')), $lanterne);
                $position = 0;
                $idStockPlaceMAEO = array();
                $idStockLanterneMAE = array();
                $processusC = $em->getRepository('App\Processus')->find($request->request->get('articlecyclechoix'));
                foreach ($request->request->get('placelanterne') as $emplacementlanterne) {
                    $place = $em->getRepository('App\Emplacement')->find($emplacementlanterne);
                    array_push($idStockPlaceMAEO, $place);
                    array_push($idStockLanterneMAE, $lanternearticle[$position]);
                    $lanternearticle[$position]->setEmplacement($place);
                    $lanternearticle[$position]->setDateDeMiseAEau($dateMiseAEau);
                    $lanternearticle[$position]->setProcessus($processusC);
                    $place->setStocksLanterne($lanternearticle[$position]);
                    $place->setDateDeRemplissage($dateMiseAEau);
                    $lanternearticle[$position]->setCycleR($processusC->getDuree()['mois']);
                    $em->flush();
                    $position++;

                }

                $tacheEffectuer =
                    array(
                        'parc' => $parcs->getLibMagasin(),
                        'nbrLanterneMAE' => $position,
                        'typeLanterne' => $lanterne->getNomLanterne(),
                        'positionDeMAE' => $idStockPlaceMAEO,
                        'lanterneLier' => $idStockLanterneMAE,
                        'dateMAE' => $dateMiseAEau,
                        'article' => $request->request->get('articlechoix'),
                        'lot' => $request->request->get('articlelotchoix'),
                        'cycle' => $processusC
                    );
                $historique->setTacheEffectuer($tacheEffectuer);
                $em->persist($historique);
                $em->flush();
                return $this->redirectToRoute('app_misaaeaulanterne');
            }
            return $this->render('MAE/Lanterne/miseAEauLanterne.html.twig', array('entity' => $parcs, 'lanternes' => $lanternes, 'processus' => $processus));
        } else {
            return $this->redirectToRoute('app_statistique');
        }
    }

}