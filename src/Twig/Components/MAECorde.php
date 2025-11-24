<?php

namespace App\Twig\Components;

use App\Entity\Corde;
use App\Entity\FruitDeMer;
use App\Entity\Parc;
use App\Entity\Phase;
use App\Entity\Processus;
use App\Entity\Stock;
use App\Entity\StockArticle;
use App\Entity\StockArticleSn;
use App\Form\MAECordeType;
use App\Model\MAECordeModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class MAECorde extends AbstractController
{
    use ComponentWithFormTrait;
    use DefaultActionTrait;

    #[LiveProp()]
    public ?Parc $parc = null;

    #[LiveProp(writable: true)]
    public ?Stock $stock = null;

    #[LiveProp(writable: true)]
    public ?int $disponibiliter = null;

    #[LiveProp(writable: true)]
    public ?Corde $corde = null;

    #[LiveProp()]
    public ?FruitDeMer $fruitDeMer = null;

    #[LiveProp(writable: true)]
    public ?StockArticle $article = null;

    #[LiveProp(writable: true)]
    public ?StockArticleSn $lot = null;

    #[LiveProp(writable: true)]
    public ?Phase $phase = null;

    #[LiveProp(writable: true)]
    public ?Processus $processus = null;

    protected function instantiateForm(): FormInterface
    {
        $model = new MAECordeModel();
        return $this->createForm(MAECordeType::class, $model, [
            'parc' => $this->parc
        ]);
    }

    /**
     * Get the value of processus
     */
    public function getProcessus()
    {
        return $this->processus;
    }

    /**
     * Set the value of processus
     *
     * @return  self
     */
    public function setProcessus($processus)
    {
        $this->processus = $processus;

        return $this;
    }
}
