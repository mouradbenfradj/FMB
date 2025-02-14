<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class LanterneAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('nom')->add('parc')->add('quantiter')->add('nbrPoche');
        if ($this->getSubject() && $this->getSubject()->getId()) {
                /*$form ->add('emplacement') */;
        }
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('id')->add('nom')->add('parc')->add('quantiter')->add('nbrPoche')/* ->add('emplacement') */;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')->add('nom')->add('parc')->add('quantiter')->add('nbrPoche')/* ->add('emplacement') */;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('id')->add('nom')->add('parc')->add('quantiter')->add('nbrPoche')/* ->add('emplacement') */;
    }
}
