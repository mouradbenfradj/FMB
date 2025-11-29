<?php

namespace App\Twig\Components;

use App\Entity\Parc;
use App\Entity\Stock;
use App\Entity\Lanterne;
use App\Entity\FruitDeMer;
use App\Entity\StockArticle;
use App\Entity\StockLanterne;
use App\Entity\StockArticleSn;
use App\Form\PreparationLanterneType;
use App\Model\PreparationLanterneModel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsLiveComponent]
final class PreparationLanterne extends AbstractController
{
    use ComponentWithFormTrait;
    use DefaultActionTrait;

    public function __construct(private EntityManagerInterface $entityManager) {}


    #[LiveProp()]
    public ?Parc $parc = null;

    #[LiveProp(writable: true)]
    public ?Stock $stock = null;

    #[LiveProp(writable: true)]
    public ?Lanterne $lanterne = null;

    #[LiveProp(writable: true)]
    public ?int $nbrEnStock = null;

    #[LiveProp(writable: true)]
    public ?int $totalqte = null;

    #[LiveProp(writable: true)]
    public ?StockArticleSn $lot = null;

    #[LiveProp(writable: true)]
    public ?FruitDeMer $fruitDeMer = null;

    #[LiveProp(writable: true)]
    public ?StockArticle $article = null;

    protected function instantiateForm(): FormInterface
    {
        $model = new PreparationLanterneModel();
        return $this->createForm(PreparationLanterneType::class, $model, [
            'parc' => $this->parc
        ]);
    }

    #[LiveAction]
    public function save(): RedirectResponse
    {
        $this->submitForm();

        /** @var PreparationLanterneModel $model */
        $model = $this->getForm()->getData();

        if ($this->getForm()->isSubmitted() && $this->getForm()->isValid()) {
            for ($i = 0; $i < $model->getNombre(); $i++) {
                $stockLanterne = new StockLanterne();
                $stockLanterne->setLanterne($model->getLanterne());
                $stockLanterne->setStockArticleSn($model->getLot());
                $stockLanterne->setDatedecreation($model->getDatedecreation());
                $this->entityManager->persist($stockLanterne);
                $model->getLanterne()->setNbrEnStock($model->getLanterne()->getNbrEnStock() - $model->getNombre());
                $this->entityManager->persist($model->getLanterne());
            }
            $this->addFlash('success', 'Your changes were saved!');
            $this->entityManager->flush();

            return $this->redirectToRoute('app_preparation_lanterne', ['parc' => $this->parc->getId()]);
        }

        return $this->redirectToRoute('app_preparation_lanterne', ['parc' => $this->parc->getId()]);
    }
}
