<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\CollectionType;

final class ArticlesAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Article')
            ->add('refArticle')
            ->add('fruitDeMer')
            ->add('libArticle')
            ->add('descCourte')
            ->add('descLongue')
            ->end()
            /* ->with('stock Article')
            ->add('stockArticles', CollectionType::class, [
                'type_options' => [
                    // Prevents the "Delete" option from being displayed
                    'delete' => true
                ]
            ], [
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position',
            ]) */;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('id')->add('refArticle')->add('libArticle')->add('descCourte')->add('descLongue')->add('stockArticles');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')->add('refArticle')->add('libArticle')->add('descCourte')->add('descLongue')->add('stockArticles');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('id')->add('refArticle')->add('libArticle')->add('descCourte')->add('descLongue')->add('stockArticles');
    }
}