<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class FlotteurAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('nomFlotteur')->add('volume')->add('taux');
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('id')->add('nomFlotteur')->add('volume')->add('taux')->add('kgf');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')->add('nomFlotteur')->add('volume')->add('taux')->add('kgf');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('id')->add('nomFlotteur')->add('volume')->add('taux')->add('kgf');
    }
}
