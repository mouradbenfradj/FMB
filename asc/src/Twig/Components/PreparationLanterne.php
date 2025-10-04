<?php

namespace App\Twig\Components;

use App\Entity\FruitDeMer;
use App\Entity\Lanterne;
use App\Entity\Parc;
use App\Entity\Stock;
use App\Entity\StockArticle;
use App\Entity\StockArticleSn;
use App\Form\PreparationLanterneType;
use App\Model\PreparationLanterneModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class PreparationLanterne extends AbstractController
{
    use ComponentWithFormTrait;
    use DefaultActionTrait;


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
}
