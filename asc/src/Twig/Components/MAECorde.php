<?php

namespace App\Twig\Components;

use App\Entity\Corde;
use App\Entity\Parc;
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
    public ?int $disponibiliter = null;


    #[LiveProp(writable: true)]
    public ?Corde $corde = null;
    protected function instantiateForm(): FormInterface
    {
        $model = new MAECordeModel();
        return $this->createForm(MAECordeType::class, $model, [
            'parc' => $this->parc
        ]);
    }
}
