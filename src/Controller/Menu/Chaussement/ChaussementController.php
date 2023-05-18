<?php

namespace App\Controller\Menu\Chaussement;

use App\Entity\StocksArticlesSn;
use App\Repository\EmplacementRepository;
use App\Repository\LanterneRepository;
use App\Repository\MagasinsRepository;
use App\Repository\ProcessusRepository;
use App\Repository\StocksArticlesRepository;
use App\Repository\StocksArticlesSnRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ChaussementController  extends AbstractController
{
    public function chassee(
        Request $request,
MagasinsRepository $magasinsRepository,
ProcessusRepository $processusRepository,
LanterneRepository $lanterneRepository,
StocksArticlesRepository$stocksArticlesRepository,
EmplacementRepository $emplacementRepository
    )
    {
        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
            $em = $this->getDoctrine()->getManager();

            if ($request->get('idparc') == null) {
                $parcs = null;
                $processus = null;
                $stock = null;
                $lanternes = null;
                $articles = null;
            } else {
                $parcs = $magasinsRepository->findOneByIdMagasin($request->get('idparc'));
                $processus = $processusRepository->findAll();
                $lanternes = $lanterneRepository->findByParc($parcs);
                $articles = $stocksArticlesRepository->findByIdStock($parcs->getIdStock());
            }
            if ($request->isMethod('POST')) {
                foreach ($request->request->get('place') as $emplacement) {
                    $place =$emplacementRepository->find($emplacement);
                    if ($place->getStockscorde()) {
                        $contenu = $place->getStockscorde();
                    } elseif ($place->getStockslanterne()) {
                        $contenu = $place->getStockslanterne();
                    } elseif ($place->getStockspoches()) {
                        $contenu = $place->getStockspoches();
                    }
                    $contenu->setDateChaussement(new \DateTime($request->request->get('dateChaussement')));
                    $contenu->setChaussement(true);
                    $em->merge($contenu);
                }
                $em->flush();
                return $this->redirectToRoute('app_chaussement');
            }
            return $this->render(
                'Chaussement/Chaussement.html.twig',
                array(
                    'entity' => $parcs,
                    'articles' => $articles,
                    'lanternes' => $lanternes,
                    'processus' => $processus
                )
            );
        } else {
            return $this->redirectToRoute('app_statistique');
        }
    }
}