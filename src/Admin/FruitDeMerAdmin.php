<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class FruitDeMerAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('nom');
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('id')->add('nom')->add('articles');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')->add('nom')->add('articles');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('id')->add('nom')->add('articles');
    }
}