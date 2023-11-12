<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class EmplacementAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('place')->add('flotteur')->add('dateRemplissage');
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('id')->add('place')->add('flotteur')->add('dateRemplissage');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')->add('place')->add('flotteur')->add('dateRemplissage');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('id')->add('place')->add('flotteur')->add('dateRemplissage');
    }
}