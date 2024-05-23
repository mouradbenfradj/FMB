<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class PhaseAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('nomPhase')->add('ordreAffichage');
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('id')->add('nomPhase')->add('ordreAffichage')->add('process');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')->add('nomPhase')->add('ordreAffichage')->add('process');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('id')->add('nomPhase')->add('ordreAffichage')->add('process');
    }
}