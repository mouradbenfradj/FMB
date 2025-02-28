<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\FruitDeMer;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class ArticlesAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('refArticle')
            ->add('libArticle')
            ->add('descCourte')
            ->add('descLongue')
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('refArticle')
            ->add('libArticle')
            ->add('descCourte')
            ->add('descLongue')
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
        $form->add('fruitDeMer', EntityType::class, [
            'class' => FruitDeMer::class,
            'choice_label' => 'nom',
        ])
            ->add('refArticle')
            ->add('libArticle')
            ->add('descCourte')
            ->add('descLongue')
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('refArticle')
            ->add('libArticle')
            ->add('descCourte')
            ->add('descLongue')
        ;
    }
}
