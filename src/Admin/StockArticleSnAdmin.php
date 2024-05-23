<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class StockArticleSnAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('stockArticle')->add('numeroSerie')->add('snQte');
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('stockArticle')->add('numeroSerie')->add('snQte');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')->add('stockArticle')->add('numeroSerie')->add('snQte');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('stockArticle')->add('numeroSerie')->add('snQte');
    }
}