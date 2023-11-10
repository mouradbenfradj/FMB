<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class AlerteVertAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('nomAlerte')->add('avantNombreJour')->add('avantNombreMoi')->add('avantNombreAnnee');
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('id')->add('nomAlerte')->add('avantNombreJour')->add('avantNombreMoi')->add('avantNombreAnnee')->add('cycles');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')->add('nomAlerte')->add('avantNombreJour')->add('avantNombreMoi')->add('avantNombreAnnee')->add('cycles');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('id')->add('nomAlerte')->add('avantNombreJour')->add('avantNombreMoi')->add('avantNombreAnnee')->add('cycles');
    }
}