<?php

namespace App\Admin;

use App\Entity\Stocks;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class MagasinsAdmin extends AbstractAdmin
{
    
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('libMagasin')->add('abrevMagasin')->add('idStock', EntityType::class, [
            'class' => Stocks::class,
            'choice_label' => 'libStock',
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('idMagasin')->add('libMagasin')->add('abrevMagasin')->add('idStock.libStock');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('idMagasin')->add('libMagasin')->add('abrevMagasin')->add('idStock.libStock');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('idMagasin')->add('libMagasin')->add('abrevMagasin')->add('idStock.libStock');
    }
}