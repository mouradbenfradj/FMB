<?php

namespace App\Controller;

use App\Entity\Parc;
use App\Form\MAECordeType;
use App\Model\MAECordeModel;
use App\Repository\EmplacementRepository;
use App\Repository\StockCordeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/mae')]
final class MAEController extends AbstractController
{
    #[Route('/corde/{parc}', name: 'app_m_a_e_corde')]
    public function index(
        Request $request,
        Parc $parc,
        EmplacementRepository $emplacementRepository,
        StockCordeRepository $stockCordeRepository,
        EntityManagerInterface $entityManager
    ): Response {
        $model = new MAECordeModel();

        $form = $this->createForm(MAECordeType::class, $model, [
            'parc' => $parc,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Emplacements cochés
            $formData = $request->request->all('mae_corde');

            $cordes = $stockCordeRepository->findBy(['corde' => $formData['corde'], 'pret' => false, 'stockArticleSn' => $formData['lot']]);

            $emplacements = $request->request->all('emplacement');
            $emplacements = $emplacementRepository->findBy(['id' => $emplacements]);
            // Debug
            $data = $form->getData();

            dump($cordes);
            dump($data);
            dump($formData);
            foreach ($emplacements as $index => $emplacement) {
                if (isset($cordes[$index])) {
                    $corde = $cordes[$index];
                    $corde->setEmplacement($emplacement);
                    $corde->setDateDeMiseAEau(new \DateTime());
                }
            }
            $entityManager->flush();

            dd($emplacements);
            /*  for ($i = 0; $i < $model->getNombre(); $i++) {
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
            $entityManager->flush(); */
        }


        return $this->render('mae/index.html.twig', [
            'parc' => $parc,
        ]);
    }
}
