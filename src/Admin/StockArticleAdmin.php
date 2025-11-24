<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Articles;
use App\Entity\Stock;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\CollectionType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class StockArticleAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('stock')
            ->add('articles')
            ->add('quantiter')
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('stock', EntityType::class, [
                'class' => Stock::class,
                'choice_label' => 'abrevStock',
            ])
            ->add('articles', EntityType::class, [
                'class' => Articles::class,
                'choice_label' => 'libArticle',
            ])
            ->add('quantiter')
            //->add('stockArticleSns')
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
            /*             ->add('quantiter')
 */->add('stockArticleSns', CollectionType::class, [], [
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
            ->add('quantiter')
        ;
    }
}
