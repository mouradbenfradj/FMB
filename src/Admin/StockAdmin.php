<?php

namespace App\Admin;

use App\Entity\Asc\Parc;
use App\Entity\Asc\Stock\Stock;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class StockAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('libStock')->add('abrevStock')->add('actif')->add('parc');
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('id')->add('libStock')->add('abrevStock')->add('actif')->add('parc');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')->add('libStock')->add('abrevStock')->add('actif')->add('parc');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('id')->add('libStock')->add('abrevStock')->add('actif')->add('parc');
    }
}