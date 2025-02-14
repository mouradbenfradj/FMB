<?php

namespace App\Form\Asc\EventListener;

use App\Entity\Asc\Conteneur\Corde;
use App\Entity\Asc\Parc;
use App\Repository\Asc\Conteneur\CordeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

class PreparationSubscriber implements EventSubscriberInterface
{

    private $parc;

    public function __construct(Parc $parc)
    {
        $this->parc = $parc;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetCorde',
        ];
    }

    public function preSetCorde(FormEvent $event): void
    {
        $form = $event->getForm();

        $article = $this->parc->getStocks()->first()->getStockArticles();
        $form->add('article', ChoiceType::class, [
            'choices' =>  $article->toArray(),
            'choice_label' => 'article',
            'mapped' => false,
        ]);
        $lot = $article->first()->getStockArticleSns();
        $form->add('lot', ChoiceType::class, [
            'choices' =>   $lot->toArray(),
            'choice_label' => 'numeroSerie',
            'mapped' => false,
        ]);
        $qte = $article->first()->getStockArticleSns()->first();

        $form->add('totalqte', NumberType::class, [
            'attr' => ['readonly' => true],
            'mapped' => false,
            'data' =>  $qte ?  $qte->getSnQte() : 0,

        ]);
    }
}
