<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\CollectionType;
use Sonata\AdminBundle\Show\ShowMapper;

final class FlotteurSegmentAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('flotteur')->add('nombre')->add('distanceDeDepart')->add('pas');
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('id')->add('segment')->add('flotteur')->add('nombre')->add('distanceDeDepart')->add('pas');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')->add('segment')->add('flotteur')->add('nombre')->add('distanceDeDepart')->add('pas');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('id')->add('segment')->add('flotteur')->add('nombre')->add('distanceDeDepart')->add('pas');
    }
}