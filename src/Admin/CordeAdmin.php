<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class CordeAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('parc')->add('quantiter')->add('nom')->add('emplacement');
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('parc')->add('quantiter')->add('nom')->add('emplacement');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')->add('parc')->add('quantiter')->add('nom')->add('emplacement');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('parc')->add('quantiter')->add('nom')->add('emplacement');
    }
}