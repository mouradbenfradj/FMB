<?php

namespace App\Form\Asc\ProdAFaire;

use App\Entity\Asc\Conteneur\Corde;
use App\Entity\Asc\Parc;
use App\Entity\Asc\Stock\Stock;
use App\Repository\Asc\ParcRepository;
use App\Repository\Asc\Stock\StockRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Preparation2CordeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('stocks', EntityType::class, [
                'class' => Stock::class,
                'choice_label' => 'abrevStock',
                'choices' => $options['data']->getStocks(),
                'mapped' => false,
                'choice_attr' => function ($stock) {
                    $articles = [];
                    foreach ($stock->getStockArticles() as $article) {
                        $articles[] = $article->getArticle()->getLibArticle();
                    }
                    return ['data-articles' => implode(',', $articles)];
                },
            ])
            ->add('corde', EntityType::class, [
                'class' => Corde::class,
                'choice_label' => 'nom',
                'choices' => $options['data']->getCordes(),
                'mapped' => false,
                'choice_attr' => function ($corde) {
                    return ['data-quantite-en-stock' => $corde->getQuantiter()];
                },
            ])
            ->add('quantiteEnStock', TextType::class, [
                'attr' => ['readonly' => true],
                'mapped' => false,
                'data' => $options['data']->getCordes()->first()->getQuantiter(),
            ])

            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                $form = $event->getForm();
                $data = $event->getData();

                $corde = $form->get('corde')->getData();
                $quantiteEnStock = $corde->getQuantiter(); // Corrigez ici

                $form->get('quantiteEnStock')->setData($quantiteEnStock);
            })
            ->add('datePreparation', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['readonly' => true],
                'mapped' => false,
            ])
            ->add('article', ChoiceType::class, [
                'choices' => [],
                'mapped' => false,
                'choice_attr' => function ($choice, $key, $value) use ($options) {
                    $data = $options['data'];
                    $stock = $data->getStocks()->first();
                    $article = $stock->getStockArticles()->filter(function ($article) use ($choice) {
                        return $article->getArticle()->getId() == $choice;
                    })->first();

                    if ($article) {
                        $stockArticleSns = $article->getStockArticleSns();

                        $choicesLot = [];
                        foreach ($stockArticleSns as $stockArticleSn) {
                            $choicesLot[] = $stockArticleSn->getNumeroSerie();
                        }

                        return ['data-stock-article-sn' => implode(',', $choicesLot)];
                    }

                    return [];
                },
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $form = $event->getForm();
                $data = $event->getData();

                $stock = $data->getStocks()->first();
                $articles = $stock->getStockArticles();

                $choices = [];
                foreach ($articles as $article) {
                    $choices[$article->getArticle()->getLibArticle()] = $article->getArticle()->getId();
                }

                $form->add('article', ChoiceType::class, [
                    'choices' => $choices,
                    'mapped' => false,
                    'choice_attr' => function ($choice, $key, $value) use ($stock, $articles) {
                        $article = $articles->filter(function ($article) use ($choice) {
                            return $article->getArticle()->getId() == $choice;
                        })->first();

                        if ($article) {
                            $stockArticleSns = $article->getStockArticleSns();

                            $choicesLot = [];
                            foreach ($stockArticleSns as $stockArticleSn) {
                                $choicesLot[] = $stockArticleSn->getNumeroSerie();
                            }

                            return ['data-stock-article-sn' => implode(',', $choicesLot)];
                        }

                        return [];
                    },
                ]);

                $stockArticle = $stock->getStockArticles()->first();
                $article = $stockArticle->getArticle();

                $stockArticleSns = $stockArticle->getStockArticleSns();

                $choicesLot = [];
                foreach ($stockArticleSns as $stockArticleSn) {
                    $choicesLot[$stockArticleSn->getNumeroSerie()] = $stockArticleSn->getNumeroSerie();
                }

                $form->add('lot', ChoiceType::class, [
                    'choices' => $choicesLot,
                    'mapped' => false,
                    'choice_attr' => function ($choice, $key, $value) use ($stockArticleSns) {
                        $stockArticleSn = $stockArticleSns->filter(function ($stockArticleSn) use ($choice) {
                            return $stockArticleSn->getNumeroSerie() == $choice;
                        })->first();

                        if ($stockArticleSn) {
                            return ['data-sn-qte' => $stockArticleSn->getSnQte()];
                        }

                        return [];
                    },
                ]);

                $form->get('densite')->setData($stockArticleSns->first()->getSnQte());
            })
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                $form = $event->getForm();
                $data = $event->getData();

                $stock = $form->get('stocks')->getData();
                $articles = $stock->getStockArticles();

                $choices = [];
                foreach ($articles as $article) {
                    $choices[$article->getArticle()->getLibArticle()] = $article->getArticle()->getId();
                }

                $form->remove('article');
                $form->add('article', ChoiceType::class, [
                    'choices' => $choices,
                    'mapped' => false,
                ]);

                $articleId = $data['article'];
                $article = $stock->getStockArticles()->filter(function ($article) use ($articleId) {
                    return $article->getArticle()->getId() == $articleId;
                })->first();

                if ($article) {
                    $stockArticleSns = $article->getStockArticleSns();

                    $choicesLot = [];
                    foreach ($stockArticleSns as $stockArticleSn) {
                        $choicesLot[$stockArticleSn->getNumeroSerie()] = $stockArticleSn->getNumeroSerie();
                    }

                    $form->remove('lot');
                    $form->add('lot', ChoiceType::class, [
                        'choices' => $choicesLot,
                        'mapped' => false,
                    ]);

                    $form->get('densite')->setData($stockArticleSns->first()->getSnQte());
                }
            })
            ->add('densite', NumberType::class, [
                'required' => true,
                'mapped' => false,
                'attr' => ['readonly' => true],
            ])
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                $form = $event->getForm();
                $data = $event->getData();

                $lot = $form->get('lot')->getData();
                $stockArticleSns = $form->get('lot')->getConfig()->getOption('choices');

                $stockArticleSn = $stockArticleSns->filter(function ($stockArticleSn) use ($lot) {
                    return $stockArticleSn->getNumeroSerie() == $lot;
                })->first();

                if ($stockArticleSn) {
                    $form->get('densite')->setData($stockArticleSn->getSnQte());
                }
            })
            ->add('poid', NumberType::class, [
                'required' => true,
                'mapped' => false,
            ])
            ->add('quantite', TextType::class, [
                'required' => true,
                'mapped' => false,
            ])
            ->add('nombre', TextType::class, [
                'required' => true,
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Parc::class,
        ]);
    }
}
