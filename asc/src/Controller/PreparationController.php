<?php

namespace App\Controller;

use App\Entity\FruitDeMer;
use App\Entity\Parc;
use App\Entity\StockCorde;
use App\Entity\StockLanterne;
use App\Form\PreparationCordeType;
use App\Form\PreparationLanterneType;
use App\Model\PreparationCordeModel;
use App\Model\PreparationLanterneModel;
use App\Repository\FruitDeMerRepository;
use App\Repository\ParcRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PreparationController extends AbstractController
{
    #[Route('/preparationCorde/{parc}', name: 'app_preparation_corde')]
    public function preparationCorde(Request $request, Parc $parc, ParcRepository $parcRepository, EntityManagerInterface $entityManager): Response
    {
        $parcs = $parcRepository->findAll();
        $model = new PreparationCordeModel();

        $form = $this->createForm(PreparationCordeType::class, $model, [
            'parc' => $parc,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            for ($i = 0; $i < $model->getNombre(); $i++) {
                $stockCorde = new StockCorde();
                $stockCorde->setCorde($model->getCorde());
                $stockCorde->setStockArticleSn($model->getLot());
                $stockCorde->setLongeur($model->getLongeur());
                $stockCorde->setDatedecreation($model->getDatedecreation());
                $stockCorde->setLongeur($model->getLongeur());
                $stockCorde->setQuantiter($model->getDensite());
                $entityManager->persist($stockCorde);
                $model->getCorde()->setQuantiter($model->getCorde()->getQuantiter() - $model->getNombre());
                $entityManager->persist($model->getCorde());
            }
            $this->addFlash(
                'success',
                'Your changes were saved!'
            );
            $entityManager->flush();
        }


        return $this->render('preparation/preparationCorde.html.twig', [
            'parcs' => $parcs,
            'parc' => $parc,
        ]);
    }

    #[Route('/preparationLanterne/{parc}', name: 'app_preparation_lanterne')]
    public function preparationLanterne(Request $request, Parc $parc, ParcRepository $parcRepository, EntityManagerInterface $entityManager): Response
    {
        $parcs = $parcRepository->findAll();
        $model = new PreparationLanterneModel();

        $form = $this->createForm(PreparationLanterneType::class, $model, [
            'parc' => $parc,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            for ($i = 0; $i < $model->getNombre(); $i++) {
                $stockLanterne = new StockLanterne();
                $stockLanterne->setLanterne($model->getLanterne());
                $stockLanterne->setStockArticleSn($model->getLot());
                $stockLanterne->setDatedecreation($model->getDatedecreation());
                //$stockLanterne->setQuantiter($model->getDensite());
                $entityManager->persist($stockLanterne);
                //$model->getLanterne()->setQuantiter($model->getLanterne()->getQuantiter() - $model->getNombre());
                $model->getLanterne()->setNbrEnStock($model->getLanterne()->getNbrEnStock() - $model->getNombre());
                $entityManager->persist($model->getLanterne());
            }
            $this->addFlash(
                'success',
                'Your changes were saved!'
            );
            $entityManager->flush();
        }


        return $this->render('preparation/preparationLanterne.html.twig', [
            'parcs' => $parcs,
            'parc' => $parc,
        ]);
    }

    #[Route('/preparationPoche/{parc}', name: 'app_preparation_poche')]
    public function preparationPoche(Request $request, Parc $parc, ParcRepository $parcRepository, EntityManagerInterface $entityManager): Response
    {
        $parcs = $parcRepository->findAll();

        return $this->render('preparation/preparationPoche.html.twig', [
            'parcs' => $parcs,
            'parc' => $parc,
        ]);
    }
}
