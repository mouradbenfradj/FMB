<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\FruitDeMer;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

final class ArticlesAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id', 'doctrine_orm_integer')
            ->add('refArticle')
            ->add('libArticle')
            ->add('descCourte')
            ->add('descLongue')
            ->add('fruitDeMer')
            ->add('stockArticles')
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
            ->add('fruitDeMer', EntityType::class, [
                'class' => FruitDeMer::class,
                'choice_label' => 'nom',
                'label' => 'ESPECE'
            ])
            ->add('stockArticles')
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
            ->add('fruitDeMer', EntityType::class, [
                'class' => FruitDeMer::class,
                'choice_label' => 'nom',
                'label' => 'ESPECE'
            ])
            ->add('refArticle', TextType::class)
            ->add('libArticle', TextType::class)
            ->add('descCourte', TextType::class)
            ->add('descLongue', TextType::class)
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('refArticle', TextType::class)
            ->add('libArticle', TextType::class)
            ->add('descCourte', TextType::class)
            ->add('descLongue', TextType::class)
        ;
    }
}
