<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Stock;
use App\Entity\Articles;
use Sonata\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class StockArticleAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('stock')
            ->add('articles')
            ->add('stockArticleSns', null, [
                'label' => 'Stocks Article Lot(s)',
            ], [
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position',
            ])
            ->add('quantite')
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->add('stock', EntityType::class, [
                'class' => Stock::class,
                'choice_label' => 'abrevStock',
            ])
            ->add('articles', EntityType::class, [
                'class' => Articles::class,
                'choice_label' => 'libArticle',
            ])
            ->add('quantite')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('stock', EntityType::class, [
                'class' => Stock::class,
                'choice_label' => 'abrevStock',
            ])
            ->add('articles', EntityType::class, [
                'class' => Articles::class,
                'choice_label' => 'libArticle',
            ])
            /*             ->add('quantite') */
            ->add('stockArticleSns', CollectionType::class, ['label' => 'Stocks Article Lot(s)',], [

                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position',
            ])
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('stock', EntityType::class, [
                'class' => Stock::class,
                'choice_label' => 'abrevStock',
            ])
            ->add('articles', EntityType::class, [
                'class' => Articles::class,
                'choice_label' => 'libArticle',
            ])
            ->add('stockArticleSns', CollectionType::class, ['label' => 'Stocks Article Lot(s)',], [
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position',
            ])
            ->add('quantite')
        ;
    }
}
