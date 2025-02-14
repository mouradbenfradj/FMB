<?php

namespace App\Form\Asc\ProdAFaire;

use App\Entity\Asc\Conteneur\Corde;
use App\Entity\Asc\FruitDeMer;
use App\Entity\Asc\Parc;
use App\Entity\Asc\Stock\Stock;
use App\Entity\Asc\Stock\StockArticle;
use App\Entity\Asc\Stock\StockArticleSn;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use function Amp\Promise\first;

class PreparationCordeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $parc = $options['parc'];
        $fruitDeMer = $options['fruitDeMer'];

        $builder
            ->add('stocks', ChoiceType::class, [
                'choice_label' => 'abrevStock',
                'multiple' => false,
                'expanded' => false,
                'choices' => $parc->getStocks(),
                'choice_value' => 'id',
            ])->add('fruitDeMer', ChoiceType::class, [
                'choices' =>   $fruitDeMer,
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => false,
                'choice_value' => 'id',
            ])->add('article', ChoiceType::class, [
                'choices' =>  [],
                'choice_label' => 'article',

                'choice_value' => 'id',
            ])->add('lot', ChoiceType::class, [
                'choices' =>  [],
                'choice_label' => 'numeroSerie',

                'choice_value' => 'id',
            ])->add('totalqte', NumberType::class, [
                'attr' => ['readonly' => true],

                'data' => 0,
            ])
            ->add('corde', ChoiceType::class,  [
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => false,
                'choices' => $parc->getCordes()->toArray(),
                'choice_value' => 'id',
            ])
            ->add('longeur', NumberType::class, [
                'required' => true,
            ])->add('datedecreation', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['readonly' => true],
            ])->add('densite', NumberType::class, [
                'required' => true,


            ])->add('quantiter', TextType::class, [
                'required' => true,
            ])
            ->add('nombre', TextType::class, [
                'required' => true,

            ]);


        $formModifierCorde = function (FormInterface $form, Corde $corde = null) {
            $quantiteEnStock = null === $corde ? 0 : $corde->getQuantiter();

            $form->add('quantiteEnStock', NumberType::class, [
                'attr' => ['readonly' => true],

                'data' =>  $corde ?  $quantiteEnStock : 0,
            ]);
        };

        $formModifierStock = function (FormInterface $form, Parc $parc = null) {
            $stock = null === $parc ? array() : $parc->getStocks();
            $form->add('stocks', ChoiceType::class, [
                'choice_label' => 'abrevStock',
                'multiple' => false,

                'expanded' => false,
                'choices' => $parc->getStocks(),
                'choice_value' => 'id',
            ]);
        };
        $formModifierArticle = function (FormInterface $form, Stock $stock = null) {
            $stockArticle = null === $stock ? array() : $stock->getStockArticles();
            $form->add('article', ChoiceType::class, [
                'choices' =>  $stockArticle,
                'choice_label' => 'article',
                'choice_value' => 'id',
            ]);
        };
        $formModifierLot = function (FormInterface $form, StockArticle $article = null) {
            $stockArticleSns = null === $article ? array() : $article->getStockArticleSns();
            $lot = $stockArticleSns;
            $form->add('lot', ChoiceType::class, [
                'choices' =>   $lot,
                'choice_label' => 'numeroSerie',
                'multiple' => false,
                'expanded' => false,
                'choice_value' => 'id',
            ]);
        };
        $formModifierQteLot = function (FormInterface $form, StockArticleSn $stockArticleSn = null) {
            $totaleQte = null === $stockArticleSn ? 0 : $stockArticleSn->getSnQte();
            $form->add('totalqte', NumberType::class, [
                'attr' => ['readonly' => true],
                'data' =>  $totaleQte,

            ]);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifierStock, $formModifierQteLot, $formModifierLot, $formModifierCorde, $formModifierArticle, $parc) {
                $preparationCorde = $event->getData();
                dump($preparationCorde);
                if ($preparationCorde['corde'] instanceof Corde) {
                    $corde = $preparationCorde['corde'];
                } else {
                    $corde = $parc->getCordes()->filter(function ($corde) use ($preparationCorde) {
                        return $corde->getId() == $preparationCorde['corde'];
                    })->first();
                }

                $formModifierCorde($event->getForm(), $corde);

                $formModifierStock($event->getForm(), $parc);
                if ($preparationCorde['stocks'] instanceof Stock)
                    $stock = $preparationCorde['stocks'];
                else
                    $stock = $parc->getStocks()->filter(function ($stock) use ($preparationCorde) {
                        return $stock->getId() == $preparationCorde['stocks'];
                    })->first();
                $formModifierArticle($event->getForm(), $stock);
                if ($preparationCorde['lot'] instanceof StockArticleSn) {
                    $lot = $preparationCorde['lot'];
                    $formModifierQteLot($event->getForm(), $lot);
                }
                if ($preparationCorde['article'] instanceof StockArticle) {
                    $article = $preparationCorde['article'];
                    $lot = $article->getStockArticleSns()->first();
                    $formModifierLot($event->getForm(), $article);
                    $formModifierQteLot($event->getForm(), $lot);
                } else {
                    $article =  $stock->getStockArticles()->filter(function ($article) use ($preparationCorde) {
                        return $article->getId() == $preparationCorde['article'];
                    })->first();
                    $formModifierLot($event->getForm(), $article);
                    $lot = $article->getStockArticleSns()->first();
                    $formModifierQteLot($event->getForm(), $lot);
                }
            }
        );



        $builder->get('corde')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifierCorde) {
                $corde = $event->getForm()->getData();
                $formModifierCorde($event->getForm()->getParent(), $corde);
            }
        );
        $builder->get('stocks')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifierArticle) {
                $stocks = $event->getForm()->getData();
                dump($stocks);
                $formModifierArticle($event->getForm()->getParent(), $stocks);
            }
        );
        $builder->get('article')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifierLot) {
                $article = $event->getForm()->get('article')->getData();
                dump($article);
                $formModifierLot($event->getForm()->getParent(), $article);
            }
        );
        $builder->get('lot')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifierQteLot) {
                $lot = $event->getForm()->getData();
                dd($lot);
                $formModifierQteLot($event->getForm()->getParent(), $lot);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
            'parc' => Parc::class,
            'fruitDeMer' => FruitDeMer::class,
        ]);
    }
}
