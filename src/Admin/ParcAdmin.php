<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class ParcAdmin extends AbstractAdmin
{
    
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('libParc')->add('abrevParc')/* ->add('idStock', EntityType::class, [
            'class' => Stocks::class,
            'choice_label' => 'libStock',
        ]) */;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('idParc')->add('libParc')->add('abrevParc')->add('idStock.libStock');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('idParc')->add('libParc')->add('abrevParc')->add('idStock.libStock');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('idParc')->add('libParc')->add('abrevParc')->add('idStock.libStock');
    }
}