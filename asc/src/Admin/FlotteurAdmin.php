<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class FlotteurAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('nomFlotteur', TextType::class)->add('volume')->add('kfg')->add('taux');
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('nomFlotteur')->add('volume')->add('kfg')->add('taux');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('nomFlotteur')->add('volume')->add('kfg')->add('taux');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('nomFlotteur')->add('volume')->add('kfg')->add('taux');
    }
}
