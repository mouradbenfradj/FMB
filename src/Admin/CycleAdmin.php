<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class CycleAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('id')->add('processus')->add('processus')->add('nomCycle')->add('alerteVert')->add('alerteJaune')->add('alerteRouge')->add('numDebCycle')->add('numFinCycle')->add('couleurTexte')->add('couleurFondText');
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('id')->add('processus')->add('nomCycle')->add('alerteVert')->add('alerteJaune')->add('alerteRouge')->add('numDebCycle')->add('numFinCycle')->add('couleurTexte')->add('couleurFondText');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')->add('processus')->add('nomCycle')->add('alerteVert')->add('alerteJaune')->add('alerteRouge')->add('numDebCycle')->add('numFinCycle')->add('couleurTexte')->add('couleurFondText');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('id')->add('processus')->add('nomCycle')->add('alerteVert')->add('alerteJaune')->add('alerteRouge')->add('numDebCycle')->add('numFinCycle')->add('couleurTexte')->add('couleurFondText');
    }
}
