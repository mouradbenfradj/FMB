<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class FlottabiliterAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('nomFlottabiliter')->add('volume')->add('kgf');
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('id')->add('nomFlottabiliter')->add('volume')->add('kgf')->add('flotteurs');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')->add('nomFlottabiliter')->add('volume')->add('kgf')->add('flotteurs');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('id')->add('nomFlottabiliter')->add('volume')->add('kgf')->add('flotteurs');
    }
}