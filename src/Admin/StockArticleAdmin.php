<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class StockArticleAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('quantiter')->add('stock');
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('quantiter')->add('stock');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')->add('quantiter')->add('stock');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('quantiter')->add('stock');
    }
}