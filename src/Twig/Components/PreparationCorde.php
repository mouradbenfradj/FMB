<?php

namespace App\Twig\Components;

use App\Entity\Parc;
use App\Entity\Corde;
use App\Entity\Stock;
use App\Entity\FruitDeMer;
use App\Entity\StockCorde;
use App\Entity\StockArticle;
use App\Entity\StockArticleSn;
use App\Form\PreparationCordeType;
use App\Model\PreparationCordeModel;
use App\Service\Materiel\CordeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Service\TravailleAFaire\TravailleAFaireService;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsLiveComponent]
final class PreparationCorde extends AbstractController
{
    use ComponentWithFormTrait;
    use DefaultActionTrait;
    private TravailleAFaireService $travailleAFaireService;
    private CordeService $cordeService;

    public function __construct(
        private EntityManagerInterface $entityManager,
        CordeService $cordeService,
        TravailleAFaireService $travailleAFaireService

    ) {
        $this->cordeService = $cordeService;
        $this->travailleAFaireService = $travailleAFaireService;
    }

    #[LiveProp()]
    public ?Parc $parc = null;

    #[LiveProp(writable: true)]
    public ?Stock $stock = null;

    #[LiveProp(writable: true)]
    public ?Corde $corde = null;

    #[LiveProp(writable: true)]
    public ?int $quantiteEnStock = null;

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
        $model = new PreparationCordeModel();
        return $this->createForm(PreparationCordeType::class, $model, [
            'parc' => $this->parc
        ]);
    }

    #[LiveAction]
    public function save(): RedirectResponse
    {
        $this->submitForm();

        /** @var PreparationCordeModel $model */
        $model = $this->getForm()->getData();

        if ($this->getForm()->isSubmitted() && $this->getForm()->isValid()) {

            $this->travailleAFaireService->executePreparation($this->cordeService, $model);

            $this->addFlash('success', 'Your changes were saved!');
            $this->entityManager->flush();

            return $this->redirectToRoute('app_preparation_corde', ['parc' => $this->parc->getId()]);
        }

        return $this->redirectToRoute('app_preparation_corde', ['parc' => $this->parc->getId()]);
    }
}
