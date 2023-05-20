<?php

namespace App\Controller\Menu\MAE;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PocheController  extends AbstractController
{

    public function miseAEauPoche()
    {
        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {

            $em = $this->getDoctrine()->getManager();
            if ($request->get('idparc') == null) {
                $parcs = null;
                $stock = null;
                $processus = null;
                $poches = null;
                $articles = null;
            } else {
                $parcs = $em->getRepository('App\Magasins')->findOneByIdMagasin($request->get('idparc'));
                $processus = $em->getRepository('App\Processus')->findAll();
                $poches = $em->getRepository('App/PochesBS')->findByParc($parcs);
                $articles = $em->getRepository('App/StocksArticles')->findByIdStock($parcs->getIdStock());
            }
            if ($request->isMethod('POST')) {
                $dateMiseAEau = new \DateTime($request->request->get('dateMAEPoche'));
                $poche = $em->getRepository('App/PochesBS')->find($request->request->get('pochechoix'));
                foreach ($request->request->get('placepoche') as $emplacementpoche) {
                    $place = $em->getRepository('App\Emplacement')->find($emplacementpoche);
                    $pochearticle = $em->getRepository('App/StocksPochesBS')->getPochePreparer($em->getRepository('App/StocksArticlesSn')->getSAS($request->request->get('articlechoix'), $request->request->get('articlelotchoix')), $poche);
                    $pochearticle[0]->setEmplacement($place);
                    $pochearticle[0]->setDateDeMiseAEau($dateMiseAEau);
                    $place->setStockspoches($pochearticle[0]);
                    $place->setDateDeRemplissage($dateMiseAEau);
                    $em->flush();
                }
                return $this->redirectToRoute('app_misaaeaupoche');
            }
            return $this->render(
                'MAE/Poche/miseAEauPoche.html.twig',
                array(
                    'entity' => $parcs,
                    'articles' => $articles,
                    'poches' => $poches,
                    'processus' => $processus
                )
            );

        } else {
            return $this->redirectToRoute('app_statistique');
        }
    }
}