<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\StockArticle;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class StockArticleSnAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('snQte')
            ->add('numeroSerie')
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('snQte')
            ->add('numeroSerie')
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
            /*  ->add('stockArticle', EntityType::class, [
                'class' => StockArticle::class,
                'choice_label' => 'articles',
            ]) */
            ->add('snQte')
            ->add('numeroSerie')
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('snQte')
            ->add('numeroSerie')
        ;
    }
}
